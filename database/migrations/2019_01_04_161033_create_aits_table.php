<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agency_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('vehicle_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->date('date');
            $table->time('time');
            $table->string('local');
            $table->integer('state_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->date('date_included');
            $table->date('deadline');
            $table->string('number');
            $table->integer('processing');
            $table->decimal('value',11,2);
            $table->integer('points');
            $table->timestamps();

            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('restrict');
            $table->foreign('client_id')->references('id')->on('clientes')->onDelete('restrict');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('restrict');
            $table->foreign('status_id')->references('id')->on('ait_statuses')->onDelete('restrict');
            $table->foreign('type_id')->references('id')->on('ait_types')->onDelete('restrict');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict');           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aits');
    }
}
