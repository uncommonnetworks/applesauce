<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllergiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table("allergies", function($table) {

            $table->create();
            $table->increments('id');
            $table->string('name')->length(50)->unique();
            $table->softDeletes();

        });

        Schema::table('allergy_resident', function($table) {
            $table->create();
            $table->integer('allergy_id');
            $table->integer('resident_id');
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
		Schema::drop('allergies');
	}

}
