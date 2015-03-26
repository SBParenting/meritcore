<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateExploreAnswersAndStrengthTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('explore_answers',function($table){
            $table->dateTime('last_remind')->after('status');
        });

        Schema::table('strengths',function($table){
            $table->text('description')->after('name');
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
        Schema::table('explore_answers',function($table){
            $table->dropColumn('last_remind');
        });

        Schema::table('strengths',function($table){
            $table->dropColumn('description');
        });
	}

}
