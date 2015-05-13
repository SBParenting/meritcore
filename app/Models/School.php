<?php namespace App\Models;

class School extends \App\Models\Model {

	protected $table = 'schools';

	protected $fillable = ['name', 'email', 'address_city', 'address_province', 'address_country', 'address_postal_code', 'school_board_id'];

	public static $sortable = ['schoolboard', 'name', 'email', 'address_city', 'classes_count', 'students_count', 'surveys_total_count', 'surveys_active_count'];

	public static $defaultSort = ['sort' => 'name', 'order' => 'asc'];

	public function board()
	{
		return $this->belongsTo('App\Models\SchoolBoard', 'school_board_id');
	}

	public function classes()
	{
		return $this->hasMany('App\Models\Classroom');
	}

	public function students()
	{
		return $this->belongsToMany('App\Models\Student', 'student_associations', 'student_id', 'school_id');
	}

	public function surveys()
	{
		return $this->hasMany('App\Models\Campaign');
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
//		$this->classes_count = Classroom::where('school_id', '=', $this->id)->count();
//		$this->students_count = Student::where('school_id', '=', $this->id)->count();
//		$this->surveys_total_count = Campaign::where('school_id', '=', $this->id)->count();
//		$this->surveys_active_count = Campaign::where('status', '=', 'Active')->where('school_id', '=', $this->id)->count();

		return $this;
	}

	public function getAddress()
	{
		$address = [];

		if (trim($this->address_street) != "") 
		{
			$address[] = $this->address_street;
		}

		if (trim($this->address_city) != "") 
		{
			$address[] = $this->address_city;
		}

		if (trim($this->address_province) != "") 
		{
			$address[] = $this->address_province;
		}

		if (trim($this->address_country) != "") 
		{
			$address[] = $this->address_country;
		}

		if (trim($this->address_postal_code) != "") 
		{
			$address[] = $this->address_postal_code;
		}

		return implode(', ', $address);
	}

	public static function getListable($var=false)
    {
        $query   = static::initListable($var);

        $query->select('schools.*', 'school_boards.name as school_board', \DB::raw('COUNT(`school_classes`.`id`) AS classes_count'), 's.students_count','c.surveys_total_count','c2.surveys_active_count');

        $query->leftJoin('school_boards', 'school_boards.id', '=', 'schools.school_board_id');

		$query->leftJoin('school_classes','school_classes.school_id','=','schools.id');

		$query->leftJoin(\DB::raw('(SELECT school_id, COUNT(*) as students_count FROM students GROUP BY school_id) AS s'),'s.school_id','=','schools.id');

		$query->leftJoin(\DB::raw('(SELECT school_id, COUNT(*) as surveys_total_count FROM campaigns GROUP BY school_id) AS c'),'c.school_id','=','schools.id');

		$query->leftJoin(\DB::raw('(SELECT school_id, COUNT(*) as surveys_active_count FROM campaigns WHERE status="Active" GROUP BY school_id) AS c2'),'c.school_id','=','schools.id');

		$query->groupBy('schools.id');

        $filters = static::initStatic($var);

        $sort = self::getSort();

        if (!empty($sort->sort) && in_array($sort->sort, self::$sortable))
        {
	        switch($sort->sort)
	        {
	        	case 'schoolboard':
	        		$query->orderBy('school_boards.name', $sort->order); break;

	            default:
	                $query->orderBy($sort->sort, $sort->order);

	        }
        }

        return $query;
    }
}