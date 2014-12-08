<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncomeMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('incomes', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('residency_id')->unsigned();
            $table->string('type', 25);
            $table->integer('source')->unsigned();
            $table->smallInteger('amount')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_by_id')->unsigned();
            $table->integer('updated_by_id')->unsigned()->nullable();
            $table->integer('deleted_by_id')->unsigned()->nullable();

            $table->foreign('residency_id')->references('id')->on('residencies');

            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('deleted_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
            $table->foreign('source')->references('id')->on('income_sources');


            $table->index('residency_id');
            $table->index('type');
            $table->index('source');
        });

        Schema::create('income_sources', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('source', 50);
            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_by_id')->unsigned();
            $table->integer('updated_by_id')->unsigned()->nullable();
            $table->integer('deleted_by_id')->unsigned()->nullable();


            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('deleted_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');

            $table->index('source');
        });


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('incomes');
        Schema::drop('income_sources');
	}

}
