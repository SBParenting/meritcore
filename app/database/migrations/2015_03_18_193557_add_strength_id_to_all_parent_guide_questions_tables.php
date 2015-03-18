<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStrengthIdToAllParentGuideQuestionsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('reflect_questions',function($table){
            $table->integer('strength_id')->after('id');
        });

        Schema::table('explore_questions',function($table){
            $table->integer('strength_id')->after('id');
        });

        Schema::table('build_options',function($table){
            $table->integer('strength_id')->after('id');
        });

        Schema::table('empower_questions',function($table){
            $table->integer('strength_id')->after('id');
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
        Schema::table('reflect_questions',function($table){
            $table->dropColumn('strength_id');
        });

        Schema::table('explore_questions',function($table){
            $table->dropColumn('strength_id');
        });

        Schema::table('build_options',function($table){
            $table->dropColumn('strength_id');
        });

        Schema::table('empower_questions',function($table){
            $table->dropColumn('strength_id');
        });
	}

}
