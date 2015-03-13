<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExploreBuildTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('explore_questions',function($table){
            $table->increments('id');
            $table->string('question');
            $table->timestamps();
        });

        Schema::create('build_options',function($table){
            $table->increments('id');
            $table->string('option');
            $table->timestamps();
        });

        Schema::create('explore_answers',function($table){
            $table->increments('id');
            $table->integer('strength_score_id');
            $table->integer('explore_question_id');
            $table->integer('build_option_id');
            $table->integer('score');
            $table->string('status');
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
        Schema::dropIfExists('explore_questions');
        Schema::dropIfExists('build_options');
        Schema::dropIfExists('explore_answers');
	}

}
