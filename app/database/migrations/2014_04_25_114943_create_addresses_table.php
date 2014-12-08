<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table("current_addresses", function($table) {

			$table->create();

			$table->increments('id');
			$table->integer('resident_id');
			$table->string('street1')->length(100)->nullable();
			$table->string('street2')->length(100)->nullable();
			$table->string('city')->length(100)->nullable();
			$table->string('postal')->length(10)->nullable();
			$table->string('region')->length(100)->nullable();
			$table->date('start_date');
			$table->date('end_date')->nullable();
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->decimal('latitude',12,8)->nullable();
			$table->decimal('longitude',12,8)->nullable();

			$table->timestamps();
		});



        Schema::table("previous_addresses", function($table) {

            $table->create();

            $table->increments('id');
            $table->integer('resident_id');
            $table->string('street1')->length(100)->nullable();
            $table->string('street2')->length(100)->nullable();
            $table->string('city')->length(100)->nullable();
            $table->string('postal')->length(10)->nullable();
            $table->string('region')->length(100)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->decimal('latitude',12,8)->nullable();
            $table->decimal('longitude',12,8)->nullable();

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
		Schema::drop('addresses');
        Schema::drop('current_addresses');
        Schema::drop('previous_addresses');
	}

}
