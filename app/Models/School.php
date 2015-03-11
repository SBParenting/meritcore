<?php namespace App\Models;

class School extends \App\Models\Model {

	protected $table = 'schools';

	protected $fillable = ['name', 'email', 'address_city', 'address_province', 'school_board_id'];

	public function board()
	{
		return $this->belongsTo('App\Models\SchoolBoard');
	}

	public function students()
	{
		return $this->belongsToMany('App\Models\Student', 'student_associations', 'student_id', 'school_id');
	}

	public function users()
	{
		return $this->belongsToMany('App\Models\User', 'user_associations', 'school_id', 'user_id');
	}

	public function getTeachers()
	{
		return \App\Models\User::query()
			->select(['users.*', \DB::raw("CONCAT(users.first_name, ' ', users.last_name) as name")])
			->leftJoin('user_associations', 'users.id', '=', 'user_associations.user_id')
			->leftJoin('roles', 'users.role_id', '=', 'roles.id')
			->where('user_associations.school_id', '=', $this->id)
			->where('roles.name', '=', 'teacher')
			->orderBy('users.first_name', 'asc')
			->orderBy('users.last_name', 'asc')
			->get();
	}

	public function updateRecord()
	{
		$this->classes_count = Classroom::where('school_id', '=', $this->id)->count();
		$this->students_count = Student::where('school_id', '=', $this->id)->count();
		$this->surveys_total_count = Campaign::where('school_id', '=', $this->id)->count();
		$this->surveys_active_count = Campaign::where('status', '=', 'Active')->where('school_id', '=', $this->id)->count();

		return $this;
	}
}