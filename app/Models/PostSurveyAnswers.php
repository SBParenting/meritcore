<?php namespace App\Models;

class PostSurveyAnswers extends \App\Models\Model {

	protected $table = 'post_survey_answers';

	protected $fillable = ['survey_id', 'question_id', 'answer', 'campaign_id', 'student_id'];

	
	public $timestamps = false;

}