<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();
		DB::table('roles')->truncate();

		User::create(array(
			'first_name' => 'Aquanode',
			'last_name'  => 'Interactive',
			'username'   => 'admin',
			'email'      => 'sheldon@aquanode.com',
			'password'   => 'minnow9822',
			'role_id'	 => '1',
			'status'	 => 'Active',
			'updatable'  => false,	
			'deletable'  => false,	
		));

		Role::create(array(
			'name'        => 'Administrator',
			'description' => 'Full administrative access',
			'updatable'	  => '0',	
		));

		Role::create(array(
			'name'        => 'Authenticated',
			'description' => 'Authenticated general access',
			'updatable'	  => '1',	
		));

		Role::create(array(
			'name'        => 'Anonymous',
			'description' => 'Non-authenticated public user',
			'updatable'	  => '1',	
		));
	}
}