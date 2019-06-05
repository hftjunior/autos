<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',256);
            $table->date('dtbirth');
            $table->string('cpf',14);
            $table->string('identity',32);
            $table->string('cnh',32);
            $table->date('dtcnh');
            $table->date('dtcnhdue');
            $table->string('type_street',32);
            $table->string('street',256);
            $table->integer('number');
            $table->string('complement',128);
            $table->string('neighborhood',128);
            $table->integer('city_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->string('cep',9);
            $table->string('tel_home',20);
            $table->string('tel_work',20);
            $table->string('cell',20);
            $table->string('email',128);
            $table->text('note');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
