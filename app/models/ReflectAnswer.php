<?php

class ReflectAnswer extends BaseModel {

    protected $table = 'reflect_answers';

    protected $fillable = ['parent_id', 'strength_score_id', 'reflect_question_id', 'reflect_statement_id', 'thoughts'];
}