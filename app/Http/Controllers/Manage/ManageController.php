<?php namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\User as Record;
use App\Models\Classroom;
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

		$schools = $this->user->schools;

		$school_ids = array_fetch($schools->toArray(), 'id');

		$classes = Classroom::with('teacher')->whereIn('school_id', $school_ids)->orderBy('updated_at', 'desc')->get();

		$data = [
			'page'    => 'schools',
			'schools' => $schools,
			'classes' => $classes,
		];

		return \View::make('front.manage.schools', $data);
	}

	public function getSchool($id)
	{
		$this->access('manage:schools');

		$school = School::find($id);

		$classes = Classroom::with('teacher')->where('school_id', '=', $id)->orderBy('updated_at', 'desc')->get();

		$data = [
			'page'    => 'classes',
			'school'  => $school,
			'classes' => $classes,
			'grades'   => Classroom::$grades,
			'teachers' => $school->getTeachers(),
		];

		return \View::make('front.manage.classes', $data);
	}

	public function getClasses()
	{
		$this->access('manage:classes');

		$school = $this->user->schools->first();

		if ($school)
		{
			$classes = Classroom::with('teacher')->where('school_id', '=', $school->id)->orderBy('updated_at', 'desc')->get();

			$data = [
				'page'     => 'classes',
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

			$surveys = Campaign::with('survey')->where('class_id', '=', $id)->where('status', '=', 'Completed')->orderBy('created_at', 'desc')->get();

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

	public function getStudents()
	{
		$this->access('manage:classes');

		$data = [
			'page' => 'students',
		];

		return \View::make('front.manage.students', $data);
	}

	public function getSurveys()
	{
		$this->access('manage:classes');

		$data = [
			'page' => 'surveys',
		];

		return \View::make('front.manage.surveys', $data);
	}
}