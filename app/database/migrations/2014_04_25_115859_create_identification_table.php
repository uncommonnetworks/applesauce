<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("identification", function($table) {

			$table->create();

			$table->increments('id');
			$table->integer('resident');
			$table->string('type')->length(50);
			$table->string('number')->length(50);
			$table->integer('createdBy');
			$table->integer('updatedBy');

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
		Schema::drop('identification');
	}

}
