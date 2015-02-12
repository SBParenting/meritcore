<?php namespace App\Http\Controllers\Front;

use \Illuminate\Http\Request;
use \App\Models\CampaignStudent;
use \App\Models\CampaignResult;

class SurveyController extends \App\Http\Controllers\Controller {

	public function getIndex($key)
	{
		$student = CampaignStudent::findByKey($key);

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
			elseif (\Session::has('student.survey.confirmed') && \Hash::check($key, \Session::get('student.survey.confirmed')))
			{
				$campaign = $student->campaign;

				$surveys = $campaign->surveys;

				$questions = collect();

				$num = 0;

				foreach ($surveys as $survey)
				{
					foreach ($survey->getQuestions() as $question)
					{
						$num++;

						$question->num = $num;

						$questions->push($question);
					}
				}

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
					'campaign'  => $campaign,
					'questions' => $questions,
				];

				return \View::make('front.survey.base', $data);
			}
			else
			{
				$data = [
					'key'     => $key,
					'student' => $student,
				];

				return \View::make('front.survey.confirm', $data);
			}
		}

		abort(404);
	}

	public function postConfirm(Request $request, $key)
	{
		$student = CampaignStudent::findByKey($key);

		if ($student)
		{
			$s = $student->student;

			if ($s)
			{
				$this->validate($request, [
					'name' => 'required|max:255',
					'sid'  => 'required|max:255',
			    ]);

			    $name = $request->input('name');
			    $sid  = $request->input('sid');

			    if ($s->matchName($name) && $s->sid == $sid)
			    {
			    	$student->status = 'InProgress';

			    	\Session::flash('student.survey.confirmed', \Hash::make($key));

			    	return \Response::json(['result' => true, 'msg' => 'Student information confirmed successfully!', 'url' => url("$key") ]);
			    }
			    else
			    {
					return \Response::json(['result' => false, 'msg' => 'The information you entered appears to be incorrect, please try again.', 'errors' => ['name' => 'Make sure to enter your first name followed by your last name.', 'sid' => 'Make sure to enter your complete student ID.']]);
			    }
			}
		}

		return \Response::json(['result' => false, 'msg' => 'Could not confirm the student details.']);
	}

	public function postSave(Request $request, $key)
	{
		$student = CampaignStudent::findByKey($key);

		if ($student && $s = $student->student)
		{
			$this->validate($request, [
				'question_id' => 'required|numeric',
				'result'      => 'required|numeric',
		    ]);

			$campaign = $student->campaign;

		    $data = [
				'campaign_id'         => $campaign->id,
				'campaign_student_id' => $student->id,
				'school_board_id'     => $campaign->school_board_id,
				'school_id'           => $campaign->school_id,
				'class_id'            => $campaign->class_id,
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

			return \Response::json(['result' => true, 'msg' => 'Successfully saved survey result.']);
		}

		return \Response::json(['result' => false, 'msg' => 'Could not confirm the student details.']);
	}


	public function postComplete(Request $request, $key)
	{
		$student = CampaignStudent::findByKey($key);

		if ($student && $s = $student->student)
		{
			$student->status = 'Completed';

			$student->save();

			return \Response::json(['result' => true, 'msg' => 'Successfully saved survey result.', 'url' => url("$key")]);
		}

		return \Response::json(['result' => false, 'msg' => 'Could not confirm the student details.']);
	}

}
