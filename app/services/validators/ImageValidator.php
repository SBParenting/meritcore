<?php namespace Services\Validators;

use Libraries\Validator\LaravelValidator;
use Libraries\Validator\Validable;

class ImageValidator extends LaravelValidator implements Validable 
{

	public function create()
	{
		$this->rules = array(
			'title' => 'required',
			'path'  => 'required',
		);

		return $this;
	}

	public function update()
	{
		$this->rules = array(
			'title' => 'required',
		);

		return $this;
	}
}