<?php namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\StudentAssoc;
use App\Models\PostSurveyQuestion;
use App\Models\PostSurveyAnswers;
use App\Models\Campaign;
use App\Models\CampaignStudent;
use App\Models\CampaignStudentInfo;
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

		if (!\Input::has('chart1'))
		{
			$gdata = [];

			$categories = [];
			$strong = [];
			$vulnerable = [];
			//dd($survey->stats);
		      foreach ($survey->stats as $stat)
			   {
				$gdata[]=[
				'categories'=>$stat->grouping->title,
				'strong' => (int)$stat->strong_count,
				'vulnerable' => (int)$stat->vulnerable_count];
			   }

 			 $data['gdata'] = $gdata;

 			$data2 = [];
 			$data2[] = ['Question','Yes','No'];
 			$questions = ['question_2' => 'My instructor\'s approch and style of presenting was enjoyable for me.',
 				'question_3' => 'The HEROES® program offered good information that I am able to understand and use.',
 				'question_4' => 'We discussed things in the HEROES® classes that are meaningful and important to me.',
 				'question_5' => 'I felt listened to and respected as I participated in the HEROES® classes.'];
 			 
	 		foreach ($questions as $key => $value) {
	 			$yesCount = CampaignStudentInfo::where('campaign_id',$id)->where($key,1)->count();
	 			$noCount = CampaignStudentInfo::where('campaign_id',$id)->where($key,0)->count();
	 			array_push($data2, array($value,$yesCount,$noCount));
	 			//array_push($data2, array('title' => $value,'yes' => $yesCount,'no' => $noCount));
	 		}
	 		$data['gdata_2'] = $data2;

 			if($survey->survey_id == 3 || $survey->survey_id == 4 ){
 			 	$data3 = [];
 			 	$data2[] = ['Question','Yes','No'];
 			 	$questions = PostSurveyQuestion::where('survey_id',$survey->survey_id)->get();
 			 
	 			 if($questions){
	 			 	foreach ($questions as $question) {
	 			 		$yesCount = PostSurveyAnswers::where('campaign_id',$id)->where('question_id',$question->id)->where('answer',1)->count();
	 			 		$noCount = PostSurveyAnswers::where('campaign_id',$id)->where('question_id',$question->id)->where('answer',0)->count();
	 				 	array_push($data3, array('title' => $question->title,'yes' => $yesCount,'no' => $noCount));
	 				 }
	 			 }

	 			 $data['gdata_3'] = $data3;
	 		}
 			 
		    $data['categories'] = $categories;

			return \View::make('front.manage.reports.chart', $data)->render();
		}
		else
		{
			
			$chart = \Input::get('chart2');
			$filename = 'report-chart-participant-'.$survey->id.'.png';
			$image = \Image::make($chart);
			$image->save(app_path() . '/../public/front/img/report/charts/' . $filename);
		    $data['participant'] = $filename;

		    $data2 = [];
 			//$data2[] = ['Question','Yes','No'];
 			$questions = ['question_2' => 'My instructor\'s approch and style of presenting was enjoyable for me.',
 				'question_3' => 'The HEROES® program offered good information that I am able to understand and use.',
 				'question_4' => 'We discussed things in the HEROES® classes that are meaningful and important to me.',
 				'question_5' => 'I felt listened to and respected as I participated in the HEROES® classes.'];
 			 
	 		foreach ($questions as $key => $value) {
	 			$yesCount = CampaignStudentInfo::where('campaign_id',$id)->where($key,1)->count();
	 			$noCount = CampaignStudentInfo::where('campaign_id',$id)->where($key,0)->count();
	 			array_push($data2, array($value,$yesCount,$noCount));
	 			//array_push($data2, array('title' => $value,'yes' => $yesCount,'no' => $noCount));
	 		}
	 		$data['gdata_2'] = $data2;


		    $chart = \Input::get('chart3');
		    if($chart != ""){
		    	$filename = 'report-chart-impact-'.$survey->id.'.png';
				$image = \Image::make($chart);
				$image->save(app_path() . '/../public/front/img/report/charts/' . $filename);
			    $data['impact'] = $filename;
		    }
			
			$chart = \Input::get('chart1');
			$filename = 'report-chart-ccc'.$survey->id.'.png';
			$image = \Image::make($chart);
			$image->save(app_path() . '/../public/front/img/report/charts/' . $filename);
		    $data['ccc'] = $filename;


			//return \View::make('front.manage.reports.impact', $data)->render();
			
			$pdf = \PDF::loadView('front.manage.reports.impact', $data);
			$pdf->setPaper('letter');

			return $pdf->stream();
			//dd($pdf->stream());
		}
	}
}