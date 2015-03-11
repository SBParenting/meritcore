<?php namespace App\Models;

class StudentAssoc extends \App\Models\Model {

	protected $table = 'student_associations';

	protected $fillable = ['student_id', 'school_id', 'class_id'];

}