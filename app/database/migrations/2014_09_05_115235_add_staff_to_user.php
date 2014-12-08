<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStaffToUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('users', function($table)
        {
            $table->integer('staff_id')->unsigned();
            $table->foreign('staff_id')->references('id')->on('staff');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::table('users', function($table)
        {
            $table->dropForeign('users_staff_id_foreign');
            $table->dropColumn('staff_id');
        });
	}

}
