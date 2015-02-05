<?php

namespace Controllers\Auth;

class AuthController extends \Controller {

	
	public function getLogin()
	{
		if (\Auth::check()) return \Redirect::to('/admin/dashboard');

		return \View::make('front.auth.login');
	}

	public function postLogin()
	{
		if (\Auth::attempt(\Input::only(['username', 'password']), \Input::get('remember') == '1'))
		{
			$user = \Auth::user();
			$user->last_login = new \DateTime;
			$user->locked = false;
			$user->save();

			return \Response::json(['result' => true, 'msg' => 'Successfully logged in!', 'url' => \Session::get('url.intended', url('/admin/dashboard'))]);
		}

		return \Response::json(['result' => false, 'msg' => 'Invalid login information, please try again.', 'fields' => ['username', 'password']]);
	}

	public function getLogout()
	{
		if (\Access::active())
		{
			\Access::unlock(false);
		}

		\Auth::logout();

		return \Redirect::to('login')->with('success', 'You were logged out successsfully!');
	}

	public function postLock()
	{
		\Access::lock();

		return \Response::json(['result' => true, 'msg' => 'Successfully locked app!']);
	}

	public function postUnlock()
	{
		if (\Input::has('password'))
		{
			if (\Access::unlock( \Input::get('password') ))
			{
				return \Response::json(['result' => true, 'msg' => 'Successfully unlocked app!']);
			}
		}

		return \Response::json(['result' => false, 'msg' => 'Incorrect password, please try again.']);
	}
}