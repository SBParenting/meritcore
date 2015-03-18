<?php

class EmpowerAnswer extends BaseModel {

    protected $table = 'empower_answers';

    protected $fillable = ['empower_child_id','empower_question_id','answer'];
}