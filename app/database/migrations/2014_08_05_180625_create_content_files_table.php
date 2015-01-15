<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_files', function(Blueprint $table)
		{
			$table->increments("id"); 
			$table->string("title"); 
			$table->string("path"); 
			$table->string("extension", 10); 
			$table->timestamps(); 
			$table->softDeletes(); 
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('content_files');
	}

}
