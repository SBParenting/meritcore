<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('children',function($table){
			$table->increments('id');
			$table->string('first_name',100);
			$table->string('last_name',100);
			$table->date('birth_date');
			$table->string('sex',6);
			$table->string('student_id',64)->nullable();
			$table->string('avatar')->nullable();
			$table->softDeletes();
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
		Schema::dropIfExists('children');
	}

}
