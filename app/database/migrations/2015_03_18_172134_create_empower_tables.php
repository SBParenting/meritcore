<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpowerTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('empower_questions',function($table){
            $table->increments('id');
            $table->string('question');
            $table->timestamps();
        });

        Schema::create('empower_feedback_questions',function($table){
            $table->increments('id');
            $table->integer('question');
            $table->timestamps();
        });

        Schema::create('empower_children',function($table){
            $table->increments('id');
            $table->integer('child_id');
            $table->integer('strength_score_id');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('empower_feedbacks',function($table){
            $table->increments('id');
            $table->integer('empower_children_id');
            $table->integer('parent_score');
            $table->integer('child_score');
            $table->timestamps();
        });

        Schema::create('empower_answers',function($table){
            $table->increments('id');
            $table->integer('empower_children_id');
            $table->integer('empower_question_id');
            $table->integer('answer');
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
        Schema::dropIfExists('empower_questions');
        Schema::dropIfExists('empower_feedback_questions');
        Schema::dropIfExists('empower_feedbacks');
        Schema::dropIfExists('empower_children');
        Schema::dropIfExists('empower_answers');
	}

}
