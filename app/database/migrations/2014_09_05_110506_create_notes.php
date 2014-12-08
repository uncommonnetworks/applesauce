<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('type', 25);
            $table->text('text');
            $table->string('title',50);
            $table->boolean('important')->default(false);
            $table->integer('author_id')->unsigned();
            $table->integer('updated_by')->unsigned();
			$table->timestamps();

            $table->index('type');
            $table->index('author_id');
            $table->index(array('type','author_id'));
		});

        Schema::create('noted', function(Blueprint $table)
        {
            $table->integer('note_id')->unsigned();
            $table->integer('noted_id')->unsigned();
            $table->string('noted_type');

            $table->index('note_id');
            $table->unique('note_id','noted_id','noted_type');
            $table->index('noted_id','noted_type');

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notes');
	}

}
