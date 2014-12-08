<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('residentStatusHistory', function($table) {

			$table->create();

			$table->integer('resident');
			$table->string('status')->length(30);
			$table->date('startDate');
			$table->date('endDate');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('residentStatusHistory');
	}

}
