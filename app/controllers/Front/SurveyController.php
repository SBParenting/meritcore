<?php namespace Controllers\Front;

class SurveyController extends \BaseController {

	public function getIndex()
	{
		$questions = [
			(object)["id" => 1, "num" => 1, "question" => "I like who I am, and I am important to others."],
			(object)["id" => 2, "num" => 2, "question" => "I am aware of my feelings and find it easy to express them in good ways."],
			(object)["id" => 3, "num" => 3, "question" => "I find it easy to meet new people and make friends."],
			(object)["id" => 4, "num" => 4, "question" => "I think it is important to tell the truth, even when it may not be easy."],
			(object)["id" => 5, "num" => 5, "question" => "I learn from my mistakes and always do the best I can."],
		];

		return \View::make('front.survey.base')->with('questions', $questions);
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