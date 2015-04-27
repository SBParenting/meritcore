<?php

namespace App\Http\Controllers\Admin\Schools;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Role;
use App\Models\User AS USER;
use App\Models\UserAssoc;
use App\Models\School;
use App\Models\SchoolBoard as Record;
use App\Models\UserRole as UserRole;

class BoardsController extends AdminController {

	protected $view_path = 'schools.boards';

	protected $base_url = '/admin/s/boards';

	public function __construct()
	{
		$this->access('system:manage_schoolboards');

		\View::share(['nav_level1' => 'schools.boards', 'nav_level2' => 'schools.boards']);
	}

	public function getIndex()
	{
		$this->sorting( Record::$defaultSort );

		$list = Record::getListable()->paginate(20);

		return \View::make("admin.$this->view_path.list")->with('records', $list);
	}

	public function getInfo($id)
	{
		$record = Record::findOrFail($id);

		$data = [
			'record'  => $record,
			'section' => 'overview',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getInfoSchools($id)
	{
		$record = Record::findOrFail($id);

		$this->sorting( Record::$defaultSort, $this->base_url.'/info-schools' );

		$records = School::getListable( School::where('school_board_id', '=', $id) )->paginate(20);

		$data = [
			'record'  => $record,
			'records' => $records,
			'section' => 'schools',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getInfoUsers($id)
	{
		$record = Record::findOrFail($id);

		$this->sorting( Record::$defaultSort, $this->base_url.'/info-users' );

		$ids = [];
		$records = [];

		foreach (UserAssoc::where('school_board_id', '=', $id)->get() as $row)
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
		return \View::make("admin.$this->view_path.form");
	}

	public function getAddSchool($id)
	{
		$record = Record::findOrFail($id);

		$data = [
			'record'  => $record,
			'section' => 'addschool',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getAddUser($id)
	{
		$record = Record::findOrFail($id);

		$data = [
			'record'  => $record,
			'section' => 'adduser',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getUpdate($id)
	{
		$record = Record::findOrFail($id);

		\Form::data($record->toArray());

		return \View::make("admin.$this->view_path.form")->with('record', $record);
	}

	public function postAdd(Request $request)
	{
		$record = new Record;

		$this->validate($request, [
			'name'     => 'required',
			'email'    => 'required|email',
			'province' => 'required',
			'country'  => 'required',
	    ]);

		$record->fill(\Input::all())->save();

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url.'/info/'.$record->id) ]);

	}

	public function postAddSchool(Request $request, $id)
	{
		$record = new School;

		$this->validate($request, [
			'name'         => 'required',
			'email'        => 'email',
			'address_city' => 'required',
	    ]);


	    $input = \Input::all();

	    $input['school_board_id'] = $id;

		$record->fill($input)->save();

		$schoolBoard = SchoolBoard::where('id',$id)->first();
		$school_count = School::where('school_board_id',$id)->count();
		$schoolBoard->schools_count = $school_count;
		$schoolBoard->save();


		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url('admin/s/schools/info/'.$record->id) ]);

	}

	public function postAddUser(Request $request, $id)
	{
		$record = Record::findOrFail($id);
		
		if ($record)
		{
			$this->validate($request, [
				'user_id' => 'required'
		    ]);

		    $input['user_id'] = \Input::get('user_id');

		    $input['role_id'] = Role::where('name', '=', 'school_board')->first()->id;

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
				'school_board_id' => $id,
			]);

			//$record->sendMail();

			
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
				'name'     => 'required',
				'email'    => 'required|email',
				'province' => 'required',
				'country'  => 'required',
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
			$schools_count = School::where('school_board_id', '=', $id)->count();

			if ($schools_count == 0)
			{
				$board = $record->board;

				$record->delete();

				if ($board)
				{
					$board->updateRecord()->save();
				}

				return \Response::json(['result' => true, 'msg' => trans('crud.success_removed'), 'url' => url($this->base_url)]);
			}

			return \Response::json(['result' => false, 'msg' => 'Whoa, there are '.$schools_count.' ' . str_plural('school', $schools_count) . ' linked to this record, you cannot delete it.']);
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