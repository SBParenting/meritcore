<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SurveyQuestion extends BaseModel {

    use SoftDeletingTrait;

	protected $table = 'survey_questions';

	protected $fillable = ['survey_id', 'num', 'question'];
}