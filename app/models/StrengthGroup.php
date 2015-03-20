<?php

class StrengthGroup extends BaseModel {

    protected $table = 'strength_groups';

    public function strength() {
        return $this->hasMany('Strength');
    }

}