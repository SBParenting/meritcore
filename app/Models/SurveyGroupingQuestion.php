<?php namespace App\Models;

class SurveyGroupingQuestion extends \App\Models\Model {

	protected $table = 'survey_grouping_question';

	protected $fillable = ['grouping_id', 'question_id'];

	public function grouping(){
		return $this->belongsTo('SurveyGrouping');
	}

	public function question(){
		return $this->belongsTo('SurveyQuestion');
	}

}