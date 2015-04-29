<?php namespace App\Models;

class CampaignStudentInfo extends \App\Models\Model {

	protected $table = 'campaign_info';

	public $timestamps = false;

	protected $fillable = ['campaign_id', 'student_id', 'survey_id', 'question_1', 'question_2', 'question_3', 'question_4', 'question_5'];

	public function campaign()
	{
		return $this->belongsTo('App\Models\Campaign');
	}

	public function student()
	{
		return $this->belongsTo('App\Models\Student');
	}

	
}