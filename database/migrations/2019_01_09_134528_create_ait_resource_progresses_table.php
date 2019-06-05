<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAitResourceProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ait_resource_progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resource_id')->unsigned();
            $table->date('date');
            $table->time('time');
            $table->integer('origin_id')->unsigned();
            $table->integer('means_id')->unsigned();
            $table->text('progress');
            $table->timestamps();

            $table->foreign('resource_id')->references('id')->on('ait_resources')->onDelete('restrict');
            $table->foreign('origin_id')->references('id')->on('ait_progress_origins')->onDelete('restrict');
            $table->foreign('means_id')->references('id')->on('ait_progress_means')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ait_resource_progresses');
    }
}
