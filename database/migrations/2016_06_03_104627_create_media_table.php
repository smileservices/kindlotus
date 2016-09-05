<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::dropIfExists('media');
        Schema::create('media', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('primary');
            $table->string('type', 10);
            $table->string('url', 60);
            $table->integer('mediaable_id')->unsigned();
            $table->string('mediaable_type');
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
        Schema::drop('media', function (Blueprint $table) {
            //
        });
    }
}
