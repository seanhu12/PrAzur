<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_servicio', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('documento_id')->nullable();
            $table->unsignedInteger('servicio_id')->nullable();

            $table->timestamps();
        });

        Schema::table('documento_servicio', function($table){
            $table->foreign('documento_id')->references('id')->on('documentos');
        });

        Schema::table('documento_servicio', function($table){
            $table->foreign('servicio_id')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_servicio');
    }
}
