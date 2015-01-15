<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_posts', function(Blueprint $table)
		{
			$table->increments("id"); 
			$table->string("title"); 
			$table->string("slug"); 
			$table->date("date"); 
			$table->text("content"); 
			$table->boolean("published"); 
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
		Schema::drop('content_posts');
	}

}
