<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesResidents extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes_residents', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('note_id')->unsigned();
            $table->integer('resident_id')->unsigned();

            $table->foreign('note_id')->references('id')->on('notes');
            $table->foreign('resident_id')->references('id')->on('residents');
//			$table->timestamps();

            $table->index('note_id');
            $table->index('resident_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notes_residents');
    }

}
