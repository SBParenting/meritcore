<?php namespace App\Models;

use \App\Models\Campaign;
use \App\Models\StudentAssoc;

class Classroom extends \App\Models\Model {

	protected $table = 'school_classes';

	protected $fillable = ['title', 'teacher_id', 'grade', 'school_id', 'status'];

	protected static $sortable = ['title', 'teacher', 'grade', 'school', 'students_count', 'surveys_total_count', 'surveys_active_count'];

	public static $grades = ['EC' => 'Grade EC', '1' => 'Grade 1','2' => 'Grade 2','3' => 'Grade 3','4' => 'Grade 4','5' => 'Grade 5','6' => 'Grade 6','7' => 'Grade 7','8' => 'Grade 8','9' => 'Grade 9','10' => 'Grade 10','11' => 'Grade 11','12' => 'Grade 12',];

	public static $defaultSort = ['sort' => 'school', 'order' => 'asc'];

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
		$this->students_count = Student::where('classroom_id', '=', $this->id)->count();
		$this->surveys_total_count = Campaign::where('class_id', '=', $this->id)->count();
		$this->surveys_active_count = Campaign::where('status', '=', 'Active')->where('class_id', '=', $this->id)->count();

		return $this;
	}

	public static function getListable($var=false)
    {
        $query   = static::initListable($var);

        $query->leftJoin('schools', 'schools.id', '=', 'school_classes.school_id');

        $query->leftJoin('users', 'users.id', '=', 'school_classes.teacher_id');

        $query->select('school_classes.*', 'schools.name as school_name', \DB::raw("CONCAT(users.first_name, ' ', users.last_name) as teacher_name"));
        
        $filters = static::initStatic($var);

        $sort = self::getSort();

        if (!empty($sort->sort) && in_array($sort->sort, self::$sortable))
        {
	        switch($sort->sort)
	        {
	        	case 'school':
	        		$query->orderBy('schools.name', $sort->order);
	        		$query->orderBy('title', $sort->order);
	        		break;

	        	case 'teacher':
	        		$query->orderBy('teacher_name', $sort->order);
	        		$query->orderBy('title', $sort->order);
	        		break;

	            default:
	                $query->orderBy($sort->sort, $sort->order);
	        }
	    }

        return $query;
    }

}