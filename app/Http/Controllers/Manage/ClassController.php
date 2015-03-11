<?php namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\User;
use App\Models\Role;
use App\Models\StudentAssoc;
use Illuminate\Http\Request;

class ClassController extends Controller {

	public function postUpdate(Request $request, $id)
	{
		$class = Classroom::find($id);

		if ($class)
		{
			$rules = [
				'title'      => 'required',
				'grade'      => 'required',
			];

			if ($request->input('teacher_first_name') || $request->input('teacher_last_name') || $request->input('teacher_email'))
			{
				$rules['teacher_first_name'] = 'required';
				$rules['teacher_last_name']  = 'required';
				$rules['teacher_email']      = 'required|email|unique:users,email';
			}

			$this->validate($request, $rules);

			$class->fill($request->input());

			$class->save();

			if ($request->input('teacher_first_name') && $request->input('teacher_last_name') && $request->input('teacher_email'))
			{
				$user = new User;

				$user->first_name = $request->input('teacher_first_name');
				$user->last_name = $request->input('teacher_last_name');
				$user->email = $request->input('teacher_email');
				$user->username = $user->email;
				$user->status = 'Invited';

				$role = Role::where('name', '=', 'teacher')->first();

				if ($role)
				{
					$user->role_id = $role->id;
				}

				$user->save();

				$class->teacher_id = $user->id;
				$class->save();
			}

			return \Response::json(['result' => true, 'msg' => trans('crud.success_updated')]);
		}

		abort(404);
	}

	public function postAdd(Request $request)
	{
		$rules = [
			'title'         => 'required',
			'grade'         => 'required',
			'teacher_email' => 'unique:users,email',
		];

		if (!$request->input('teacher_id'))
		{
			//$rules['teacher_id']         = 'required';
			$rules['teacher_first_name'] = 'required';
			$rules['teacher_last_name']  = 'required';
			$rules['teacher_email']      = 'required|email|unique:users,email';
		}

		$this->validate($request, $rules);

		$class = new Classroom;

		$class->fill($request->input());

		$class->save();

		if ($request->input('teacher_first_name') && $request->input('teacher_last_name') && $request->input('teacher_email'))
		{
			$user = new User;

			$user->first_name = $request->input('teacher_first_name');
			$user->last_name = $request->input('teacher_last_name');
			$user->email = $request->input('teacher_email');
			$user->username = $user->email;
			$user->status = 'Invited';

			$role = Role::where('name', '=', 'teacher')->first();

			if ($role)
			{
				$user->role_id = $role->id;
			}

			$user->save();

			$class->teacher_id = $user->id;
			$class->save();

			//$school = $class->school;
		}

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url('/m/classes/'.$class->id)]);
	}
}