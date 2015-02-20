<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Validation\Validator;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	protected function formatValidationErrors(Validator $validator)
	{
	    return ['result' => false, 'msg' => 'Please correct the indicated errors.', 'errors' => $validator->errors()];
	}

	protected function access($id)
	{
		if (!\Auth::user()->ability(['admin'], [$id]))
		{
			abort(403);
		}

		$this->user = \Auth::user();
	}
}
