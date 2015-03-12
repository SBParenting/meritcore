<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReflectTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('reflect_questions',function($table){
            $table->increments('id');
            $table->string('question');
            $table->timestamps();
        });

        Schema::create('reflect_statements',function($table){
            $table->increments('id');
            $table->integer('reflect_question_id');
            $table->string('statement');
            $table->timestamps();
        });

        Schema::create('reflect_answers',function($table){
            $table->increments('id');
            $table->integer('parent_id');
            $table->integer('reflect_question_id');
            $table->integer('reflect_statement_id');
            $table->string('thoughts');
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
        Schema::dropIfExists('reflect_answers');
        Schema::dropIfExists('reflect_statements');
        Schema::dropIfExists('reflect_questions');
	}

}
