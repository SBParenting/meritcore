<?php

namespace Controllers\Auth;

use User as Record;

class RegisterController extends \Controller {

	public function getIndex()
	{
		return \View::make('front.auth.register');
	}

	public function postIndex()
	{
		$record = new Record;

		$val = $record->validator()->with(\Input::all())->action('register');

		if (!$val->passes())
		{
			return $val->toJsonResponse();
		}
		else 
		{
			$record->fill($val->data());

			//Authenticated user role
			$record->role_id = 2;
			$record->status = 'Unverified';
			$record->verification_code = str_random(50);
			$record->save();
			$record->updateProfile($val->data());

			\Mail::send('emails.admin.user_verification', ['user' => $record], function($message) use ($record)
	        {
	            $message->to($record->email, $record->getName())->subject( \Config::get('site.title') . " Email Verification" );
	        });

			return \Response::json(['result' => true, 'msg' => trans('crud.success_added') ]);		
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_added')]);
	}

	public function getVerify($code)
	{
		$user = \User::where('verification_code', '=', $code)->first();

		if ($user)
		{
			$user->verification_code = null;
			$user->status == 'Active';
			$user->save();

			return \Redirect::to('login')->with('success', 'Thank you, your account was verified successfully.');
		}

		return \Redirect::to('login')->with('danger', 'Invalid verification code.');
	}
}
