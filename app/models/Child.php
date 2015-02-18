<?php

class Child extends BaseModel {

    use SoftDeletingTrait;

    protected $table = 'children';

    protected $fillable = ['first_name', 'last_name', 'birth_date', 'sex', 'student_id', 'avatar'];
}