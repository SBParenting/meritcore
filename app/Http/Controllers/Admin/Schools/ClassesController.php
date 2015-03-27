<?php

namespace App\Http\Controllers\Admin\Schools;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\User;
use App\Models\Classroom as Record;
use App\Models\Student;
use App\Models\Campaign;
use App\Models\School;
use App\Models\SchoolBoard;

class ClassesController extends AdminController {

	protected $view_path = 'schools.classes';

	protected $base_url = '/admin/s/classes';

	public function __construct()
	{
		$this->access('system:manage_schools');

		\View::share(['nav_level1' => 'schools.classes', 'nav_level2' => 'schools.classes']);
	}

	public function getIndex()
	{
		$this->sorting( Record::$defaultSort );

		$list = Record::getListable()->paginate(20);

		return \View::make("admin.$this->view_path.list")->with('records', $list);
	}

	public function getInfo($id)
	{
		$record = Record::with('school')->findOrFail($id);

		$data = [
			'record'  => $record,
			'section' => 'overview',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getInfoStudents($id)
	{
		$record = Record::findOrFail($id);

		$this->sorting( Record::$defaultSort, $this->base_url.'/info-students' );

		$records = Student::getListable( Student::where('classroom_id', '=', $id) )->paginate(20);

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

		$records = Campaign::getListable( Campaign::where('class_id', '=', $id) )->paginate(20);

		$data = [
			'record'  => $record,
			'records' => $records,
			'section' => 'surveys',
		];

		return \View::make("admin.$this->view_path.info", $data);
	}

	public function getAdd()
	{
		$data = [
			'grades' => Record::$grades,
		];

		return \View::make("admin.$this->view_path.form", $data);
	}

	public function getUpdate($id)
	{
		$record = Record::findOrFail($id);

		\Form::data($record->toArray());

		$data = [
			'grades'         => Record::$grades,
			'teachers'       => $record->school->getTeachers(),
			'record'		 => $record,
		];

		return \View::make("admin.$this->view_path.form", $data);
	}

	public function postAdd(Request $request)
	{
		$record = new Record;

		$this->validate($request, [
			'title'      => 'required',
			'grade'      => 'required',
			'teacher_id' => 'required',
	    ]);

		$record->fill(\Input::all())->save();

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url.'/info/'.$id) ]);

	}

	public function postUpdate(Request $request, $id)
	{
		$record = Record::findOrFail($id);

		if ($record)
		{
			$input = \Input::all();

			$this->validate($request, [
				'title'      => 'required',
				'grade'      => 'required',
				'teacher_id' => 'required',
		    ]);

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
			$record->delete();

			return \Response::json(['result' => true, 'msg' => trans('crud.success_removed')]);
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_removed')]);
	}

}