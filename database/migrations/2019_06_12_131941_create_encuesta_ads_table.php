<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestaAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuesta_ads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('respuesta_1');
            $table->unsignedInteger('respuesta_2');
            $table->unsignedInteger('respuesta_3');
            $table->unsignedInteger('respuesta_4');
            $table->unsignedInteger('respuesta_5');
            $table->unsignedInteger('respuesta_6');
            $table->unsignedInteger('respuesta_7');

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
        Schema::dropIfExists('encuesta_ads');
    }
}
