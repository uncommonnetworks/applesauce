<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidency extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table("residencies", function($table) {

            $table->create();

            $table->increments('id');
            $table->integer('resident_id')->unsigned();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('exp_rent')->nullable()->unsigned();
            $table->integer('exp_taxes')->nullable()->unsigned();
            $table->integer('exp_room_and_board')->nullable()->unsigned();
            $table->integer('exp_fire_insurance')->nullable()->unsigned();
            $table->integer('exp_mortgage')->nullable()->unsigned();
            $table->integer('exp_fuel')->nullable()->unsigned();
            $table->text('assets_of_value');
            $table->integer('income_total')->nullable()->unsigned();
            $table->integer('lock_id')->nullable();
//            $table->integer('locker_id')->nullable();
            $table->integer('coach_id');

            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
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
        //
        Schema::drop('residencies');
    }

}