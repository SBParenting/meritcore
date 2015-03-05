<?php namespace Controllers\Front;

class StrengthsController extends \BaseController
{
    public function calculate($child_id) {
        $studentSurvey = \CampaignStudent::where('student_id',$child_id)->where('campaign_id',2)->first();

        if ($studentSurvey->status == "Completed") {
            $campaignResult = \CampaignResult::where('campaign_student_id',$studentSurvey->id)->get();

            $questions = \SurveyQuestion::where('survey_id', 2)->get()->lists('strength_id','id');

            $strengths = [];

            $strengthCount = array_count_values($questions);

            foreach ($campaignResult as $result) {
                //TODO: remove this first if. It's here while developing, so we don't need to fill all the strengths
                if ($questions[$result->question_id] != 0) {
                    if (isset($strengths[$questions[$result->question_id]])) {
                        $strengths[$questions[$result->question_id]] += $result->result;
                    } else {
                        $strengths[$questions[$result->question_id]] = $result->result;
                    }
                }
            }

            foreach ($strengths as $key => $strength) {
                $strengthScore = \StrengthScore::where('child_id',$child_id)->where('strength_id',$key)->where('strength_kind','subgroup')->first();

                if (!isset($strengthScore)) {
                    $strengthScore = new \StrengthScore();
                }

                $strengthScore->child_id = $child_id;
                $strengthScore->strength_id = $key;
                $strengthScore->strength_kind = 'subgroup';
                $strengthScore->score = $strength / $strengthCount[$key];

                $strengthScore->save();
            }

            return \Redirect::to('/strengths/selection/'.$child_id);

        } else {
            return \Redirect::back();
        }

    }

    public function getSelection($child_id) {
        $child = \Child::find($child_id);

        $strengths = \Strength::all();
        $strengthGroups = \StrengthGroup::all();

        $scores = \StrengthScore::where('child_id',$child_id)->orderBy('score','ASC')->take(5)->get();

        return \View::make('front.strengths.selection')
                    ->with('child',$child)
                    ->with('strengths',$strengths)
                    ->with('strengthGroups',$strengthGroups)
                    ->with('scores',$scores);
    }
}