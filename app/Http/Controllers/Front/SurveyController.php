<?php namespace App\Http\Controllers\Front;

use \Illuminate\Http\Request;
use \App\Models\Campaign;
use \App\Models\CampaignStudent;
use \App\Models\CampaignStudentInfo;
use \App\Models\Student;
use \App\Models\PostSurveyQuestion;
use \App\Models\PostSurveyAnswers;
use \App\Models\CampaignResult;

class SurveyController extends \App\Http\Controllers\Controller {

	public function getIndex($key)
	{

		$survey = Campaign::where('secret', '=', $key)->first();

		if ($survey)
		{
			//\\\Session::forget('student.survey.confirmed');

			if (\Session::has('student.survey.confirmed'))
			{
				$student = CampaignStudent::where('campaign_id', '=', $survey->id)->where('secret', '=', \Session::get('student.survey.confirmed'))->first();

				if ($student)
				{
					if ($student->status == 'Completed')
					{
						$data = [
							'key'     => $key,
							'student' => $student,
						];

						return \View::make('front.survey.complete', $data);
					}
					else
					{
						$questions = $survey->survey->getQuestions();

						$results = CampaignResult::where('campaign_student_id', '=', $student->id)->get();

						foreach ($results as $row)
						{
							if ($row->result > 0)
							{
								$question = $questions->where('id', $row->question_id)->first();
								$question->value = $row->result;
								$question->done = true;
							}
						}

						$data = [
							'key'       => $key,
							'student'   => $student,
							'campaign'  => $survey,
							'questions' => $questions,
						];

						if($survey->survey_id == 3 || $survey->survey_id == 4){
							return \View::make('front.survey.survey', $data);
						}
						else{
							return \View::make('front.survey.base', $data);
						}
						
						//
					}
				}
				else
				{
					$data = [
						'key'      => $key,
						'campaign' => $survey,
					];

					return \View::make('front.survey.confirm', $data);
				}
			}
			else
			{
				$data = [
					'key'      => $key,
					'campaign' => $survey,
				];

				return \View::make('front.survey.confirm', $data);
			}
		}

		abort(404);
	}

	public function postConfirm(Request $request, $key)
	{
		$survey = Campaign::where('secret', '=', $key)->first();

		if ($survey)
		{
			$this->validate($request, [
				'name' => 'required|max:255',
				'sid'  => 'required|max:255',
		    ]);

		    $name = $request->input('name');
		    $sid  = $request->input('sid');

		    $student = Student::query()
		    	->where(\DB::raw("LOWER(CONCAT(first_name,last_name))"), '=', strtolower(preg_replace("/[^A-Za-z0-9]/", "", $name)))
		    	->where('sid', '=', $sid)
		    	->first();

		    if ($student)
		    {
		    	$s = CampaignStudent::where('campaign_id', '=', $survey->id)->where('student_id', '=', $student->id)->first();

		    	if ($s)
		    	{
		    		if ($s->status == 'NotStarted')
		    		{
				    	$s->status = 'InProgress';
				    	$s->save();

				    	$survey->updateRecord();
				    }

				    \Session::put('student.survey.confirmed', $s->secret);

				    return \Response::json(['result' => true, 'msg' => 'Student information confirmed successfully!', 'url' => url("$key") ]);
			    }

				return \Response::json(['result' => false, 'msg' => 'Student is not participating in this survey.']);
		    }
		    else
		    {
				return \Response::json(['result' => false, 'msg' => 'The information you entered appears to be incorrect, please try again.', 'errors' => ['name' => 'Make sure to enter your first name followed by your last name.', 'sid' => 'Make sure to enter your complete student ID.']]);
		    }
		}

		return \Response::json(['result' => false, 'msg' => 'Could not confirm the student details.']);
	}

	public function postSave(Request $request, $key)
	{
		$survey = Campaign::where('secret', '=', $key)->first();

		if ($survey)
		{
			$this->validate($request, [
				'secret'	  => 'required',
				'question_id' => 'required|numeric',
				'result'      => 'required|numeric',
		    ]);

			$student = CampaignStudent::findByKey($request->input('secret'));

			$s = $student->student;

		    $data = [
				'campaign_id'         => $survey->id,
				'campaign_student_id' => $student->id,
				'school_board_id'     => $survey->school_board_id,
				'school_id'           => $survey->school_id,
				'class_id'            => $survey->class_id,
				'student_id'          => $s->id,
				'question_id'         => $request->input('question_id'),
		    ];

		    $record = CampaignResult::where($data)->first();

		    if ($record)
		    {
		    	$record->fill(['result' => $request->input('result')])->save();
		    }
		    else
		    {
		    	$data['result'] = $request->input('result');
		    	CampaignResult::create($data);
		    }

		    $survey->updateRecord();

		    $student->updateRecord();

		    $classroom = $survey->classroom;

		    if ($classroom)
		    {
			    $classroom->updateSurveyStatus();
			}

			return \Response::json(['result' => true, 'msg' => 'Successfully saved survey result.']);
		}

		return \Response::json(['result' => false, 'msg' => 'Could not confirm the student details.']);
	}


