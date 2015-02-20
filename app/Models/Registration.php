<?php namespace App\Models;

use App\Models\RegistrationUser as RUser;
use App\Models\School;

class Registration extends \App\Models\Model {

	protected $table = 'registrations';

	protected $fillable = ['school_name', 'school_city', 'school_province', 'school_board', 'progress'];

	protected $related = ['users' => 'App\Models\RegistrationUser'];

	protected $relation_key = 'registration_id';

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function users()
	{
		return $this->hasMany('App\Models\RegistrationUser');
	}

	public function saveUser($type, $info)
	{
		$user = RUser::where('registration_id', '=', $this->id)->where('type', '=', $type)->first();

		$info['type'] = $type;

		if ($user)
		{
			$user->fill($info)->save();
		}
		else
		{
			$user = new RUser(['registration_id' => $this->id]);

			$user->fill($info)->save();
		}
	}

	public function bootRegistration()
	{
		$school_board = SchoolBoard::create([
			'name'             => $this->school_board,
		]);

		$school = School::create([
			'name'             => $this->school_name,
			'email'            => $this->school_email,
			'address_city'     => $this->school_city,
			'address_province' => $this->school_province,
			'school_board_id'  => $school_board->id,
		]);

		$user = $this->user;

		if ($user)
		{
			UserAssoc::create([
				'school_board_id' => $school_board->id,
				'user_id'         => $user->id,
			]);

			UserAssoc::create([
				'school_id' => $school_board->id,
				'user_id'         => $user->id,
			]);
		}

		foreach ($this->users as $user)
		{
			if ($user->type == 'principal')
			{
				$role = Role::where('name', '=', 'school')->first();
			}

			if ($user->type == 'counsellor')
			{
				$role = Role::where('name', '=', 'counsellor')->first();
			}

			if (strpos($user->type, "teacher") !== false)
			{
				$role = Role::where('name', '=', 'teacher')->first();
			}

			if ($role)
			{
				$u = User::create([
					'first_name' => $user->first_name,
					'last_name'  => $user->last_name,
					'username'   => $user->email,
					'email'      => $user->email,
					'role_id'    => $role->id,
					'status'     => 'Invited',
				]);

				$u->attachRole($role);

				UserAssoc::create([
					'school_id' => $school->id,
					'user_id'   => $u->id,
				]);
			}
		}
	}
}