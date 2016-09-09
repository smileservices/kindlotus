<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('maps');
        Schema::create('maps', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('cause_id')->unsigned();
            $table->string('coordsX');
            $table->string('coordsY');
            $table->string('country');
            $table->string('area');
            $table->string('city');
        });

        Schema::table('maps', function (Blueprint $table) {
            $table->foreign('cause_id')
                ->references('id')->on('causes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maps', function (Blueprint $table) {
            //
        });
    }
}
