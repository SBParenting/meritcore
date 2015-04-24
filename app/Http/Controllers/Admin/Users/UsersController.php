<?php

namespace App\Http\Controllers\Admin\Users;


use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\User as Record;
use App\Models\Profile;
use App\Models\Role;

class UsersController extends AdminController {

	protected $view_path = 'users.users';

	protected $base_url = '/admin/users';

	public function __construct()
	{
		$this->access('system:manage_users');

		\View::share(['nav_level1' => 'users.list', 'nav_level2' => 'users.list']);
	}

	public function getIndex()
	{
		$this->sorting( Record::$defaultSort );
		
		$list = Record::getListable()->paginate(1000);
		//$list = Record::getListable()->paginate(20);

		return \View::make("admin.$this->view_path.list")->with('records', $list);
	}

	public function getAdd()
	{	
		$array = Role::getRoles(\Auth::user()->role_id);
		
		return \View::make("admin.$this->view_path.form")->with('roles', $array);
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

	public function postAvatar()
	{
		$email = \Input::get('email');

		if(!empty($email))
		{
			return \Response::json(['result' => true, 'msg' => trans('crud.success_process'), 'url' => Record::getAvatar( $email ) ]);
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_unknown')]);
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

	public function postBulk()
	{
		$count = 0;

		$failed = 0;

		$ids = array_values( \Input::get('ids') );

		if (!empty($ids))
		{
			foreach ($ids as $id)
			{
				$record = Record::find($id);

				if ($record && $record->updatable)
				{
					$input = $record->input(\Input::all());

					$record->fill($input)->save();

					$count++;
				}
				else
				{
					$failed++;
				}
			}

			if ($count > 0)
			{
				return \Response::json(['result' => true, 'msg' => trans('crud.success_updated_bulk', ['count' => $count]), 'url' => url($this->base_url) ]);
			}
			else
			{
				return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated_bulk', ['count' => $failed]) ]);
			}
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated')]);
	}

	public function postRemove($id)
	{
		if ($id=='bulk' && \Input::get('ids'))
		{
			$ids = array_values( \Input::get('ids') );

			if (!empty($ids))
			{
				$count = Record::whereIn('id', $ids)->where('deletable', '=', '1')->delete();

				Profile::whereIn('user_id', $ids)->delete();

				return \Response::json(['result' => true, 'msg' => trans('crud.success_removed_bulk', ['count' => $count]), 'url' => url($this->base_url) ]);
			}
		}
		else
		{
			$record = Record::find($id);

			if ($record && $record->deletable)
			{
				$record->delete();

				if ($record->profile)
				{
					$record->profile->delete();
				}

				return \Response::json(['result' => true, 'msg' => trans('crud.success_removed')]);
			}
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_removed')]);
	}

	public function postMail($id)
	{
		if ($id=='bulk' && \Input::get('ids'))
		{
			$count = 0;

			$ids = array_values( \Input::get('ids') );

			if (!empty($ids))
			{
				$count++;

				foreach ($ids as $id)
				{
					$record = Record::find($id);

					if ($record)
					{
						$record->sendMail();
					}
				}

				return \Response::json(['result' => true, 'msg' => trans('crud.success_process', ['count' => $count]), 'url' => url($this->base_url) ]);
			}
		}
		else
		{
			$record = Record::find($id);

			if ($record)
			{
				$record->sendMail();

				return \Response::json(['result' => true, 'msg' => trans('crud.success_process')]);
			}
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_process')]);
	}
}