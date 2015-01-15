<?php namespace Services\Validators;

use Libraries\Validator\LaravelValidator;
use Libraries\Validator\Validable;

class PostValidator extends LaravelValidator implements Validable 
{

	public function create()
	{
		$this->rules = array(
			'title'   => 'required',
			'slug'    => 'required|unique:content_posts',
			'date'	  => 'required',
		);

		return $this;
	}

	public function update()
	{
		$this->rules = array(
			'title'   => 'required',
			'slug'    => 'required|unique:content_posts,slug,{id}',
			'date'	  => 'required',
		);

		return $this;
	}
}