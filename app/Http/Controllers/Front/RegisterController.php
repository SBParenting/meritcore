<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User as Record;
use App\Models\Role;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegisterController extends Controller {

	public function getIndex()
	{
		return \View::make('front.register.register');
	}

	public function postIndex(Request $request)
	{
		$record = new Record;

		$this->validate($request, [
			'first_name'        => 'required',
			'last_name'         => 'required',
			'email'             => 'required|email|unique:users,email',
			'registration_code' => 'required',
			'password'          => 'required|min:8|confirmed',
	    ]);

	    $registration = Registration::where('registration_code', '=', $request->input('registration_code'))->first();

	    if ($registration && $registration->status == 'NotStarted')
	    {
		    $record->fill($request->input());

			$role = Role::where('name', '=', 'school')->first();

			if ($role)
			{
				$record->role_id = $role->id;
			}

			$record->username = $record->email;
			$record->status = 'Unverified';
			$record->verification_code = str_random(50);
			$record->save();
			$record->updateProfile($request->input());

			$record->attachRole($role);

			$registration->user_id = $record->id;
			$registration->status = 'Unverified';
			$registration->verification_code = $record->verification_code;
			$registration->save();

			\Mail::send('emails.auth.user_verification', ['user' => $record], function($message) use ($record)
	        {
	            $message->to($record->email, $record->getName())->subject( \Config::get('site.title') . " Email Verification" );
	        });

	        return \Response::json(['result' => true, 'msg' => '' ]);
	    }
	    else
	    {
	    	if ($registration && $registration->status != 'NotStarted')
	    	{
	    		return \Response::json(['result' => false, 'msg' => 'The registration code you provided has already been used.', 'fields' => ['registration_code']]);
	    	}
	    	else
	    	{
	    		return \Response::json(['result' => false, 'msg' => 'The registration code you provided is not valid.', 'fields' => ['registration_code']]);
	    	}
	    }


		return \Response::json(['result' => false, 'msg' => 'User could not be created in any way.' ]);
	}

	public function getVerify($code)
	{
		$record = Record::where('verification_code', '=', $code)->first();

		if ($record)
		{
			$record->status = 'Verified';
			$record->verification_code = null;
			$record->save();

			$registration = Registration::where('verification_code', '=', $code)->first();

			if ($registration)
			{
				$registration->status = 'Verified';
				$registration->save();

				return \Redirect::to('register/'.$code);
			}

			return \Redirect::to('login')->with('success', 'Your account was verified successfully! Please log in.');
		}

		return \Redirect::to('login')->with('danger', 'Invalid verification code.');
	}

	public function getWizard($code)
	{
		$record = Registration::where('verification_code', '=', $code)->first();

		if ($record)
		{
			$data = $record->toArray();

			unset($data['progress']);

			$teachers = 0;

			foreach ($record->users as $user)
			{
				array_set($data, $user->type, array_only($user->toArray(), ['first_name', 'last_name', 'email']));

				if (strpos($user->type, "teachers.") !== false)
				{
					$teachers++;
				}
			}

			if ($teachers == 0) $teachers = 1;

			\Form::data($data);

			$slide = "slide1";

			if (\Input::has('s'))
			{
				$attempted = (int)(preg_replace("/[^0-9]/", "", \Input::get('s')));
				$allowed = (int)(preg_replace("/[^0-9]/", "", $record->progress)) + 1;

				if ($attempted <= $allowed)
				{
					$slide = \Input::get('s');
				}
				else
				{
					return redirect("register/$code?s=slide$allowed");
				}
			}

			return \View::make('front.register.wizard')->with('code', $code)->with('teachers', $teachers)->with('slide', $slide);
		}

		return \Redirect::to('login')->with('danger', 'Invalid verification code.');
	}

	public function postWizard(Request $request, $code)
	{
		$record = Registration::where('verification_code', '=', $code)->first();

		if ($record)
		{
			switch($request->input('step'))
			{
				case 'school':
					$this->validate($request, [
						'school_name'     => 'required',
						'school_city'     => 'required',
						'school_province' => 'required',
					]);
					$record->fill( $request->input() )->save();
				break;

				case 'school_board':
					$this->validate($request, [
						'school_board'     => 'required',
					]);
					$record->fill( $request->input() )->save();
				break;

				case 'principal':
					$this->validate($request, [
						'principal.first_name' => 'required',
						'principal.last_name'  => 'required',
						'principal.email'      => 'required|email|unique:users,email',
					]);
					$record->fill( $request->input() )->save();
					$record->saveUser('principal', $request->input('principal'));
				break;

				case 'counsellor':
					$this->validate($request, [
						'counsellor.first_name' => 'required',
						'counsellor.last_name'  => 'required',
						'counsellor.email'      => 'required|email|unique:users,email',
					]);
					$record->fill( $request->input() )->save();
					$record->saveUser('counsellor', $request->input('counsellor'));
				break;

				case 'teachers':
					$rules = [];
					foreach ($request->input('teachers') as $num => $info)
					{
						$rules["teachers.$num.first_name"] = 'required';
						$rules["teachers.$num.last_name"]  = 'required';
						$rules["teachers.$num.email"]      = 'required|email|unique:users,email';
					}

					$this->validate($request, $rules);
					$record->getRelated('users')->where('type', 'like', "%teachers%")->delete();

					foreach ($request->input('teachers') as $num => $info)
					{
						$record->saveUser('teachers.'.$num, $info);
					}

					$record->fill( $request->input() );
					$record->status = 'Completed';
					$record->save();

					$record->bootRegistration();

					if ($user = $record->user)
					{
						$user->status = 'Active';
						$user->save();
					}

				break;
			}



			return \Response::json(['result' => true, 'msg' => 'Gotcha.' ]);
		}

		return \Response::json(['result' => false, 'msg' => 'Invalid verification code.' ]);
	}
}
