<?php

namespace App\Http\Controllers\Admin\Schools;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\User;
use App\Models\UserAssoc;
use App\Models\School as Record;
use App\Models\Classroom;
use App\Models\Campaign;
use App\Models\Role;
use App\Models\Student;
use App\Models\StudentAssoc;
use App\Models\SchoolBoard;
use App\Models\UserRole as UserRole;

class SchoolsController extends AdminController {

	protected $view_path = 'schools.schools';

	protected $base_url = '/admin/s/schools';

	public function __construct()
	{
		$this->access('system:manage_schools');

		\View::share(['nav_level1' => 'schools.schools', 'nav_level2' => 'schools.schools']);
	}

	public function getIndex()
	{
		$this->sorting( Record::$defaultSort );

		$list = Record::getListable()->paginate(20);

		return \View::make("admin.$this->view_path.list")->with('records', $list);
	}

	public function getInfo($id)
	{
		$record = Record::with('board')->findOrFail($id);

		$data = [
			'record'  => $record,
			'section' => 'overview',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getInfoClasses($id)
	{
		$record = Record::findOrFail($id);

		$this->sorting( Record::$defaultSort, $this->base_url.'/info-classes' );

		$records = Classroom::getListable( Classroom::where('school_id', '=', $id) )->paginate(20);

		$data = [
			'record'  => $record,
			'records' => $records,
			'section' => 'classes',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getInfoStudents($id)
	{
		$record = Record::findOrFail($id);

		$this->sorting( Record::$defaultSort, $this->base_url.'/info-students' );

		$records = Student::getListable( Student::where('school_id', '=', $id) )->paginate(20);

		$data = [
			'record'  => $record,
			'records' => $records,
			'section' => 'students',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getInfoSurveys($id)
	{
		$record = Record::findOrFail($id);

		$this->sorting( Record::$defaultSort, $this->base_url.'/info-surveys' );

		$records = Campaign::getListable( Campaign::where('school_id', '=', $id) )->paginate(20);

		$data = [
			'record'  => $record,
			'records' => $records,
			'section' => 'surveys',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getInfoUsers($id)
	{
		$record = Record::findOrFail($id);

		$this->sorting( Record::$defaultSort, $this->base_url.'/info-users' );

		$ids = [];
		$records = [];

		foreach (UserAssoc::where('school_id', '=', $id)->get() as $row)
		{
			$ids[] = $row->user_id;
		}

		if (!empty($ids))
		{
			$records = User::getListable( User::whereIn('users.id', $ids) )->paginate(20);
		}
		else
		{
			$ids = [];
		}

		$data = [
			'record'  => $record,
			'section' => 'users',
			'records' => $records,
		];

		return \View::make("admin.$this->view_path.info", $data);
	}


	public function getAdd()
	{
		$list = [];

		foreach (SchoolBoard::orderBy('name', 'asc')->get() as $row)
		{
			$list[$row->id] = $row->name;
		}

		$data = [
			'school_boards' => $list,
		];

		return \View::make("admin.$this->view_path.form", $data);
	}

	public function getAddClass($id)
	{
		$record = Record::findOrFail($id);

		$data = [
			'record'   => $record,
			'section'  => 'addclass',
			'grades'   => Classroom::$grades,
			'teachers' => $record->getTeachers(),
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getAddStudent($id)
	{
		$record = Record::findOrFail($id);

		$data = [
			'record'  => $record,
			'grades'  => Classroom::$grades,
			'section' => 'addstudent',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getAddSurvey($id)
	{
		$record = Record::findOrFail($id);

		$data = [
			'record'  => $record,
			'section' => 'addsurvey',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getAddUser($id)
	{
		$record = Record::findOrFail($id);

		$roles = [];

		foreach (Role::whereNotIn('name', ['admin', 'school_board'])->get() as $row)
		{
			$roles[$row->id] = $row->display_name;
		}

		$data = [
			'record'  => $record,
			'section' => 'adduser',
			'roles'	  => $roles,
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getUpdate($id)
	{
		$record = Record::findOrFail($id);

		\Form::data($record->toArray());

		$list = [];

		foreach (SchoolBoard::orderBy('name', 'asc')->get() as $row)
		{
			$list[$row->id] = $row->name;
		}

		$data = [
			'school_boards' => $list,
			'record'        =>  $record,
		];

		return \View::make("admin.$this->view_path.form", $data);
	}

	public function postAdd(Request $request)
	{
		$record = new Record;

		$this->validate($request, [
			'school_board_id' => 'required',
			'name'            => 'required',
			'email'           => 'email',
			'address_city'    => 'required',
	    ]);

		$record->fill(\Input::all())->save();

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url.'/info/'.$record->id) ]);

	}

	public function postAddClass(Request $request, $id)
	{
		$record = new User;

		$record = new Classroom;

		$this->validate($request, [
			'title'      => 'required',
			'grade'      => 'required',
			'teacher_id' => 'required',
	    ]);

	    $input = \Input::all();

	    $input['school_id'] = $id;
	    $input['status'] = 'Active';

		$record->fill($input)->save();

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url.'/info-classes/'.$id) ]);

	}

	public function postAddStudent(Request $request, $id)
	{
		$this->validate($request, [
			'sid'				  => 'required|unique:students,sid',
			'first_name'          => 'required',
			'last_name'           => 'required',
			'date_birth'          => 'date',
			'grade'               => 'required',
		]);

		$record = new Student;

		$input = $request->input();

		$input['school_id'] = $id;

		$record->fill($input)->save();

		StudentAssoc::create([
			'student_id' => $record->id,
			'school_id'  => $id,
		]);

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url.'/info-students/'.$id)]);
	}

	public function postAddUser(Request $request, $id)
	{
		$record = Record::findOrFail($id);
		
		if ($record)
		{
			$this->validate($request, [
				'user_id' => 'required',
				'role_id' => 'required'
		    ]);

		    $input['user_id'] = \Input::get('user_id');

		    $input['role_id'] = \Input::get('role_id');

		    //$role = UserRole::where('user_id',$input['user_id'])->first();
		    
		    
		    $user = User::findOrFail($input['user_id']);

		    $user->roles()->detach();
		    $user->roles()->attach($input['role_id']);

		    // $user->roles()->updateExistingPivot($input['role_id'],['user_id' => $input['user_id'], 'role_id' => $input['role_id']],true);

		    $user->save();

			// if(isset($role)){ $role->delete();}
			
			// $role = new UserRole; 
			// $role->fill($input)->save();

		    $input['status']  = 'Active';
		    
		    $user = User::findOrFail($input['user_id']);
		    $user->fill($input)->save();

		    $userAssoc = UserAssoc::where('user_id',$input['user_id'])->first();
		    
		    if(isset($userAssoc)){ $userAssoc->delete();}

			UserAssoc::create([
				'user_id'         => $input['user_id'],
				'school_id' => $id,
			]);

			$record->sendMail();

			
			return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url.'/info-users/'.$id) ]);
		}
		return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated')]);

	}

	public function postUpdate(Request $request, $id)
	{
		$record = Record::findOrFail($id);

		if ($record)
		{
			$input = \Input::all();

			$this->validate($request, [
				'school_board_id' => 'required',
				'name'            => 'required',
				'email'           => 'email',
				'address_city'    => 'required',
		    ]);

		    $input['id'] = $id;

			$record->fill($input)->save();

			$record->updateRecord()->save();

			return \Response::json(['result' => true, 'msg' => trans('crud.success_updated'), 'url' => url($this->base_url.'/info/'.$id) ]);
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated')]);
	}

	public function postRemove($id)
	{
		$record = Record::find($id);

		if ($record)
		{
			if ($record->students_count + $record->classes_count + $record->surveys_total_count == 0)
			{
				$record->delete();

				return \Response::json(['result' => true, 'msg' => trans('crud.success_removed'), 'url' => url($this->base_url)]);
			}
			
			return \Response::json(['result' => false, 'msg' => 'Whoa, there are still students and classes linked to this record, you cannot delete it.']);			
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_removed')]);
	}
	
	public function postRemoveUser($id)
	{
		$user = User::find($id);
		 if($user){
		 	
		 	//Updating Entery to User table
			$user->update(array('role_id' => null));
			$user->save();

			//Removing Entery from UserRole table
			$user->roles()->detach();

			//Deleting Entery from User Associations table
			$userAssoc = UserAssoc::where('user_id',$id);
			$userAssoc->delete();

			return \Response::json(['result' => true, 'msg' => trans('crud.success_removed')]);
		}
		return \Response::json(['result' => false, 'msg' => trans('crud.failed_removed')]);

	}
}