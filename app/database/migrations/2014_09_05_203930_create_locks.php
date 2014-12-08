<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocks extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locks', function(Blueprint $table)
        {


            $table->string('id', 25);
            $table->primary('id');
            $table->increments('id');

            $table->string('combination');
            $table->string('status',25);

            $table->string('locker_id')->length(50);
            $table->foreign('locker_id')->references('id')->on('lockers');

            $table->timestamps();
            $table->integer('updated_by_id')->unsigned();
            $table->foreign('updated_by_id')->references('id')->on('users');

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('locks');
    }

}
