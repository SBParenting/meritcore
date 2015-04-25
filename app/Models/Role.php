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

	public static function getRoles($id)
	{
//		$roleArray = array('5' => array('5','6','7','8','9'), '6' => array('7','8','9'), '7' => array('8','9'));

		$roleArray = array(
			'admin' => [
				'admin',
				'school_board',
				'school',
				'teacher',
				'counsellor'
			],
			'school_board' => [
				'school',
				'teacher',
				'counsellor'
			],
			'school' => [
				'teacher',
				'counsellor'
			]
		);
		

		$roles = self::whereIn('name',$roleArray[$id])->get();

        return $roles;
	}
	
}