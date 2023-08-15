<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoOperacionalServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_operacional_servicio', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('estado_operacional_id')->nullable();
            $table->unsignedInteger('servicio_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('estado_operacional_servicio', function($table){
            $table->foreign('estado_operacional_id')->references('id')->on('estado_operacionals');
        });

        Schema::table('estado_operacional_servicio', function($table){
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
        Schema::dropIfExists('estado_operacional_servicio');
    }
}
