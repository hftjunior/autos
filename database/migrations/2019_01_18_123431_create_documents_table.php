<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id')->unsigned();
            $table->integer('identify');
            $table->integer('type_id')->unsignet();
            $table->string('document');
            $table->date('dtdocument');
            $table->date('expiration');
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('document_entities')->onDelete('restrict');
            $table->foreign('type_id')->references('id')->on('document_types')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
