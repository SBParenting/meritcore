<?php namespace App\Models;

class CampaignStudentInfo extends \App\Models\Model {

	protected $table = 'campaign_info';

	public $timestamps = false;

	protected $fillable = ['campaign_id', 'student_id', 'teacher_name', 'heroes_id', 'class', 'instructor_name', 'city', 'gender', 'age', 'grade'];

	public function campaign()
	{
		return $this->belongsTo('App\Models\Campaign');
	}

	public function student()
	{
		return $this->belongsTo('App\Models\Student');
	}
}