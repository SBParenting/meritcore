<?php namespace Services\Validators;

use Libraries\Validator\LaravelValidator;
use Libraries\Validator\Validable;

class PageValidator extends LaravelValidator implements Validable 
{

	public function create()
	{
		$this->rules = array(
			'title'   => 'required',
			'slug'    => 'required|unique:content_pages',
		);

		return $this;
	}

	public function update()
	{
		$this->rules = array(
			'title'   => 'required',
			'slug'    => 'required|unique:content_pages,slug,{id}',
		);

		return $this;
	}
}