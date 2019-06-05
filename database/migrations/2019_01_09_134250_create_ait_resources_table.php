<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAitResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ait_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ait_id')->unsigned();
            $table->integer('agency_id')->unsigned();
            $table->string('instance');
            $table->string('process');
            $table->string('protocol');
            $table->date('date_resource');
            $table->date('date_judgment');
            $table->integer('status_id')->unsigned();
            $table->text('result');
            $table->timestamps();

            $table->foreign('ait_id')->references('id')->on('aits')->onDelete('restrict');
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('restrict');
            $table->foreign('status_id')->references('id')->on('ait_resource_statuses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ait_resources');
    }
}
