<?php namespace Controllers\Front;

class SurveyController extends \BaseController
{

    public function getIndex($sid)
    {
        $student_survey = \CampaignStudent::where('student_id',$sid)->get();

        $child = \Child::find($sid);

        if ($student_survey->isEmpty()) {
            $string = str_random(40);
            $student_survey = new \CampaignStudent();
            $student_survey->student_id = $child->id;
            $student_survey->campaign_id = $child->id;
            $student_survey->secret = $string;
            $student_survey->status = 'NotStarted';
        }

        //TODO: if there's a survey, check if it's completed or not to decide if you can go through the survey
        $questions = \SurveyQuestion::where('survey_id', 1)->paginate(5);

        return \View::make('front.survey.base')
                    ->with('questions', $questions)
                    ->with('child', $child);
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