<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarnings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('warnings', function(Blueprint $table)
		{
            $table->increments('id');

            $table->integer('created_by_id')->unsigned();
            $table->integer('updated_by_id')->unsigned();
            $table->smallInteger('duration')->unsigned();
            $table->string('reason', 50);

            $table->integer('resident_id')->unsigned();
            $table->date('end_date')->nullable();
            $table->integer('shift_note_id')->unsigned();
            $table->integer('detail_note_id')->unsigned();
            $table->string('status',25);


            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
            $table->foreign('resident_id')->references('id')->on('residents');
            $table->foreign('shift_note_id')->references('id')->on('notes');
            $table->foreign('detail_note_id')->references('id')->on('notes');
            $table->timestamps();
            $table->softDeletes();


            $table->index('created_by_id');
            $table->index('resident_id');
            $table->index('reason');
            $table->index(array('created_by_id','status'));
            $table->index(array('resident_id','status'));
            $table->index('end_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('warnings');
	}

}
