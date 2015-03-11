<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller {

	public function getLogin()
	{
		if (\Auth::check()) return redirect('/m');

		return \View::make('auth.login');
	}

	public function postLogin()
	{
		$field = filter_var(\Input::get('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		if (\Auth::attempt([$field => \Input::get('email'), 'password' => \Input::get('password'), 'status' => 'Active'], \Input::get('remember') == '1'))
		{
			$user = \Auth::user();
			$user->last_login = new \DateTime;
			$user->locked = false;
			$user->save();

			return \Response::json(['result' => true, 'msg' => 'Successfully logged in!', 'url' => \Session::get('url.intended', url('/m'))]);
		}

		return \Response::json(['result' => false, 'msg' => 'Invalid login information, please try again.', 'fields' => ['email', 'password']]);
	}

	public function getLogout()
	{
		if (\Auth::check() && \Auth::user()->locked)
		{
			\Auth::user()->fill(['locked' => false])->save();
		}

		\Auth::logout();

		return \Redirect::to('login')->with('success', 'You were logged out successsfully!');
	}

}
