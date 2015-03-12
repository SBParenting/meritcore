<?php namespace Services\Validators;

use Libraries\Validator\LaravelValidator;
use Libraries\Validator\Validable;

class ReflectAnswerValidator extends LaravelValidator implements Validable
{

    public function create()
    {
        $this->rules = array(
            'reflect_statement_id' => 'required',
            'thoughts' => 'required',
        );

        return $this;
    }

}