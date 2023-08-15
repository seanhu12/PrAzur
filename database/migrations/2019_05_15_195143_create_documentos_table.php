<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('codigo')->unique();
            $table->string('file_name');
            $table->string('hash_file_name');
            $table->unsignedInteger('tematica_id');
            $table->unsignedInteger('tipo_documento_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('documentos', function($table){
            $table->foreign('tematica_id')->references('id')->on('tematicas');
        });

        Schema::table('documentos', function($table){
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documentos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
