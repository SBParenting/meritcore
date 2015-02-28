<?php namespace Controllers\Front;

class SurveyController extends \BaseController
{

    public function getIndex($sid)
    {
        $student_survey = \CampaignStudent::where('student_id',$sid)->where('campaign_id',2)->first();

        $child = \Child::find($sid);

        if (!isset($student_survey)) {
            $string = str_random(40);
            $student_survey = new \CampaignStudent();
            $student_survey->student_id = $child->id;
            $student_survey->campaign_id = 2;
            $student_survey->secret = $string;
            $student_survey->status = 'NotStarted';

            $student_survey->save();
        }

        $campaign_result = \CampaignResult::where('campaign_student_id',$student_survey->id)->get()->lists('result','question_id');

        $questions = \SurveyQuestion::where('survey_id', 2)->paginate(5);

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

    public function finishSurvey($sid,$survey_id) {
        $student_survey = \CampaignStudent::where('student_id',$sid)->where('campaign_id',$survey_id)->first();

        $questions = \SurveyQuestion::where('survey_id', $survey_id)->count();
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

        return \Response::json([
            'totalAnswers'=>\CampaignResult::where('campaign_student_id',$input['campaign_student_id'])->count(),
            'totalQuestions'=>\SurveyQuestion::where('survey_id',$input['survey_id'])->count(),
            'slider'=> $input['survey_id'] == 1 ? 'progress-blue' : 'progress-green'
        ]);
    }

    public function getIndexParentFocus($sid)
    {
        $student_survey = \CampaignStudent::where('student_id',$sid)->where('campaign_id',1)->first();

        $child = \Child::find($sid);

        if (!isset($student_survey)) {
            $string = str_random(40);
            $student_survey = new \CampaignStudent();
            $student_survey->student_id = $child->id;
            $student_survey->campaign_id = 1;
            $student_survey->secret = $string;
            $student_survey->status = 'NotStarted';

            $student_survey->save();
        }

        $campaign_result = \CampaignResult::where('campaign_student_id',$student_survey->id)->get()->lists('result','question_id');

        $questions = \SurveyQuestion::where('survey_id', 1)->paginate(5);

        if ($student_survey->status != "Completed") {
            return \View::make('front.survey.parentFocus')
                ->with('questions', $questions)
                ->with('child', $child)
                ->with('campaign_student',$student_survey)
                ->with('answers',$campaign_result);
        } else {
            return \Redirect::to('survey/child/'.$sid);
        }

    }


    public function getSbp()
    {
        return \View::make('front.survey.sbp_base');
    }

    public function selectSurvey($child_id) {
        $campaignStudent = \CampaignStudent::where('student_id',$child_id)
                                           ->lists('status','campaign_id');


        if (!isset($campaignStudent[1]) || $campaignStudent[1] != "Completed") {

            return \Redirect::to('survey/parent/'.$child_id);
        } else {
            return \Redirect::to('survey/child/'.$child_id);
        }
    }

}