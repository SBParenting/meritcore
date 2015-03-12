<?php namespace Controllers\Admin\Parents;

class ParentsController extends \BaseController {

    public function getIndex($strength_score_id, $question_id) {
        $strengthScore = \StrengthScore::find($strength_score_id);
        $child = $strengthScore->child;

        $answer = \ReflectAnswer::where('parent_id',$child->user_id)
                                ->where('strength_score_id',$strength_score_id)
                                ->where('reflect_question_id',$question_id)->first();

        if (!isset($answer)) {
            $hasPrevious = \ReflectAnswer::where('parent_id',$child->user_id)
                                         ->where('strength_score_id',$strength_score_id)
                                         ->where('reflect_question_id',$question_id-1)->first();

            if (!isset($hasPrevious) && $question_id != 1) {
                $answer = \ReflectAnswer::where('parent_id',$child->user_id)->where('strength_score_id',$strength_score_id)->orderBy('reflect_question_id','DESC')->first();
                if ($answer) {
                    return \Redirect::route('parents.reflect',[$strength_score_id,$answer->reflect_question_id]);
                } else {
                    return \Redirect::route('parents.reflect',[$strength_score_id,1]);
                }
            }
        }

        $question = \ReflectQuestion::find($question_id);

        $total = \ReflectQuestion::count();

        return \View::make('front.parents.reflect')->with(compact('child','question','answer','strengthScore','total'));
    }

    public function postIndex($strength_score_id, $question_id) {
        $input = \Input::all();

        $strengthScore = \StrengthScore::find($strength_score_id);
        $child = $strengthScore->child;

        $input['reflect_question_id'] = $question_id;
        $input['strength_score_id'] = $strength_score_id;
        $input['parent_id'] = $child->user_id;

        $answer = \ReflectAnswer::where('parent_id',$input['parent_id'])->where('reflect_question_id',$question_id)->first();

        if(!isset($answer)) {
            $answer = new \ReflectAnswer();
        }

        $val = $answer->validator()->with($input)->action('create');

        if ($val->passes()) {
            $answer->fill($input);
            $answer->save();

            if ($input['total'] == $question_id) {
                return \Redirect::route('parents.explore',[$strength_score_id,1]);
            }

            return \Redirect::route('parents.reflect',[$strength_score_id,$question_id+1]);
        } else {
            return \Redirect::route('parents.reflect',[$strength_score_id,$question_id]);
        }
    }

    public function getExplore($strength_score_id) {
        $strengthScore = \StrengthScore::find($strength_score_id);
        $child = $strengthScore->child;

        return \View::make('front.parents.explore')->with(compact('strengthScore','child'));
    }
}