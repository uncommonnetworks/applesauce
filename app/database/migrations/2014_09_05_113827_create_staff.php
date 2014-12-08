<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaff extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('initials',5);
            $table->string('signature');
            $table->string('phone');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('staff');
	}

}
