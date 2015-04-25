<?php namespace App\Models;

class PostSurveyQuestion extends \App\Models\Model {

	protected $table = 'post_survey_questions';

	protected $fillable = ['survey_id', 'question_num', 'title'];

	public static $defaultSort = ['question_num', 'asc'];

}