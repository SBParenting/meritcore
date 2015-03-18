<?php

class EmpowerChild extends BaseModel {

    protected $table = 'empower_children';

    protected $fillable = ['question'];

    public function strengthScore() {
        return $this->belongsTo('StrengthScore');
    }
}