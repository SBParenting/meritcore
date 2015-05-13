<?php namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\User as Record;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentAssoc;
use App\Models\School;
use App\Models\SchoolBoard;
use App\Models\Survey;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\PostSurveyQuestion;
use App\Models\PostSurveyAnswers;
use App\Models\CampaignStudentInfo;
use App\Models\Projects;
use App\Models\SchoolProject;

class ManageController extends Controller {

	public function __construct()
	{
		\View::share('is_admin', (can('manage:schools') || can('manage:classes')));
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

	public function getProjects()
	{
		$this->access('manage:projects');

		if (\Input::has('search')) {
			$projects = Projects::where('id','<>', '0')
				->where(function($query){
					foreach(explode(' ',\Input::get('search')) as $term) {
						$query->orWhere('project_name','LIKE','%'.$term.'%');
					}
				})->get();
		}
		else{
			$projects = Projects::all();
		}

		foreach ($projects as $project) {
			$project->school_count  = SchoolProject::where('project_id',$project->id)->count();
		}

		$data = [
			'page'         => 'projects',
			'projects'     => $projects,
		];

		return \View::make('front.manage.projects', $data);
	}

	public function getSchools()
	{
		$this->access('manage:schools');

		$school_board = $this->user->school_board->first();

		if (isset($school_board)) {
			$schools = $school_board->schools;
		} else {
			$schools = $this->user->schools;
			if(!$schools->isEmpty()) {
				$school_board = SchoolBoard::findOrFail($this->user->schools->first()->school_board_id);
			} else {
				return \Redirect::to('/admin');
			}
		}

		if (\Input::has('search')) {
			$schools = School::where('school_board_id',$school_board->id)
				->where(function($query){
					foreach(explode(' ',\Input::get('search')) as $term) {
						$query->orWhere('name','LIKE','%'.$term.'%');
					}
				})->get();
		}

		foreach ($schools as $school) {
			$school->classes_count  = Classroom::where('school_id',$school->id)->count();

			$school->students_count = Student::where('school_id',$school->id)->count();
		}

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
			$status = 'Active';

			if (\Input::has('status') && in_array(\Input::get('status'), ['Active', 'Archived']))
			{
				$status = \Input::get('status');
			}

			if (\Auth::user()->hasRole('teacher')) {
				$classes = Classroom::with('teacher')->where('teacher_id', '=', \Auth::user()->id)->where('status', '=', $status)->orderBy('title', 'asc')->get();
			} else {
				$classes = Classroom::with('teacher')->where('school_id', '=', $school->id)->where('status', '=', $status)->orderBy('title', 'asc')->get();
			}

			$data = [
				'page'     => $page,
				'school'   => $school,
				'classes'  => $classes,
				'grades'   => Classroom::$grades,
				'teachers' => $school->getTeachers(),
				'status'   => $status,
			];

			foreach ($classes as $class) {
				$class->students_count = StudentAssoc::where('class_id',$class->id)->count();
			}

			if(count($classes) || !\Auth::user()->hasRole('teacher')) {
				return \View::make('front.manage.classes', $data);
			} else {
				return \View::make('front.manage.no-class');
			}

		}
		else
		{
			return \View::make('front.manage.no-class');
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

			$active_surveys = Campaign::with('survey', 'students', 'students.student')->where('class_id', '=', $id)->where('status', '=', 'Active')->get();

			$surveys = Campaign::with('survey', 'stats', 'stats.grouping')->where('class_id', '=', $id)->where('status', '=', 'Completed')->orderBy('created_at', 'desc')->get();

			//dd($surveys);
			$survey_engagement = [];
			$improveData =[];
			$demonstrateData =[];
			$survey_impact = [];
			foreach ($surveys as $survey) {
				if($survey->survey_id == 3 || $survey->survey_id == 4){
					$data2 = [];
	 				$questions = ['question_2' => 'My instructor\'s approach and style of presenting was enjoyable for me.',
	 					'question_3' => 'The HEROES® program offered good information that I am able to understand and use.',
	 					'question_4' => 'We discussed things in the HEROES® classes that are meaningful and important to me.',
	 					'question_5' => 'I felt listened to and respected as I participated in the HEROES® classes.'];

	 				$questions2 = ['question_2' => '1',
	 				'question_3' => '2',
	 				'question_4' => '3',
	 				'question_5' => '4'];
	 			 
		 			foreach ($questions as $key => $value) {
		 				$yesCount = CampaignStudentInfo::where('campaign_id',$survey->id)->where($key,1)->count();
		 				$noCount = CampaignStudentInfo::where('campaign_id',$survey->id)->where($key,2)->count();
		 				array_push($data2, array($value,$yesCount,$noCount));
		 			}
		 			$survey_engagement[$survey->id] = $data2;

		 			$data3 = [];
	 			 	//$data3[] = ['Question','Yes','No'];
	 			 	$questions = PostSurveyQuestion::where('survey_id',$survey->survey_id)->get();
	 			 
		 			 if($questions){
		 			 	foreach ($questions as $question) {
		 			 		$yesCount = PostSurveyAnswers::where('campaign_id',$survey->id)->where('question_id',$question->id)->where('answer',1)->count();
		 			 		$noCount = PostSurveyAnswers::where('campaign_id',$survey->id)->where('question_id',$question->id)->where('answer',2)->count();
		 				 	array_push($data3, array($question->title,$yesCount,$noCount));
		 				 	//array_push($data3, array('title' => $question->title,'yes' => $yesCount,'no' => $noCount));
		 				 }
		 			 }
		 			 //dd($data3);
		 			 $survey_impact[$survey->id] = $data3;
		 			//dd($survey->getImproveResults());
		 			$improveData[$survey->id] = $survey->getImproveResults();

		 			$demonstrateData[$survey->id] = $survey->getDemonstrateResults();
	 			}
			}
			//dd($demonstrateData);
			$data = [
				'page'           	=> 'classes',
				'school'         	=> $school,
				'class'          	=> $class,
				'students'       	=> $students,
				'grades'         	=> Classroom::$grades,
				'teachers'       	=> $school->getTeachers(),
				'surveys'        	=> $surveys,
				'active_surveys' 	=> $active_surveys,
				'survey_types'   	=> Survey::all(),
				'survey_engagement' => $survey_engagement,
				'survey_improve' 	=> $improveData,
				'survey_demonstrate'=> $demonstrateData,
				'survey_impact'		=> $survey_impact,

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