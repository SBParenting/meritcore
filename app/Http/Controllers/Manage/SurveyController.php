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
		$survey = Campaign::with('classroom', 'stats', 'stats.grouping')->find($id);

		$data = [];

		if ($survey)
		{
			$school = $survey->school;

			$data = [
				'school' => $school,
				'survey' => $survey,
			];
		}

		if (!\Input::has('chart'))
		{
			$gdata = [];

			$categories = [];
			$strong = [];
			$vulnerable = [];

		      foreach ($survey->stats as $stat)
			   {
				$gdata[]=[
				'categories'=>$stat->grouping->title,
				'strong' => (int)$stat->strong_count,
				'vulnerable' => (int)$stat->vulnerable_count];
			   }

 			 $data['gdata'] = $gdata;

		    $data['categories'] = $categories;

			return \View::make('front.manage.reports.chart', $data)->render();
		}
		else
		{
			$chart = \Input::get('chart');
			$filename = 'report-chart-'.$survey->id.'.png';
			$image = \Image::make($chart);
			$image->save(app_path() . '/../public/front/img/report/charts/' . $filename);
		
		    $data['chart'] = $filename;

			//return \View::make('front.manage.reports.impact', $data)->render();
			
			$pdf = \PDF::loadView('front.manage.reports.impact', $data);
			$pdf->setPaper('letter');

			return $pdf->stream();
			//dd($pdf->stream());
		}
	}
}