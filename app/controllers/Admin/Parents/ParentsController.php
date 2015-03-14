<?php namespace Controllers\Admin\Parents;

class ParentsController extends \BaseController {

    public function __construct(\StrengthScore $strengthScore, \ReflectAnswer $reflectAnswer) {
        $this->strengthScore = $strengthScore;
        $this->reflectAnswer = $reflectAnswer;
    }

    public function getIndex($strength_score_id, $question_id) {
        $this->strengthScore = $this->strengthScore->find($strength_score_id);
        $child = $this->strengthScore->child;

        $answer = $this->reflectAnswer->where('parent_id',$child->user_id)
                                      ->where('strength_score_id',$strength_score_id)
                                      ->where('reflect_question_id',$question_id)->first();

        if (!isset($answer)) {
            $hasPrevious = $this->reflectAnswer->where('parent_id',$child->user_id)
                                               ->where('strength_score_id',$strength_score_id)
                                               ->where('reflect_question_id',$question_id-1)->first();

            if (!isset($hasPrevious) && $question_id != 1) {
                $answer = $this->reflectAnswer->where('parent_id',$child->user_id)->where('strength_score_id',$strength_score_id)->orderBy('reflect_question_id','DESC')->first();
                if ($answer) {
                    return \Redirect::route('parents.reflect',[$strength_score_id,$answer->reflect_question_id]);
                } else {
                    return \Redirect::route('parents.reflect',[$strength_score_id,1]);
                }
            }
        }

        $question = \ReflectQuestion::find($question_id);

        $total = \ReflectQuestion::count();

        return \View::make('front.parents.reflect')->with('strengthScore',$this->strengthScore)->with(compact('child','question','answer','total'));
    }

    public function postIndex($strength_score_id, $question_id) {
        $input = \Input::all();

        $this->strengthScore = $this->strengthScore->find($strength_score_id);
        $child = $this->strengthScore->child;

        $input['reflect_question_id'] = $question_id;
        $input['strength_score_id'] = $strength_score_id;
        $input['parent_id'] = $child->user_id;

        $answer = $this->reflectAnswer->where('parent_id',$input['parent_id'])->where('reflect_question_id',$question_id)->first();

        if(!isset($answer)) {
            $answer = $this->reflectAnswer;
        }

        $val = $answer->validator()->with($input)->action('create');

        if ($val->passes()) {
            $answer->fill($input);
            $answer->save();

            if ($input['total'] == $question_id) {
                return \Redirect::route('parents.explore',[$strength_score_id]);
            }

            return \Redirect::route('parents.reflect',[$strength_score_id,$question_id+1]);
        } else {
            return \Redirect::route('parents.reflect',[$strength_score_id,$question_id]);
        }
    }

    public function getExplore($strength_score_id) {
        $this->strengthScore = $this->strengthScore->find($strength_score_id);
        $child = $this->strengthScore->child;

        return \View::make('front.parents.explore')->with('strengthScore',$this->strengthScore)->with(compact('child'));
    }

    public function pick($strength_score_id) {
        $questions = \ExploreQuestion::all();
        $this->strengthScore = $this->strengthScore->find($strength_score_id);

        return \View::make('front.parents.explore_list')->with('strengthScore',$this->strengthScore)->with(compact('questions'));
    }

    public function picked($strength_score_id,$explore_question_id) {
        $this->strengthScore = $this->strengthScore->find($strength_score_id);
    }
}