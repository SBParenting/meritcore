<?php namespace App\Models;

class SurveyQuestion extends \App\Models\Model {

	protected $table = 'survey_questions';

	protected $fillable = ['num', 'title'];

	protected $hidden = ['deleted_at'];

	public function survey()
	{
		return $this->belongsTo('Survey');
	}
}