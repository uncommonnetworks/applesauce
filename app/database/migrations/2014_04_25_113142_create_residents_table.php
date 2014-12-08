<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("residents", function($table) {

            $table->create();

            $table->increments('id');
            $table->string('first_name')->length(50);
            $table->string('middle_name')->length(50);
            $table->string('last_name')->length(50);
            $table->string('title')->length(50);
            $table->string('goes_by_name')->length(50);
            $table->string('display_name')->length(150);
            $table->date('date_of_birth');
            $table->string('marital_status')->length(50);
            $table->string('status')->length(30)->default('former-resident');
            $table->string('sin')->length(11);
            $table->string('health_card_number')->length(15);
            $table->string('contact_name')->length(100);
            $table->string('contact_street1')->length(100);
            $table->string('contact_street2')->length(100);
            $table->string('contact_city')->length(50);
            $table->string('contact_phone')->length(15);
            $table->string('contact_relationship')->length(50);
            $table->string('doctor_name')->length(100);
            $table->string('doctor_phone')->length(15);
            $table->string('gender')->length(1);
            $table->text('previous_region')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->integer('locker_id')->unsigned()->nullable();
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
        Schema::drop("residents");
    }

}
