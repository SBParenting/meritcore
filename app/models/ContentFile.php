<?php

class ContentFile extends BaseModel {

	protected $table = 'content_files';

	protected $fillable = ['title', 'path'];

	public static function getListable()
    {
        $query = self::query();

        switch($sort = self::getSort('title', 'asc'))
        {
            case 'title':
                $query->orderBy('title', $sort->order);

            default:
                $query->orderBy($sort->sort, $sort->order);
        }

        return $query;
    }   
}