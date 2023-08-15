<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapaServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etapa_servicio', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('etapa_id')->nullable();
            $table->unsignedInteger('servicio_id')->nullable();

            $table->timestamps();
            $table->dateTime('end_date')->nullable();
            $table->softDeletes();
        });

        Schema::table('etapa_servicio', function($table){
            $table->foreign('etapa_id')->references('id')->on('etapas');
        });

        Schema::table('etapa_servicio', function($table){
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
        Schema::dropIfExists('etapa_servicio');
    }
}
