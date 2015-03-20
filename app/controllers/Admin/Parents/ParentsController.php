<?php namespace Controllers\Admin\Parents;

class ParentsController extends \BaseController {

    public function __construct(\StrengthScore $strengthScore, \ReflectAnswer $reflectAnswer) {
        $this->strengthScore = $strengthScore;
        $this->reflectAnswer = $reflectAnswer;
    }

    public function getIndex($strength_score_id, $question_id) {
        $this->strengthScore = $this->strengthScore->find($strength_score_id);
        $child = $this->strengthScore->child;

        $question = \ReflectQuestion::where('strength_id',$this->strengthScore->strength->id)->where('num',$question_id)->first();

        $answer = $this->reflectAnswer->where('parent_id',$child->user_id)
                                      ->where('reflect_question_id',$question->id)->first();

        if (!isset($answer)) {
            $hasPrevious = $this->reflectAnswer->where('parent_id',$child->user_id)
                                               ->where('reflect_question_id',$question_id-1)->first();

            if (!isset($hasPrevious) && $question_id != 1) {
                $answer = $this->reflectAnswer->where('parent_id',$child->user_id)->orderBy('reflect_question_id','DESC')->first();
                if ($answer) {
                    return \Redirect::route('parents.reflect',[$strength_score_id,$answer->reflect_question_id]);
                } else {
                    return \Redirect::route('parents.reflect',[$strength_score_id,1]);
                }
            }
        }

        $total = \ReflectQuestion::where('strength_id',$this->strengthScore->strength->id)->count();

        return \View::make('front.parents.reflect')->with('strengthScore',$this->strengthScore)->with(compact('child','question','answer','total'));
    }

    public function postIndex($strength_score_id, $question_id) {
        $input = \Input::all();

        $this->strengthScore = $this->strengthScore->find($strength_score_id);
        $child = $this->strengthScore->child;

        $question = \ReflectQuestion::where('strength_id',$this->strengthScore->strength->id)->where('num',$question_id)->first();

        $input['reflect_question_id'] = $question->id;
        $input['parent_id'] = $child->user_id;

        $answer = $this->reflectAnswer->where('parent_id',$input['parent_id'])->where('reflect_question_id',$question->id)->first();

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

        $enableEmpower = \ExploreAnswer::where('status','Completed')->count();

        $explore = \ExploreAnswer::where('strength_score_id',$strength_score_id)->where('status','InProgress')->take(2)->get();

        return \View::make('front.parents.explore')->with('strengthScore',$this->strengthScore)->with(compact('child','explore','enableEmpower'));
    }

    public function pick($strength_score_id) {
        $this->strengthScore = $this->strengthScore->find($strength_score_id);

        $questions = \ExploreQuestion::where('strength_id',$this->strengthScore->strength->id)->get();

        $answers = \ExploreAnswer::where('strength_score_id',$strength_score_id)
                                 ->distinct()
                                 ->lists('status','explore_question_id');

        return \View::make('front.parents.explore_list')->with('strengthScore',$this->strengthScore)->with(compact('questions','answers'));
    }

    public function build($strength_score_id,$explore_question_id) {
        $this->strengthScore = $this->strengthScore->find($strength_score_id);

        $options = \BuildOption::where('strength_id',$this->strengthScore->strength->id)->get();
        $answers = \ExploreAnswer::where('strength_score_id',$strength_score_id)
                                 ->where('explore_question_id',$explore_question_id)
                                 ->lists('id','build_option_id');

        foreach ($answers as $key => $value) {
            $answers[$key] = \ExploreAnswer::select('status','score')->find($value)->toArray();
        }

        return \View::make('front.parents.build_list')->with('strengthScore',$this->strengthScore)->with(compact('options','answers','explore_question_id'));
    }

    public function picked($strength_score_id,$explore_question_id) {
        $answer = \ExploreAnswer::where('explore_question_id',$explore_question_id)->where('strength_score_id',$strength_score_id)->first();

        if (!isset($answer)) {
            $answer = new \ExploreAnswer();
        }

        $answer->strength_score_id = $strength_score_id;
        $answer->explore_question_id = $explore_question_id;
        $answer->status = 'InProgress';

        $answer->save();

        return \Redirect::to('parents/explore/'.$strength_score_id);
    }

    public function buildPick($strength_score_id, $explore_question_id, $build_option_id) {
        $answer = \ExploreAnswer::where('explore_question_id',$explore_question_id)->where('status','InProgress')->first();

        if ($answer->build_option_id) {
            $answer->status = "Completed";

            $answer->save();

            $answer = new \ExploreAnswer();

            $answer->strength_score_id = $strength_score_id;
            $answer->explore_question_id = $explore_question_id;
            $answer->status = 'InProgress';
        }

        $answer->build_option_id = $build_option_id;
        $answer->save();

        return \Redirect::to('parents/explore/'.$strength_score_id);

    }

    public function setRating() {
        $input = \Input::all();

        $answer = \ExploreAnswer::find($input['answer_id']);
        $answer->score = $input['score'];

        $answer->save();

        return true;
    }

    public function completeExplore($qid){
        $answer = \ExploreAnswer::find($qid);

        $answer->status = 'Completed';

        $answer->save();

        return \Redirect::back();
    }

