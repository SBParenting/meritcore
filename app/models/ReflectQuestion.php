<?php

class ReflectQuestion extends BaseModel {

    protected $table = 'reflect_questions';

    protected $fillable = ['question'];

    public function reflectStatements() {
        return $this->hasMany('ReflectStatement');
    }
}