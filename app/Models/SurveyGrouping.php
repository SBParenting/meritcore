<?php namespace App\Models;

class SurveyGrouping extends \App\Models\Model {

	protected $table = 'survey_groupings';

	protected $fillable = ['title'];

	protected $hidden = ['deleted_at'];

	public function survey()
	{
		return $this->belongsTo('App\Models\Survey');
	}

	public function questions()
	{
		return $this->belongsToMany('App\Models\SurveyQuestion', 'survey_grouping_question', 'grouping_id', 'question_id');
	}
}