<?php namespace App\Models;

class Student extends \App\Models\Model {

	protected $table = 'students';

	protected $fillable = ['sid', 'first_name', 'last_name', 'date_birth', 'school_id', 'grade', 'email', 'address_street', 'address_city', 'address_province', 'address_country', 'address_postal_code'];

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
}