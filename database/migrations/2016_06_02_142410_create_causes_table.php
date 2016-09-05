<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('causes');
        Schema::create('causes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('ngo_id')->unsigned();
            $table->string('name');
            $table->text('story');
            $table->string('description');
            $table->text('contact');
            $table->tinyInteger('active');
            $table->tinyInteger('success');
            $table->timestamps();            
            
        });

        Schema::table('causes', function (Blueprint $table) {
            $table->foreign('ngo_id')
                ->references('id')->on('ngos')
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
        Schema::drop('causes', function (Blueprint $table) {
            //
        });
    }
}
