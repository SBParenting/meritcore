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

		$data = [];

		if ($survey)
		{
			$school = $survey->school;

			$data = [
				'school' => $school,
				'survey' => $survey,
			];
		}

		$filename = str_random(10).'.png';

	    $gdata = [];

	    foreach ($survey->stats as $stat)
	    {
	    	$gdata[] = [$stat->grouping->title, $stat->strong_count, $stat->vulnerable_count];
	    }

		$plot = new \PHPlot(600, 400, $filename);

		$plot->SetImageBorderType('plain');

		$plot->SetTTFPath('/usr/share/fonts/truetype/droid/');
		$plot->SetFontTTF('x_label', 'DroidSans.ttf', 8);

		$plot->SetPlotType('stackedbars');
		$plot->SetDataType('text-data');
		$plot->SetDataValues($gdata);

		//$plot->SetTitle('Candy Sales by Month and Product');
		//$plot->SetYTitle('Millions of Units');

		# No shading:
		//$plot->SetShading(0);

		$plot->SetLegend(array('Strong', 'Vulnerable'));
		# Make legend lines go bottom to top, like the bar segments (PHPlot > 5.4.0)
		$plot->SetLegendReverse(True);

		$plot->SetXDataLabelAngle(-70);

		$plot->SetXTickLabelPos('none');
		$plot->SetXTickPos('none');

		$plot->SetDataColors([[149, 54, 34],[90, 156, 19],]);

		$plot->SetYDataLabelPos('plotstack');
		$plot->SetXDataLabelPos('plotdown');
		$plot->SetLegendPosition(1, 0, 'plot', 1, 0, -5, 5);
		$plot->SetIsInline(true);
		$plot->SetOutputFile( app_path() . '/../public/front/img/report/charts/' . $filename );
		$plot->DrawGraph();

	    $data['chart'] = $filename;

		//return \View::make('front.manage.reports.impact', $data)->render();
		
		$pdf = \PDF::loadView('front.manage.reports.impact', $data);
		
		return $pdf->stream();
	}
}