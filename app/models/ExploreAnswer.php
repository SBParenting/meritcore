<?php

class ExploreAnswer extends BaseModel {

    protected $table = 'explore_answers';

    protected $fillable = ['strength_score_id', 'explore_question_id', 'build_option_id', 'score', 'status'];

    public function exploreQuestion() {
        return $this->belongsTo('ExploreQuestion');
    }

    public function buildOption() {
        return $this->belongsTo('BuildOption');
    }
}