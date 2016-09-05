<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausesNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('causes_needs');
        Schema::create('causes_needs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('cause_id')->unsigned();
            $table->integer('need_id')->unsigned();

        });

        Schema::table('causes_needs', function (Blueprint $table) {
            $table->foreign('cause_id')
                ->references('id')->on('causes')
                ->onDelete('cascade');
            $table->foreign('need_id')
                ->references('id')->on('needs')
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
        Schema::drop('causes_needs', function (Blueprint $table) {
            //
        });
    }
}
