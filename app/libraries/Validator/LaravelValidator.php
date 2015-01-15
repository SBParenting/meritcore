<?php namespace Libraries\Validator;

use Illuminate\Validation\Factory;
use Libraries\Validator\AbstractValidator;

abstract class LaravelValidator extends AbstractValidator {

	/**
	 * The Validator instance
	 *
	 * @var Illuminate\Validation\Factory
	 */
	protected $validator;

	/**
	 * Inject the Validator instance
	 *
	 * @param Illuminate\Validation\Factory $validator
	 */
	public function __construct(Factory $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * Replace placeholders with attributes
	 *
	 * @return array
	 */
	public function replace()
	{
		$data = $this->data;
		$rules = $this->rules;

		array_walk($rules, function(&$rule) use ($data)
		{
			preg_match_all('/\{(.*?)\}/', $rule, $matches);

			foreach($matches[0] as $key => $placeholder)
			{
				if(isset($data[$matches[1][$key]]))
				{
					$rule = str_replace($placeholder, $data[$matches[1][$key]], $rule);
				}
			}
		});

		return $rules;
	}

	/**
	 * Pass the data and the rules to the validator
	 *
	 * @return boolean
	 */
	public function passes()
	{
		if (!empty($this->action))
		{
			$this->{ $this->action }();
		}

		$rules = $this->replace();

		$validator = $this->validator->make($this->data, $rules);

		if( $validator->passes() )
		{
			return true;
		}

		$this->errors = $validator->messages();
	}

	/**
	 * Return the validator result as a Json object
	 *
	 * @return boolean
	 */
	public function toJsonResponse()
	{
		$result = [

			'result' => $this->passes(),

			'msg'	 => trans('crud.failed_validation'),

			'errors' => $this->errors()->toArray(),

		];

		return \Response::json($result);
	}

}