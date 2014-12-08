<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLockers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lockers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();


            $table->string('name')->length(50);
            $table->string('status')->length(50);
            $table->string('room_id')->length(10);
            $table->integer('row')->unsigned();
            $table->integer('updated_by_id')->unsigned();

            $table->string('resident_id')->length(50);
            $table->foreign('resident_id')->references('id')->on('residents');
            $table->foreign('room_id')->references('id')->on('lockerrooms');
            $table->foreign('updated_by_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lockers');
	}

}
