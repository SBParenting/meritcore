<?php namespace Controllers\Front;

class StrengthsController extends \BaseController
{
    public function doTheMagic($child_id) {
        $child = \Child::find($child_id);

        $student_survey = \CampaignStudent::where('student_id',$child_id)->where('campaign_id',2)->first();

        $campaign_result = \CampaignResult::where('campaign_student_id',$student_survey->id)->get();

        $questions = \SurveyQuestion::where('survey_id', 2)->get()->lists('strength_id','id');

        $strengths = [];

        foreach ($campaign_result as $result) {
            //TODO: remove this first if. It's here while developing, so we don't need to fill all the strengths
            if ($questions[$result->question_id] != 0) {
                if (isset($strengths[$questions[$result->question_id]])) {
                    $strengths[$questions[$result->question_id]] += $result->result;
                } else {
                    $strengths[$questions[$result->question_id]] = $result->result;
                }
            }
        }
        dd($strengths);

        return \View::make('front.strengths.selection');
    }

    public function getSelection($child_id) {


        return \View::make('front.strengths.selection');
    }
}