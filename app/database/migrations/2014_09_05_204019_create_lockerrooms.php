<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLockerrooms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lockerrooms', function(Blueprint $table)
		{
			$table->string('id');
            $table->string('name');
            $table->smallInteger('columns')->unsigned()->default(2);
            $table->smallInteger('order')->unsigned();


            $table->primary('id');
            $table->unique('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lockerrooms');
	}

}
