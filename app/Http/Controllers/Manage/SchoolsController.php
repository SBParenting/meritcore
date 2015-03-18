<?php namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\User;
use App\Models\Role;
use App\Models\StudentAssoc;
use Illuminate\Http\Request;

class SchoolsController extends Controller {

	public function postUpdate(Request $request, $id)
	{
		$school = School::find($id);

		if ($school)
		{
			$rules = [
				'name'         => 'required',
				'address_city' => 'required',
			];

			$this->validate($request, $rules);

			$school->fill($request->input());

			$school->save();

			\Session::flash('success', trans('crud.success_updated'));

			return \Response::json(['result' => true, 'msg' => trans('crud.success_updated'), 'url' => url('/m/schools')]);
		}

		return \Response::json(['result' => false, 'msg' => 'School record could not be found.', 'url' => url('/m/schools')]);
	}

	public function postAdd(Request $request)
	{
		$rules = [
			'name'         => 'required',
			'address_city' => 'required',
		];

		$this->validate($request, $rules);

		$school = new School;

		$school->fill($request->input());

		$school->save();

		\Session::flash('success', trans('crud.success_added'));

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url('/m/schools')]);
	}

	public function postRemove($id)
	{
		$school = School::find($id);

		if ($school)
		{
			if ($school->classes_count + $school->students_count + $school->surveys_total_count == 0)
			{
				$school->delete();

				\Session::flash('success', trans('crud.success_removed'));

				return \Response::json(['result' => true, 'msg' => trans('crud.success_removed'), 'url' => url('/m/schools')]);
			}

			return \Response::json(['result' => false, 'msg' => 'School record cannot be deleted, has information attached.', 'url' => url('/m/schools')]);
		}

		return \Response::json(['result' => false, 'msg' => 'School record could not be found.', 'url' => url('/m/schools')]);
	}
}