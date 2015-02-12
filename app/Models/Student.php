<?php namespace App\Models;

class Student extends \App\Models\Model {

	protected $table = 'students';

	protected $fillable = ['first_name'];

	protected $related = [];

	protected $relation_key = 'student_id';

	public function matchName($name)
	{
		return strtolower(preg_replace("/[^A-Za-z0-9]/", "", $name)) == strtolower(preg_replace("/[^A-Za-z0-9]/", "", $this->first_name.$this->last_name));
	}
}