<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingStrengthIdOnReflectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('reflect_answers',function($table){
            $table->integer('strength_score_id')->after('parent_id');
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
        Schema::table('reflect_answers',function($table){
            $table->dropColumn('strength_score_id');
        });
	}

}
