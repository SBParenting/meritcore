<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSchoolClassesTableAddStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('school_classes', function($table) {
			$table->string('status')->after('grade');
		});

		\DB::table('school_classes')->update(['status' => 'Active']);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('school_classes', function($table) {
			$table->dropColumn('status');
		});
	}

}
