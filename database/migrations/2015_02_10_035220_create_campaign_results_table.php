<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_results', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('campaign_id');
			$table->integer('campaign_student_id');
			$table->integer('school_board_id');
			$table->integer('school_id');
			$table->integer('class_id');
			$table->integer('student_id');
			$table->integer('question_id');
			$table->integer('result');
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
		Schema::drop('campaign_results');
	}

}
