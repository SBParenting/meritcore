<?php namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use App\Models\Role;
use App\Models\SchoolBoard;
use App\Models\StudentAssoc;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\SchoolProject;

class ProjectsController extends Controller {

	public function postAdd(Request $request)
	{
		$rules = [
			'project_name' => 'required',
		];

		$this->validate($request, $rules);

		$project = new Projects;

		$project->fill($request->input());

		$project->save();

		\Session::flash('success', trans('crud.success_added'));

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url('/m/projects/schools/'.$project->id)]);
	}

	public function postUpdate(Request $request, $id)
	{
		$project = Projects::find($id);

		if ($project)
		{
			$rules = [
				'project_name' => 'required',
			];

			$this->validate($request, $rules);

			$project->fill($request->input());

			$project->save();

			\Session::flash('success', trans('crud.success_updated'));

			return \Response::json(['result' => true, 'msg' => trans('crud.success_updated'), 'url' => url('/m/projects')]);
		}

		return \Response::json(['result' => false, 'msg' => 'School record could not be found.', 'url' => url('/m/projects')]);
	}

	public function getSchools($id)
	{
		$this->access('manage:schools');

		$project = Projects::find($id);

		if (isset($project)) {
			$schools = $project->schools;
		} 

		foreach ($schools as $school) {
			$school->classes_count  = Classroom::where('school_id',$school->id)->count();

			$school->students_count = Student::where('school_id',$school->id)->count();
		}

		$school_board = $this->user->school_board->first();

		if (isset($school_board)) {
			$school_list = $school_board->schools;
		} else {
			$school_list = $this->user->schools;
			if(!$school_list->isEmpty()) {
				$school_board = SchoolBoard::findOrFail($this->user->schools->first()->school_board_id);
			} else {
				return \Redirect::to('/admin');
			}
		}

		$school_lists = Projects::getSchools($school_list);
		$schoolIds = array();

		foreach ($schools as $school) {
			$schoolIds[] = $school->id;
		}

		$data = [
			'page'         => 'projects/school',
			'project_id'   => $id,
			'project_name' => $project->project_name,
			'school_board' => $school_board,
			'schools'      => $schools,
			'school_list'  => $school_lists,
			'schoolIds'	   => $schoolIds,
		];

		return \View::make('front.manage.items.school_project', $data);
	}
	
	public function postSchoolAdd(Request $request){
		$rules = [
			'school_id' => 'required',
		];

		$this->validate($request, $rules);
		
		$schoolProject = SchoolProject::where('project_id',$request->input('project_id'))->delete();
		
		$project_id = $request->input('project_id');
		foreach($request->input('school_id') as $school_id)
		{
			$data = array();
			$data['school_id'] = $school_id;
			$data['project_id'] = $project_id;

			$schoolProject = new SchoolProject;

			$schoolProject->fill($data);
			

			$schoolProject->save();

		}
		

		\Session::flash('success', trans('crud.success_added'));

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url('/m/projects/schools/'.\Input::get('project_id'))]);	
	}

	public function postRemove($id)
	{
		$project = Projects::find($id);

		if ($project)
		{
			$schoolProject = SchoolProject::where('project_id',$id)->delete();
			
			$project->delete();

			\Session::flash('success', trans('crud.success_removed'));

			return \Response::json(['result' => true, 'msg' => trans('crud.success_removed'), 'url' => url('/m/projects')]);
		}

		return \Response::json(['result' => false, 'msg' => 'Project record could not be found.', 'url' => url('/m/projects')]);
	}

	public function postSchoolRemove($id, $project_id){
		
		$projectSchool = SchoolProject::where('school_id',$id)->where('project_id',$project_id)->delete();
		

		if ($projectSchool)
		{
			//$projectSchool->delete();

			\Session::flash('success', trans('crud.success_removed'));

			return \Response::json(['result' => true, 'msg' => trans('crud.success_removed'), 'url' => url('/m/projects/schools/'.$project_id)]);
		}

		return \Response::json(['result' => false, 'msg' => 'School record could not be found.', 'url' => url('/m/projects/schools/'.$project_id)]);	
	}
}