<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 100);
			$table->string('last_name', 100);
			$table->string('username', 100)->unique();
			$table->string('email')->unique();	
			$table->string('password');
			$table->rememberToken();
			$table->integer('role_id');
			$table->string('status', 20);
			$table->dateTime('last_login');
			$table->boolean('updatable')->default('1');
			$table->boolean('deletable')->default('1');
			$table->timestamps();
		});

		Schema::create('roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->text('description');
			$table->longText('permissions');
			$table->boolean('updatable')->default('1');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');

		Schema::drop('roles');
	}

}
