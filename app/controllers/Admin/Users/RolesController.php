<?php

namespace Controllers\Admin\Users;

class RolesController extends \BaseController {

	public function __construct()
	{
		$this->access('system:manage_roles');

		\View::share('nav_level1', 'users');
		\View::share('nav_level2', 'users.roles');
	}

	public function getIndex($id=false)
	{
		if ($id===false) 
		{
			$role = \Role::first();
		}
		else {

			$role = \Role::find( $id );	
		}

		if ($role)
		{
			$data = [
				'role'  => $role,
				'roles' => \Role::all(),
			];

			return \View::make('admin.users.roles.list', $data);
		}

		\App::abort(404);
	}

	public function postUpdate($id)
	{
		$role = \Role::find( $id );	

		if ($role )
		{
			if ($role->updatable)
			{
				$role->updatePermissions(\Input::all())->save();

				return \Response::json(['result' => true, 'msg' => trans('crud.success_updated') ]);
			} 
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated')]);
	}
}