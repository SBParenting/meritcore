<?php namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\StudentAssoc;
use App\Models\Campaign;
use App\Models\CampaignStudent;
use Illuminate\Http\Request;

class SurveyController extends Controller {

	public function postAdd(Request $request, $id)
	{
		$class = Classroom::with('students')->find($id);

		if ($class)
		{
			$this->validate($request, [
				'school_id' => 'required',
				'class_id'  => 'required',
				'title'     => 'required',
				'survey_id' => 'required',
			]);

			$survey = new Campaign;

			$survey->fill($request->input());
			$survey->secret = str_random(6);
			$survey->status = 'Active';
			$survey->start_date = new \DateTime;
			$survey->count_total = count($class->students);
			$survey->save();

			foreach ($class->students as $student)
			{
				CampaignStudent::create([
					'campaign_id' => $survey->id,
					'student_id'  => $student->id,
					'secret'      => str_random(50),
					'status'      => 'NotStarted',
					'count_total' => count($survey->survey->questions)
				]);
			}

			$class->updateSurveyStatus();

			return \Response::json(['result' => true, 'msg' => trans('crud.success_added')]);
		}

		abort(404);
	}

	public function postComplete(Request $request, $id, $survey_id)
	{
		$class = Classroom::with('students')->find($id);

		if ($class)
		{
			$survey = Campaign::find($survey_id);
			$survey->status = 'Completed';
			$survey->end_date = new \DateTime;
			$survey->save();

			$survey->generateResults();

			$class->updateSurveyStatus();

			return \Response::json(['result' => true, 'msg' => trans('crud.success_updated')]);
		}

		abort(404);
	}

	public function getReport($id)
	{
		$survey = Campaign::with('stats', 'stats.grouping')->find($id);

		if ($survey)
		{
			$school = $survey->school;

			$data = [
				'school' => $school,
				'survey' => $survey,
			];
		}

		//return \View::make('front.manage.reports.impact', $data)->render();

		$pdf = \App::make('snappy.pdf.wrapper');
		$pdf->loadView('front.manage.reports.impact', $data);
		
		return $pdf->stream();
	}
}