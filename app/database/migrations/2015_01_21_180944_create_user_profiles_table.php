<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('user_profiles',function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->string('first_name',100);
			$table->string('last_name',100);
			$table->string('daytime_phone',16);
			$table->string('evening_phone',16);
			$table->string('mobile_phone',16);
			$table->string('address_street',100);
			$table->string('address_city',100);
			$table->string('address_postal_code',100);
			$table->string('address_province',100);
			$table->text('notes');
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
		//
		Schema::dropIfExists('user_profiles');
	}

}