	public function postComplete(Request $request, $key)
	{
		$survey = Campaign::where('secret', '=', $key)->first();

		if ($survey)
		{
			$student = CampaignStudent::findByKey($request->input('secret'));

			$s = $student->student;

			$student->status = 'Completed';

			$student->save();

			$student->updateRecord();

			$survey->updateRecord();

			$classroom = $survey->classroom;

		    if ($classroom)
		    {
			    $classroom->updateSurveyStatus();
			}

			\Session::forget('student.survey.confirmed');

			\Session::flash('student.survey.confirmed', $request->input('secret'));

			return \Response::json(['result' => true, 'msg' => 'Successfully saved survey result.', 'url' => url("$key")]);
		}

		return \Response::json(['result' => false, 'msg' => 'Could not confirm the student details.']);
	}

	public function postAddInfo(Request $request, $key)
	{
		/*$this->validate($request, [
				'survey_id'		=> 'required',
				'question_1'	=> 'required',
				'question_2' 	=> 'required',
				'question_3'	=> 'required',
				'question_4'	=> 'required',
				'question_5'    => 'required'
		    ]);*/


		$studentInfo = new CampaignStudentInfo;

		$studentInfo->fill($request->all())->save();

		if($studentInfo){
			$survey = Campaign::where('secret', '=', $key)->first();
			$questions = PostSurveyQuestion::where('survey_id',$survey->survey_id)->get();

			$data = [
				'key'       => $key,
				'student_id'   => $studentInfo->student_id,
				'campaign_id'  => $studentInfo->campaign_id,
				'questions' => $questions,
			];
			if($survey->survey_id == 3 || $survey->survey_id == 4){
				return \View::make('front.survey.postsurvey', $data);
			}
			else{
				$survey = Campaign::where('secret', '=', $key)->first();
		
				$student = CampaignStudent::where('campaign_id', '=', $survey->id)->where('secret', '=', \Session::get('student.survey.confirmed'))->first();
				$questions = $survey->survey->getQuestions();

				$results = CampaignResult::where('campaign_student_id', '=', $student->id)->get();

				foreach ($results as $row)
				{
					if ($row->result > 0)
					{
						$question = $questions->where('id', $row->question_id)->first();
						$question->value = $row->result;
						$question->done = true;
					}
				}

				$data = [
					'key'       => $key,
					'student'   => $student,
					'campaign'  => $survey,
					'questions' => $questions,
				];

				return \View::make('front.survey.base', $data);

			}
			
		}

		return \Response::json(['result' => false, 'msg' => 'Could not save the student details.']);
	}

	public function postSavePostQuestion(Request $request, $keys)
	{
		$campaign_id = $request->campaign_id;
		$student_id = $request->student_id;
		if($request->get('question')){
		foreach($request->get('question') as $key => $value) {
			$answer = new PostSurveyAnswers;

			$data = array();

			$data['question_id'] = $key;
			$data['student_id'] = $student_id;
			$data['campaign_id'] = $campaign_id;
			$data['answer'] = $value;

			$answer->fill($data)->save();
		}
		}
		$survey = Campaign::where('secret', '=', $keys)->first();
		
		$student = CampaignStudent::where('campaign_id', '=', $survey->id)->where('secret', '=', \Session::get('student.survey.confirmed'))->first();
		$questions = $survey->survey->getQuestions();

		$results = CampaignResult::where('campaign_student_id', '=', $student->id)->get();

		foreach ($results as $row)
		{
			if ($row->result > 0)
			{
				$question = $questions->where('id', $row->question_id)->first();
				$question->value = $row->result;
				$question->done = true;
			}
		}

		$data = [
			'key'       => $keys,
			'student'   => $student,
			'campaign'  => $survey,
			'questions' => $questions,
		];


		return \View::make('front.survey.base', $data);
	}

}
