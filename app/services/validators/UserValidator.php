<?php namespace Services\Validators;

use Libraries\Validator\LaravelValidator;
use Libraries\Validator\Validable;

class UserValidator extends LaravelValidator implements Validable 
{

	public function create()
	{
		$this->rules = array(
			'first_name' => 'required',
			'last_name'  => 'required',
			'username'   => 'required|min:4|unique:users,username',
			'email'      => 'required|email|unique:users,email',
			'password'   => 'required|min:8|confirmed',
			'role_id'	 => 'required',
			'status'	 => 'required',
		);

		return $this;
	}

	public function update()
	{
		$this->rules = array(
			'first_name' => 'required',
			'last_name'  => 'required',
			'username'   => 'required|min:4|unique:users,username,{id}',
			'email'      => 'required|email|unique:users,email,{id}',
			'password'   => 'min:8|confirmed',
			'role_id'	 => 'required',
			'status'	 => 'required',
		);

		if (array_key_exists('password', $this->data) && empty($this->data['password']))
		{
			unset($this->data['password']);
			unset($this->data['password_confirmation']);
		}

		return $this;
	}

	public function register()
	{
		$this->rules = array(
			'first_name' => 'required',
			'last_name'  => 'required',
			'username'   => 'required|min:4|unique:users,username',
			'email'      => 'required|email|unique:users,email',
			'password'   => 'required|min:8|confirmed',
		);

		return $this;
	}
}