    public function getEmpower($strength_score_id,$feedback_person = null) {
        $this->strengthScore = $this->strengthScore->find($strength_score_id);
        $child = $this->strengthScore->child;

        $empowerChild = \EmpowerChild::where('child_id',$child->id)->where('strength_score_id',$strength_score_id)->get()->last();

        if (!isset($empowerChild)) {
            $empowerChild = new \EmpowerChild();

            $empowerChild->strength_score_id = $strength_score_id;
            $empowerChild->child_id = $child->id;
            $empowerChild->status = 'InProgress';

            $empowerChild->save();
        }

        $questions = \EmpowerQuestion::where('strength_id',$this->strengthScore->strength->id)->paginate(5);

        $answers = \EmpowerAnswer::where('empower_child_id',$empowerChild->id)->lists('answer','empower_question_id');

        if ($empowerChild->status == 'Feedback' && !empty($feedback_person)) {
            $feedback = \EmpowerFeedback::where('empower_child_id',$empowerChild->id)->get()->last();
            if ($feedback_person == 'parent') {
                return \View::make('front.parents.parent_feedback')->with('strengthScore',$this->strengthScore)->with(compact('child','feedback','empowerChild','answers'));
            }

            if ($feedback_person == 'child') {
                return \View::make('front.parents.child_feedback')->with('strengthScore',$this->strengthScore)->with(compact('child','feedback','empowerChild','answers'));
            }
        }

        return \View::make('front.parents.empower')->with('strengthScore',$this->strengthScore)->with(compact('child','questions','empowerChild','answers'));
    }

    public function saveEmpower() {
        $input = \Input::all();

        $answer = \EmpowerAnswer::where('empower_child_id',$input['empower_child_id'])
                                ->where('empower_question_id',$input['empower_question_id'])
                                ->get()->last();

        if (empty($answer)){
            $answer = new \EmpowerAnswer();
        }

        $answer->fill($input);
        $answer->save();
    }

    public function saveFeedback() {
        $input = \Input::all();

        $answer = \EmpowerFeedback::where('empower_child_id',$input['empower_child_id'])
                                  ->get()->last();

        if (empty($answer)){
            $answer = new \EmpowerFeedback();

            $answer->parent_score = -1;
            $answer->child_score = -1;
        }

        $answer->fill($input);
        $answer->save();
    }

    public function empowerFeedback($empower_child_id) {
        $empowerChild = \EmpowerChild::find($empower_child_id);

        $countQuestions = \EmpowerQuestion::where('strength_id',$empowerChild->strengthScore->strength->id)->count();

        $countAnswers = \EmpowerAnswer::where('empower_child_id',$empower_child_id)->count();

        if ($countQuestions == $countAnswers) {
            $empowerChild->status = "Feedback";

            $empowerChild->save();
        }

        return \Redirect::to('/parents/empower/'.$empowerChild->strength_score_id.'/parent');
    }

    public function calculateFeedback($empower_child_id) {
        $empowerChild = \EmpowerChild::find($empower_child_id);

        $feedback = \EmpowerFeedback::where('empower_child_id',$empowerChild->id)->first();

        if (($feedback->child_score+$feedback->parent_score)/2 < 70) {
            return \Redirect::to('/parents/empower/stepback/'.$empowerChild->strengthScore->id);
        } else {
            $empowerChild->status = "Completed";
            $empowerChild->save();

            return \Redirect::to('/journey/'.$empowerChild->child_id);
        }
    }

    public function empowerStepback($strength_score_id) {
        $this->strengthScore = $this->strengthScore->find($strength_score_id);

        $child = $this->strengthScore->child;

        return \View::make('front.parents.step_back')->with('strengthScore',$this->strengthScore)->with(compact('child'));
    }

    public function journey($child_id) {

        $child = \Child::find($child_id);

        $strengthGroups = \StrengthGroup::all();

        $status = [];

        $recommended = \StrengthScore::where('child_id',$child_id)->orderBy('score','ASC')->take(2)->get();

        foreach($strengthGroups as $strengthGroup) {
            $group = str_replace(" ","-",str_replace("&","and",strtolower($strengthGroup->name)));
            foreach ($strengthGroup->strength as $strength) {
                $str = str_replace(" ","-",str_replace("&","and",strtolower($strength->name)));
                $status[$group][$str] = 0;
                $strScore = \StrengthScore::where('child_id',$child_id)->where('strength_id',$strength->id)->get()->last();
                if ($strScore->id == $recommended[0]->id || $strScore->id == $recommended[1]->id) {
                    $status[$group][$str] = 3;
                }
                $empower = \EmpowerChild::where('child_id',$child_id)->where('strength_score_id',$strScore->id)->get()->last();
                if(isset($empower) && $empower->status == "Completed"){
                    $status[$group][$str] = 2;
                } else {
                    $reflect = \ExploreAnswer::where('strength_score_id',$strScore->id)->count();
                    if ($reflect) {
                        $status[$group][$str] = 1;
                    }
                }
            }
        }

        return \View::make('front.parents.journey')->with(compact('child'))->with('status',json_encode($status));
    }
}