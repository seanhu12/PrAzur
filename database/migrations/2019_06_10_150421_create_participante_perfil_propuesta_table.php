<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantePerfilPropuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante_perfil_propuesta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('propuesta_id');
            $table->unsignedInteger('participante_perfil_id');

            $table->timestamps();
        });

        Schema::table('participante_perfil_propuesta', function ($table) {
            $table->foreign('propuesta_id')->references('id')->on('propuestas');
        });

        Schema::table('participante_perfil_propuesta', function ($table) {
            $table->foreign('participante_perfil_id')->references('id')->on('participante_perfils');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participante_perfil_propuesta');
    }
}
