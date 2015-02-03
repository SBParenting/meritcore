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

	

	public function getSbp()
	{
		return \View::make('front.survey.sbp_base');
	}

}