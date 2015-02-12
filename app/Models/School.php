<?php namespace App\Models;

class School extends \App\Models\Model {

	protected $table = 'schools';

	protected $fillable = ['title'];

	protected $related = ['school_board' => 'App\Models\SchoolBoard'];

	protected $relation_key = 'survey_id';

	public function board()
	{
		return $this->belongsTo('App\Models\SchoolBoard');
	}
}