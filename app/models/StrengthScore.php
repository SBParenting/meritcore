<?php

class StrengthScore extends BaseModel {

    protected $table = 'strength_scores';

    protected $fillable = ['child_id', 'strength_id', 'strength_kind', 'score'];

    public function strength() {
        return $this->belongsTo('Strength');
    }

    public function child() {
        return $this->belongsTo('Child');
    }
}