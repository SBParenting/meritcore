<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAssociationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_associations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('school_board_id')->nullable();
			$table->integer('school_id')->nullable();
			$table->integer('class_id')->nullable();
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
		Schema::drop('user_associations');
	}

}
