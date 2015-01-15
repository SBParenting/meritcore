<?php

class Image extends BaseModel {

	protected $table = 'content_images';

	protected $fillable = ['title', 'path', 'thumbnail', 'extension'];

	public static function getListable()
    {
        $query = self::query();

        switch($sort = self::getSort('updated_at', 'desc'))
        {
            default:
                $query->orderBy($sort->sort, $sort->order);
        }

        return $query;
    }   

    public function createFilename()
    {
        return strtolower(preg_replace("/[^A-Za-z0-9]+/", "", $this->title)) . "_" . $this->id;
    }
}