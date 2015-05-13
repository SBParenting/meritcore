<?php namespace App\Models;

class SchoolBoard extends \App\Models\Model {

	protected $table = 'school_boards';

	protected $fillable = ['name', 'email', 'province', 'country','schools_count'];

	public static $sortable = ['name', 'email', 'province', 'country'];

	public static $defaultSort = ['name', 'asc'];

	protected $related = ['school' => 'App\Models\School'];

	protected $relation_key = 'survey_id';

	public function schools()
	{
		return $this->hasMany('App\Models\School');
	}

	public function updateRecord()
	{
//		$this->schools_count = School::where('school_board_id', '=', $this->id)->count();

		return $this;
	}

	public static function getListable($var=false)
    {
        $query   = static::initListable($var);
       
        $filters = static::initStatic($var);

        $sort = self::getSort();

        if (!empty($sort->sort) && in_array($sort->sort, self::$sortable))
        {
	        switch($sort->sort)
	        {
	            default:
	                $query->orderBy($sort->sort, $sort->order);

	        }
        }

        return $query;
    }
}