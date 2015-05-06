<?php namespace App\Models;

use App\Models\Classroom;
class Student extends \App\Models\Model {

	protected $table = 'students';

	protected $fillable = ['sid', 'first_name', 'last_name', 'date_birth', 'school_id', 'school', 'grade', 'classroom', 'classroom_id', 'email', 'address_street', 'address_city', 'address_province', 'address_country', 'address_postal_code', 'created_by'];

	public static $importable = ['student_id', 'first_name', 'last_name', 'date_birth', 'school', 'grade', 'classroom', 'email', 'street', 'city', 'province', 'country', 'postal_code'];

	public static $sortable = ['sid', 'name', 'first_name', 'last_name', 'date_birth', 'school_id', 'school', 'grade', 'classroom', 'email', 'address_street', 'address_city', 'address_province', 'address_country', 'address_postal_code', 'created_by'];

	protected $related = [];

	protected $relation_key = 'student_id';

	public function matchName($name)
	{
		return strtolower(preg_replace("/[^A-Za-z0-9]/", "", $name)) == strtolower(preg_replace("/[^A-Za-z0-9]/", "", $this->first_name.$this->last_name));
	}

	public function getName($format="L, F")
    {
    	$string = str_replace("L", "{last}", $format);
    	$string = str_replace("F", "{first}", $string);

    	$string = str_replace("{last}", $this->last_name, $string);
    	$string = str_replace("{first}", $this->first_name, $string);

    	return $string;
    }

    public function clasr()
    {
    	return $this->belongsTo('App\Models\Classroom', 'classroom_id');
    }

    public static function createFromImport($data)
    {
		$student = self::where('first_name',$data['first_name'])->where('last_name',$data['last_name'])->first();

		if(!isset($student)) {
			$student = new self;
		}

    	$student->fill([
			'sid'                 => $data['student_id'], 
			'first_name'          => $data['first_name'], 
			'last_name'           => $data['last_name'], 
			'date_birth'          => $data['date_birth'], 
			'school_id'           => $data['school_id'], 
			'school'              => $data['school'], 
			'grade'               => $data['grade'],
			'classroom'           => $data['classroom'],
			'email'               => $data['email'], 
			'address_street'      => $data['street'], 
			'address_city'        => $data['city'], 
			'address_province'    => $data['province'], 
			'address_country'     => $data['country'], 
			'address_postal_code' => $data['postal_code'],
			'created_by'          => $data['created_by'],
    	]);

    	$student->save();

    	return $student;
    }

    public static function getListable($var=false)
    {
        $query   = static::initListable($var);
       
        $filters = static::initStatic($var);

        $sort = self::getSort();

        if (!empty($sort->sort) && in_array($sort->sort, self::$sortable))
        {
	        switch($sort->sort)
	        {
	        	case 'name':
	        		$query->orderBy('first_name', $sort->order)->orderBy('last_name', $sort->order); break;

	            default:
	                $query->orderBy($sort->sort, $sort->order);
	        }
	    }

        return $query;
    }

    public static function getCountStudent($id){
    	$count = self::where('classroom_id',$id)->count();
    	return $count;
    }
    
    public static function getGradeData($id){
    	$datas = Classroom::$grades;
    	//dd($datas);
    	$dataArray = [];

    	foreach ($datas as $key => $value) {
    		$count = self::where('classroom_id',$id)->where('grade',$key)->count();
    		array_push($dataArray, array($key,$count));
    	}
    	
    	return $dataArray;
    }
}