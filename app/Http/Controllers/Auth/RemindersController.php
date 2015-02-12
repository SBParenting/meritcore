<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker as PasswordBrokerContract;

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return \View::make('auth.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		switch ($response = \Password::sendResetLink(\Input::only('email')))
		{
			case PasswordBrokerContract::INVALID_USER:
				return \Response::json(['result' => false, 'msg' => \Lang::get($response), 'fields' => ['email']]);

			case PasswordBrokerContract::RESET_LINK_SENT:
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

		return \View::make('auth.reset')->with('token', $token);
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
			case PasswordBrokerContract::INVALID_PASSWORD:
				return \Response::json(['result' => false, 'msg' => \Lang::get($response), 'fields' => ['password', 'password_confirmation']]);
			case PasswordBrokerContract::INVALID_TOKEN:
				return \Response::json(['result' => false, 'msg' => \Lang::get($response), 'fields' => ['email']]);
			case PasswordBrokerContract::INVALID_USER:
				return \Response::json(['result' => false, 'msg' => \Lang::get($response), 'fields' => ['email']]);

			case PasswordBrokerContract::PASSWORD_RESET:
				\Session::flash('success', "Password changed successfully!");
				return \Response::json(['result' => true, 'msg' => "Password changed successfully!", 'url' => url('login') ]);
		}
	}

}
