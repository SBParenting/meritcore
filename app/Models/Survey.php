<?php namespace App\Models;

class Survey extends \App\Models\Model {

	protected $table = 'surveys';

	protected $fillable = ['title'];

	protected $related = ['question' => 'App\Models\SurveyQuestion'];

	protected $relation_key = 'survey_id';

	public function questions()
	{
		return $this->hasMany('App\Models\SurveyQuestion');
	}

	public function getQuestions()
	{
		return $this->getRelated('question')->select('id', 'num', 'question')->orderBy('num', 'asc')->get();
	}
}