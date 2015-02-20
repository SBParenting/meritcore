<?php namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Student as Record;
use App\Models\Campaign;
use App\Models\CampaignStudent;
use App\Models\Classroom;
use App\Models\School;
use App\Models\StudentAssoc;
use Illuminate\Http\Request;

class StudentsController extends Controller {

	public function postStudentAdd(Request $request)
	{
		$this->validate($request, [
			'school_id'           => 'required',
			'class_id'            => 'required',
			'sid'				  => 'required|unique,students,sid',
			'first_name'          => 'required',
			'last_name'           => 'required',
			'date_birth'          => 'required|date',
			'grade'               => 'required',
			'email'               => 'required|email',
			'address_street'      => 'required',
			'address_city'        => 'required',
			'address_province'    => 'required',
			'address_country'     => 'required',
			'address_postal_code' => 'required',
		]);

		$record = new Record;

		$record->fill($request->input());

		$record->save();

		StudentAssoc::create([
			'student_id' => $record->id,
			'school_id'  => $request->input('school_id'),
			'class_id'   => $request->input('class_id'),
		]);

		$class = Classroom::find($request->input('class_id'));

		if ($class)
		{
			$class->updateRecord()->save();

			$survey = Campaign::where('class_id', '=', $class->id)->where('status', '=', 'Active')->first();

			if ($survey)
			{
				CampaignStudent::create([
					'campaign_id' => $survey->id,
					'student_id'  => $record->id,
					'secret'      => str_random(50),
					'status'      => 'NotStarted',
					'count_total' => count($survey->survey->questions)
				]);

				$survey->updateRecord();
			}
		}

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added')]);
	}
}