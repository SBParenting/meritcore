<?php namespace Services\Validators;

use Libraries\Validator\LaravelValidator;
use Libraries\Validator\Validable;

class ChildValidator extends LaravelValidator implements Validable
{

    public function create()
    {
        $this->rules = array(
            'first_name' => 'required',
            'birth_date' => 'required',
            'sex' => 'required',
        );

        return $this;
    }

    public function update()
    {
        $this->rules = array(
            'first_name' => 'required',
            'birth_date' => 'required',
        );

        return $this;
    }
}