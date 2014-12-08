<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentification extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("identifications", function($table) {

            $table->create();
            $table->integer('resident_id');
            $table->string('number')->length(50);
            $table->string('type')->length(16);
            $table->string('image')->length(255);

            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();


//            $table->unique(array('resident_id','number','type','deleted_at'));
            $table->index('resident_id');
            $table->index(array('resident_id','type'));
            $table->index('type','number');

            $table->foreign('resident_id')->references('id')->on('residents');
            $table->softDeletes();
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
        Schema::drop('identifications');
    }

}
