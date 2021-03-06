<?php

namespace Controllers\Admin\Users;

use User as Record;
use Profile;

class UsersController extends \BaseController {

	protected $view_path = 'users.users';

	protected $base_url = '/admin/users';

	public function __construct()
	{
		$this->access('system:manage_users');
		
		\View::share(['nav_level1' => 'users', 'nav_level2' => 'users.list']);
	}

	public function getIndex()
	{
		$list = Record::getListable()->paginate(20);

		$this->sorting( Record::$sorting );

		return \View::make("admin.$this->view_path.list")->with('records', $list);
	}

	public function getAdd()
	{
		return \View::make("admin.$this->view_path.form");
	}

	public function getUpdate($id)
	{
		$record = Record::findOrFail($id);

		\Form::data($record->toArray());

		\Form::data($record->profile->toArray());

		return \View::make("admin.$this->view_path.form")->with('user', $record);
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

	public function postAdd()
	{
		$record = new Record;

		$val = $record->validator()->with(\Input::all())->action('create');

		if (!$val->passes())
		{
			return $val->toJsonResponse();
		}
		else 
		{
			$record->fill($val->data())->save();

			$record->updateProfile($val->data());

			return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url) ]);		
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_added')]);
	}

	public function postUpdate($id)
	{
		$record = Record::findOrFail($id);

		if ($record->updatable)
		{
			$input = \Input::all();

			$input['id'] = $id;

			$val = $record->validator()->with( $input )->action('update');

			if (!$val->passes())
			{
				return $val->toJsonResponse();
			}
			else 
			{
				$record->fill($val->data())->save();

				$record->updateProfile($val->data());

				return \Response::json(['result' => true, 'msg' => trans('crud.success_updated'), 'url' => url($this->base_url) ]);		
			}
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