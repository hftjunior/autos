<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('renavam');
            $table->integer('client_id')->unsigned();
            $table->string('placa');
            $table->integer('state_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('chassi');
            $table->integer('specie_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('manufacturer_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->integer('yearmanufacture');
            $table->integer('yearmodel');
            $table->integer('capacity');
            $table->decimal('power',11,2);
            $table->decimal('cylinder',11,2);
            $table->integer('category_id')->unsigned();
            $table->integer('fuel_id')->unsigned();
            $table->text('note');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict');
            $table->foreign('specie_id')->references('id')->on('vehicle_species')->onDelete('restrict');
            $table->foreign('type_id')->references('id')->on('vehicle_types')->onDelete('restrict');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('restrict');
            $table->foreign('model_id')->references('id')->on('vehicle_models')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('vehicle_categories')->onDelete('restrict');
            $table->foreign('fuel_id')->references('id')->on('fuels')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
