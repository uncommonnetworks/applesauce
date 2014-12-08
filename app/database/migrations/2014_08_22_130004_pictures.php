<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pictures extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table("pictures", function($table) {

            $table->create();

            $table->increments('id');
            $table->integer('pictureable_id');
            $table->string('path')->length(250);
            $table->string('pictureable_type')->length(50);
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
		Scheme::drop('pictures');
	}

}
