<?php namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\User as Record;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentAssoc;
use App\Models\School;
use App\Models\Survey;
use App\Models\Campaign;
use Illuminate\Http\Request;

class ManageController extends Controller {

	public function __construct()
	{
		\View::share('is_admin', can('manage:schools'));
	}

	public function getIndex()
	{
		if (can('manage:schools'))
		{
			return redirect('/m/schools');
		}

		if (can('manage:classes'))
		{
			return redirect('/m/classes');
		}

		abort(403);
	}

	public function getSchools()
	{
		$this->access('manage:schools');

		$school_board = $this->user->school_board->first();

		$schools = $this->user->schools;

		$school_ids = array_fetch($schools->toArray(), 'id');

		$data = [
			'page'         => 'schools',
			'school_board' => $school_board,
			'schools'      => $schools,
			'fields'	   => Student::$importable,
		];

		return \View::make('front.manage.schools', $data);
	}

	public function getClasses($id=false)
	{
		$this->access('manage:classes');

		if ($id===false)
		{
			$school = $this->user->schools->first();
			$page = 'classes';	
		}
		else
		{
			$school = School::find($id);
			$page = 'school';
		}		

		if ($school)
		{
			$classes = Classroom::with('teacher')->where('school_id', '=', $school->id)->orderBy('title', 'asc')->get();

			$data = [
				'page'     => $page,
				'school'   => $school,
				'classes'  => $classes,
				'grades'   => Classroom::$grades,
				'teachers' => $school->getTeachers(),
			];

			return \View::make('front.manage.classes', $data);
		}

		abort(404);
	}

	public function getClass($id)
	{
		$this->access('manage:classes');

		$class = Classroom::with('teacher')->find($id);

		if ($class)
		{
			$school = $class->school;

			$students = $class->students;

			$surveys = $class->surveys;

			$active_survey = Campaign::with('survey', 'students', 'students.student')->where('class_id', '=', $id)->where('status', '=', 'Active')->first();

			$surveys = Campaign::with('survey', 'stats', 'stats.grouping')->where('class_id', '=', $id)->where('status', '=', 'Completed')->orderBy('created_at', 'desc')->get();

			$data = [
				'page'          => 'classes',
				'school'        => $school,
				'class'         => $class,
				'students'      => $students,
				'grades'        => Classroom::$grades,
				'teachers'      => $school->getTeachers(),
				'surveys'       => $surveys,
				'active_survey' => $active_survey,
				'survey_types'  => Survey::all(),
			];

			return \View::make('front.manage.class', $data);
		}

		abort(404);
	}

	public function getStudents($id=false)
	{
		$this->access('manage:classes');

		if ($id===false)
		{
			$school = $this->user->schools->first();	
		}
		else
		{
			$school = School::find($id);
		}	

		$students = Student::with('clasr')->where('school_id', '=', $id)->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get();

		$classes = Classroom::with('teacher')->where('school_id', '=', $school->id)->orderBy('updated_at', 'desc')->get();

		$data = [
			'page'     => 'students',
			'school'   => $school,
			'classes'  => $classes,
			'students' => $students,
		];

		return \View::make('front.manage.students', $data);
	}

	public function getSurveys($id=false)
	{
		$this->access('manage:classes');
		
		if ($id===false)
		{
			$school = $this->user->schools->first();	
		}
		else
		{
			$school = School::find($id);
		}	

		$data = [
			'page'   => 'surveys',
			'school' => $school,
		];

		return \View::make('front.manage.surveys', $data);
	}

}