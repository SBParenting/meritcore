<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_pages', function(Blueprint $table)
		{
			$table->increments("id"); 
			$table->string("title"); 
			$table->string("slug"); 
			$table->text("content"); 
			$table->boolean("published"); 
			$table->boolean('deletable')->default('1');
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
		Schema::drop('content_pages');
	}

}
