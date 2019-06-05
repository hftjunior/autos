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
            $table->integer('client_id');
            $table->string('placa');
            $table->string('chassi');
            $table->integer('specie_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('manufacturer_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->integer('yearmanufacture');
            $table->integer('yearmodel');
            $table->integer('capacity');
            $table->double('power');
            $table->double('cylinder');
            $table->integer('category_id')->unsigned();
            $table->text('note');
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
        Schema::dropIfExists('vehicles');
    }
}
