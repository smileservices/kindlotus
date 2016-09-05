<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausesTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('causes_tags');
        Schema::create('causes_tags', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('cause_id')->unsigned();
            $table->integer('tag_id')->unsigned();

        });

        Schema::table('causes_tags', function (Blueprint $table) {
            $table->foreign('cause_id')
                ->references('id')->on('causes')
                ->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('id')->on('tags')
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
        Schema::drop('causes_tags', function (Blueprint $table) {
            //
        });
    }
}
