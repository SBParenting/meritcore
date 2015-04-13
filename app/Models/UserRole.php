<?php namespace App\Models;

class UserRole extends \App\Models\Model {

	protected $table = 'role_user';

	protected $fillable = ['user_id', 'role_id'];

	public $timestamps = false;

	public function user(){
		return $this->belongsTo('User');
	}

	public function role(){
		return $this->belongsTo('Role');
	}

}