<?php namespace App\Models;

class SchoolBoard extends \App\Models\Model {

	protected $table = 'school_boards';

	protected $fillable = ['title'];

	protected $related = ['school' => 'App\Models\School'];

	protected $relation_key = 'survey_id';

	public function schools()
	{
		return $this->hasMany('App\Models\School');
	}
}