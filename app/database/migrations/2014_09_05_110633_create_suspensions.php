<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuspensions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suspensions', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('type',25);
            $table->integer('created_by_id')->unsigned();
            $table->integer('updated_by_id')->unsigned()->nullable();
            $table->integer('deleted_by_id')->unsigned()->nullable();
            $table->smallInteger('duration')->unsigned();
            $table->integer('resident_id')->unsigned();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('shift_note_id')->unsigned();
            $table->integer('detail_note_id')->unsigned();
            $table->string('status', 16);


            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('updated_by')->references('id')->on('staff');
            $table->foreign('resident_id')->references('id')->on('residents');
            $table->foreign('shift_note_id')->references('id')->on('notes');
            $table->foreign('detail_note_id')->references('id')->on('notes');
            $table->timestamps();
            $table->softDeletes();


            $table->index('resident_id');
            $table->index('created_by_id');
            $table->index(array('resident_id','type'));
            $table->index('type');
            $table->index('end_date');
            $table->index(array('resident_id','status'));
            $table->index(array('created_by_id','status'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('suspensions');
    }

}
