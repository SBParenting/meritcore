<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User as Record;
use App\Models\Role;
use Illuminate\Http\Request;

class RegisterController extends Controller {

	public function getIndex()
	{
		return \View::make('auth.register');
	}

	public function postIndex(Request $request)
	{
		$record = new Record;

		$this->validate($request, [
			'first_name' => 'required',
			'last_name'  => 'required',
			'role'       => 'required',
			'email'      => 'required|email|unique:users,email',
			'password'   => 'required|min:8|confirmed',
	    ]);

	    $record->fill($request->input());

		$role = Role::where('name', '=', $request->input('role'))->first();

		if ($role)
		{
			$record->role_id = $role->id;
		}

		$record->status = 'Unverified';
		$record->verification_code = str_random(50);
		$record->save();
		$record->updateProfile($request->input());

		\Mail::send('emails.admin.user_verification', ['user' => $record], function($message) use ($record)
        {
            $message->to($record->email, $record->getName())->subject( \Config::get('site.title') . " Email Verification" );
        });

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added') ]);
	}

	public function getVerify($code)
	{
		$record = Record::where('verification_code', '=', $code)->first();

		if ($record)
		{
			$record->status = 'Verified';
			$record->save();

			return \Redirect::to('register/'.$code);
		}

		return \Redirect::to('login')->with('danger', 'Invalid verification code.');
	}

	public function getComplete($code)
	{
		$record = Record::where('verification_code', '=', $code)->first();

		if ($record)
		{
			return \View::make('auth.complete');
		}

		return \Redirect::to('login')->with('danger', 'Invalid verification code.');
	}
}
