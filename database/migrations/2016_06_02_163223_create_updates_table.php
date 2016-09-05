<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('updates');
        Schema::create('updates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('cause_id')->unsigned();
            $table->string('title')->index();
            $table->text('content');
            $table->tinyInteger('active');
            $table->integer('updateable_id')->unsigned();
            $table->string('updateable_type');
            $table->timestamps();
        });

        Schema::table('updates', function (Blueprint $table) {
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
        Schema::drop('updates', function (Blueprint $table) {
            //
        });
    }
}
