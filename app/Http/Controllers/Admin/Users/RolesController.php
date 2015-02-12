<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Role;
use App\Models\Permission;

class RolesController extends AdminController {

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
			$role = Role::with('perms')->first();
		}
		else {

			$role = Role::with('perms')->find( $id );
		}

		if ($role)
		{
			$data = [
				'role'        => $role,
				'roles'       => Role::all(),
				'permissions' => Permission::all(),
			];

			return \View::make('admin.users.roles.list', $data);
		}

		\App::abort(404);
	}

	public function postUpdate($id)
	{
		$role = Role::find( $id );

		if ($role )
		{
			foreach (\Input::except('_token') as $id => $value)
			{
				if ($value === true)
				{
					$role->perms()->attach($id);
				}
				else
				{
					$role->perms()->detach($id);
				}
			}

			return \Response::json(['result' => true, 'msg' => trans('crud.success_updated') ]);
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated')]);
	}
}