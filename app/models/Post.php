<?php

class Post extends BaseModel {

	protected $table = 'content_posts';

	protected $fillable = ['title', 'slug', 'date', 'content', 'published'];

	public static $published = ['Unpublished', 'Published'];

	public function summary()
	{
		$array = explode("[summary]", $this->content);

		return array_shift($array);
	}

	public static function getListable($var=false)
	{
		$query   = static::initListable($var);
		
		$filters = static::initStatic($var);
		
		$sorting = self::getSort('title', 'asc');

		switch($sorting->sort)
		{
			default:
				$query->orderBy($sorting->sort, $sorting->order);
		}

		foreach ($filters as $key => $filter) 
		{
			switch($key) 
			{
				case 'published':
					if (!empty($filter))
					{
						$query->where('published', '=', ($filter == 'true')); break;
					}
			}
		}

		return $query;
	}   

	public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->where('published', '=', '1')->first();
    }
}