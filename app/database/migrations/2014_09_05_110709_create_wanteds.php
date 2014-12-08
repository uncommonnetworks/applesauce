<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWanteds extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wanteds', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('staff_id')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->integer('resident_id')->unsigned()->nullable();

            $table->integer('shift_note_id')->unsigned();
            $table->string('name');


            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('updated_by')->references('id')->on('staff');
            $table->foreign('resident_id')->references('id')->on('residents');
            $table->foreign('shift_note_id')->references('id')->on('notes');

            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
            $table->index('staff_id');
            $table->index('resident_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wanteds');
    }

}
