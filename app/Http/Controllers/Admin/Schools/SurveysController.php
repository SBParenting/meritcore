<?php

namespace App\Http\Controllers\Admin\Schools;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\User as Record;
use App\Models\School;
use App\Models\SchoolBoard;

class SurveysController extends AdminController {

	protected $view_path = 'schools.surveys';

	protected $base_url = '/admin/s/surveys';

	public function __construct()
	{
		$this->access('system:manage_schools');

		\View::share(['nav_level1' => 'schools.surveys', 'nav_level2' => 'schools.surveys']);
	}

	public function getIndex()
	{
		$list = Record::getListable()->paginate(20);

		$this->sorting( Record::$sorting );

		return \View::make("admin.$this->view_path.list")->with('records', $list);
	}

	public function getAdd()
	{
		return \View::make("admin.$this->view_path.form")->with('roles', Role::all());
	}

	public function getUpdate($id)
	{
		$record = Record::findOrFail($id);

		\Form::data($record->toArray());

		if ($record->profile)
		{
			\Form::data($record->profile->toArray());
		}

		return \View::make("admin.$this->view_path.form")->with('user', $record)->with('roles', Role::all());
	}

	public function postAdd(Request $request)
	{
		$record = new Record;

		$this->validate($request, [
			'first_name' => 'required',
			'last_name'  => 'required',
			'username'   => 'required|min:4|unique:users,username',
			'email'      => 'required|email|unique:users,email',
			'password'   => 'required|min:6|confirmed',
			'role_id'	 => 'required',
			'status'	 => 'required',
	    ]);

		$record->fill(\Input::all())->save();

		$record->updateProfile(\Input::all());

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url) ]);

	}

	public function postUpdate(Request $request, $id)
	{
		$record = Record::findOrFail($id);

		if ($record->updatable)
		{
			$input = \Input::all();

			$this->validate($request, [
				'first_name' => 'required',
				'last_name'  => 'required',
				'username'   => 'required|min:4|unique:users,username,'.$id,
				'email'      => 'required|email|unique:users,email,'.$id,
				'password'   => 'min:6|confirmed',
				'role_id'	 => 'required',
				'status'	 => 'required',
		    ]);

		    $input['id'] = $id;

			$record->fill($input)->save();

			$record->updateProfile($input);

			return \Response::json(['result' => true, 'msg' => trans('crud.success_updated'), 'url' => url($this->base_url) ]);
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated')]);
	}

}