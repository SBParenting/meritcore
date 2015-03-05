<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrengthsScore extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create("strength_scores",function($table){
            $table->increments('id');
            $table->integer('child_id');
            $table->integer('strength_id');
            $table->string('strength_kind');
            $table->integer('score');
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
        Schema::dropIfExists("strength_scores");
	}

}
