<?php

namespace Controllers\Auth;

class RemindersController extends \Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return \View::make('front.auth.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		switch ($response = \Password::remind(\Input::only('email')))
		{
			case \Password::INVALID_USER:
				return \Response::json(['result' => false, 'msg' => \Lang::get($response), 'fields' => ['email']]);

			case \Password::REMINDER_SENT:
				return \Response::json(['result' => true, 'msg' => \Lang::get($response)]);
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) \App::abort(404);

		return \View::make('front.auth.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = \Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = \Password::reset($credentials, function($user, $password)
		{
			$user->password = $password;

			$user->save();
		});

		switch ($response)
		{
			case \Password::INVALID_PASSWORD:
				return \Response::json(['result' => false, 'msg' => \Lang::get($response), 'fields' => ['password', 'password_confirmation']]);
			case \Password::INVALID_TOKEN:
				return \Response::json(['result' => false, 'msg' => \Lang::get($response), 'fields' => ['email']]);
			case \Password::INVALID_USER:
				return \Response::json(['result' => false, 'msg' => \Lang::get($response), 'fields' => ['email']]);

			case \Password::PASSWORD_RESET:
				return \Response::json(['result' => true, 'msg' => "Password changed successfully!", 'url' => \Session::get('url.intended', url('/admin/dashboard')) ]);
		}
	}

}
