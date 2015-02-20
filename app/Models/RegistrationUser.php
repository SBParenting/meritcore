<?php namespace App\Models;

class RegistrationUser extends \App\Models\Model {

	protected $table = 'registration_users';

	protected $fillable = ['registration_id', 'type', 'first_name', 'last_name', 'email'];

}