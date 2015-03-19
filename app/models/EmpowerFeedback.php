<?php

class EmpowerFeedback extends BaseModel {

    protected $table = 'empower_feedbacks';

    protected $fillable = ['empower_child_id','parent_score','child_score'];
}