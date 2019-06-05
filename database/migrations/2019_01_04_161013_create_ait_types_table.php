<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAitTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ait_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->text('description');
            $table->string('legal');
            $table->integer('points');
            $table->decimal('value',10,2);
            $table->integer('gravity_id')->unsigned();
            $table->integer('measure_id')->unsigned();
            $table->timestamps();

            $table->foreign('gravity_id')->references('id')->on('ait_gravities')->onDelete('restrict');
            $table->foreign('measure_id')->references('id')->on('ait_measures')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ait_types');
    }
}
