<?php namespace App\Models;

use \App\Models\Campaign;
use \App\Models\StudentAssoc;

class Classroom extends \App\Models\Model {

	protected $table = 'school_classes';

	protected $fillable = ['title', 'teacher_id', 'grade', 'school_id'];

	public static $grades = ['EC' => 'Grade EC', '1' => 'Grade 1','2' => 'Grade 2','3' => 'Grade 3','4' => 'Grade 4','5' => 'Grade 5','6' => 'Grade 6','7' => 'Grade 7','8' => 'Grade 8','9' => 'Grade 9','10' => 'Grade 10','11' => 'Grade 11','12' => 'Grade 12',];

	public function teacher()
	{
		return $this->belongsTo('App\Models\User', 'teacher_id');
	}

	public function school()
	{
		return $this->belongsTo('App\Models\School', 'school_id');
	}

	public function students()
	{
		return $this->belongsToMany('App\Models\Student', 'student_associations', 'class_id', 'student_id');
	}

	public function surveys()
	{
		return $this->hasMany('App\Models\Campaign', 'class_id');
	}

	public function updateSurveyStatus()
	{
		$survey = Campaign::where('class_id', '=', $this->id)->where('status', '=', 'Active')->first();

		if ($survey)
		{
			$this->is_survey_active = true;
			$this->survey_progress = $survey->completed_progress;
		}
		else
		{
			$this->is_survey_active = false;
			$this->survey_progress = 0;	
		}

		$this->save();
	}

	public function updateRecord()
	{
		$this->count_students = StudentAssoc::where('class_id', '=', $this->id)->count();

		return $this;
	}

}