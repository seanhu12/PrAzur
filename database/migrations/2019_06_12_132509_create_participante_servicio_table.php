<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipanteServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante_servicio', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('servicio_id');
            $table->unsignedInteger('participante_id');
            $table->unsignedInteger('encuesta_ads_id')->nullable();;
            $table->boolean('asistencia')->nullable();
            $table->boolean('vigencia')->nullable();

            $table->timestamps();
        });

        Schema::table('participante_servicio', function ($table) {
            $table->foreign('servicio_id')->references('id')->on('servicios');
        });

        Schema::table('participante_servicio', function ($table) {
            $table->foreign('participante_id')->references('id')->on('participantes');
        });

        Schema::table('participante_servicio', function ($table) {
            $table->foreign('encuesta_ads_id')->references('id')->on('encuesta_ads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participante_servicio');
    }
}
