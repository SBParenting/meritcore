<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_stats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->integer('strong_percentage');
			$table->integer('vulnerable_percentage');
			$table->integer('strong_count');
			$table->integer('vulnerable_count');
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
		Schema::drop('campaign_stats');
	}

}
