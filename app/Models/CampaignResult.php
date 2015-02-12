<?php namespace App\Models;

class CampaignResult extends \App\Models\Model {

	protected $table = 'campaign_results';

	protected $fillable = ['campaign_id', 'campaign_student_id', 'school_board_id', 'school_id', 'class_id', 'student_id', 'question_id', 'result'];

	public function campaign()
	{
		return $this->belongsTo('App\Models\Campaign');
	}

	public function student()
	{
		return $this->belongsTo('App\Models\Student');
	}
}