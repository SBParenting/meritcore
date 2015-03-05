<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrengthsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('strengths',function($table){
            $table->increments('id');
            $table->integer('strength_group_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('strength_groups',function($table){
            $table->increments('id');
            $table->string('name');
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
        Schema::dropIfExists('strengths');
        Schema::dropIfExists('strength_groups');
	}

}
