<?php namespace Controllers\Front;

class RegisterController extends \BaseController {

	public function getIndex()
	{

		return \View::make('front.auth.register');
	}