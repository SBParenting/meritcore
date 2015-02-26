<?php namespace Controllers\Front;

class SurveyController extends \BaseController
{

    public function getIndex($sid)
    {
        $student_survey = \CampaignStudent::where('student_id',$sid)->first();

        $child = \Child::find($sid);

        if (!isset($student_survey)) {
            $string = str_random(40);
            $student_survey = new \CampaignStudent();
            $student_survey->student_id = $child->id;
            $student_survey->campaign_id = $child->id;
            $student_survey->secret = $string;
            $student_survey->status = 'NotStarted';

            $student_survey->save();
        }

        $campaign_result = \CampaignResult::where('campaign_student_id',$student_survey->id)->get()->lists('result','question_id');

        $questions = \SurveyQuestion::where('survey_id', 1)->paginate(5);

        if ($student_survey->status != "Completed") {
            return \View::make('front.survey.base')
                ->with('questions', $questions)
                ->with('child', $child)
                ->with('campaign_student',$student_survey)
                ->with('answers',$campaign_result);
        } else {
            return \View::make('front.survey.completed');
        }

    }

    public function finishSurvey($sid) {
        $student_survey = \CampaignStudent::where('student_id',$sid)->first();

        $questions = \SurveyQuestion::where('survey_id', 1)->count();
        $campaign_result = \CampaignResult::where('campaign_student_id',$student_survey->id)->count();

        if ($questions == $campaign_result) {
            $student_survey->status = "Completed";
        } elseif ($campaign_result != 0) {
            $student_survey->status = "InProgress";
        }

        $student_survey->save();

        return \Redirect::back()->with('message','Survey successfully saved!');
    }

    public function saveQuestion()
    {
        $input = \Input::all();
        $child = \Child::find($input['child_id']);

        $result = \CampaignResult::where('campaign_student_id',$input['campaign_student_id'])
                                 ->where('question_id',$input['question_id'])
                                 ->first();

        if (!isset($result)){
            $result = new \CampaignResult();
        }

        if (\Auth::id() == $child->user_id) {
            $result->campaign_student_id = $input['campaign_student_id'];
            $result->student_id = $input['child_id'];
            $result->question_id = $input['question_id'];
            $result->result = $input['result'];

            $result->save();
        }
    }

    public function getIndexParentFocus()
    {
        $questions = [
            (object)["id" => 1, "num" => 1, "question" => "<h3>Family relationships</h3> (i.e communication, caring, rules and boundries)"],
            (object)["id" => 2, "num" => 2, "question" => "<h3>Learning</h3>  (i.e. school work, motivation, involvment at school)"],
            (object)["id" => 3, "num" => 3, "question" => "<h3>Belonging at school</h3> (i.e. good relationships with teachers and classmates, clear and fair rules and expectations)"],
            (object)["id" => 4, "num" => 4, "question" => "<h3>Sense of community</h3> (i.e. sense of belonging, supportive relationships with adults, clear rules and expectations)"],
            (object)["id" => 5, "num" => 5, "question" => "<h3>Friendships / peers</h3> (i.e. positive friends who care)"],
        ];

        return \View::make('front.survey.parentFocus')->with('questions', $questions);
    }


    public function getSbp()
    {
        return \View::make('front.survey.sbp_base');
    }

}