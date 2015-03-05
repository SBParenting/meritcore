<?php

class Strength extends BaseModel {

    protected $table = 'strengths';

    public function strengthGroup() {
        return $this->belongsTo('StrengthGroup');
    }

}