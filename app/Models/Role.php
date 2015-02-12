<?php namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	public static $public = [
		'teacher'            => 'I am a teacher at a school',
		'counsellor'         => 'I am a counsellor at a school',
		'school_admin'       => 'I am a school administrator',
		'school_board_admin' => 'I am a school board administrator',
	];

	public function hasPermission($id)
	{
		foreach ($this->perms as $perm)
		{
			if ($perm->id == $id)
			{
				return true;
			}
		}

		return false;
	}
}