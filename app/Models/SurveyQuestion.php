<?php namespace App\Models;

class SurveyQuestion extends \App\Models\Model {

	protected $table = 'survey_questions';

	protected $fillable = ['num', 'question','survey_id'];

	protected $hidden = ['deleted_at'];

	public function survey()
	{
		return $this->belongsTo('Survey');
	}


	public function groupings()
	{
		return $this->belongsToMany('App\Models\SurveyGrouping', 'survey_grouping_question', 'question_id', 'grouping_id');
	}
}