<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumToEmpowerAndReflectTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('empower_questions',function($table){
            $table->integer('num')->after('strength_id');
        });

        Schema::table('reflect_questions',function($table){
            $table->integer('num')->after('strength_id');
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
        Schema::table('empower_questions',function($table){
            $table->dropColumn('num');
        });

        Schema::table('reflect_questions',function($table){
            $table->dropColumn('num');
        });
	}

}
