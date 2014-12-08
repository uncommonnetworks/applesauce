<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BedTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table("bedrooms", function($table) {
            $table->create();
            $table->string('id')->length(10);
            $table->string('name')->length(50);
            $table->smallInteger('columns')->unsigned()->default(2);
            $table->smallInteger('order')->unsigned();
            $table->primary('id');
            $table->unique('name');
        });

        Schema::table("beds", function($table) {

            $table->create();

            $table->increments('id');
            $table->string('name')->length(50);
            $table->string('status')->length(50);
            $table->string('room_id')->length(10);
            $table->string('residency_id')->length(50);
            $table->integer('updated_by_id')->unsigned()->nullable();
            $table->foreign('residency_id')->references('id')->on('residencies');
            $table->foreign('room_id')->references('id')->on('bedrooms');
            $table->foreign('updated_by_id')->references('id')->on('users');

        });

        Schema::table("bed_history", function($table)
        {
            $table->create();
            $table->increments('id');
            $table->integer('bed_id')->unsigned();
            $table->integer('resident_id')->unsigned()->nullable();
            $table->string('status')->length(20);
            $table->date('nightDate');
            $table->unique(array('nightDate','bed_id'));
            $table->foreign('resident_id')->references('id')->on('residents');
            $table->foreign('bed_id')->references('id')->on('beds');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bedrooms');
        Schema::drop('beds');
        Schema::drop('bed_history');
	}

}
