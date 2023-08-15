<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFocoIntervencionPropuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foco_intervencion_propuesta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('propuesta_id');
            $table->unsignedInteger('foco_intervencion_id');

            $table->timestamps();
        });

        Schema::table('foco_intervencion_propuesta', function ($table) {
            $table->foreign('propuesta_id')->references('id')->on('propuestas');
        });

        Schema::table('foco_intervencion_propuesta', function ($table) {
            $table->foreign('foco_intervencion_id')->references('id')->on('foco_intervencions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foco_intervencion_propuesta');
    }
}
