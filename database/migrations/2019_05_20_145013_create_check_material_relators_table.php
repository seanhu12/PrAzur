<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckMaterialRelatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_material_relators', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('libro_asistencia_listo')->nullable();
            $table->boolean('libro_asistencia_recepcion')->nullable();
            $table->boolean('encuesta_ads_listo')->nullable();
            $table->boolean('encuesta_ads_recepcion')->nullable();
            $table->boolean('encuesta_empresa_aplica')->nullable();
            $table->boolean('encuesta_empresa_listo')->nullable();
            $table->boolean('encuesta_empresa_recepcion')->nullable();
            $table->boolean('pendones_listo')->nullable();
            $table->boolean('pendones_recepcion')->nullable();
            $table->boolean('proyector_aplica')->nullable();
            $table->boolean('proyector_listo')->nullable();
            $table->boolean('proyector_recepcion')->nullable();
            $table->boolean('preparar_guia_aplica')->nullable();
            $table->boolean('preparar_guia_listo')->nullable();
            $table->boolean('preparar_guia_recepcion')->nullable();
            $table->boolean('preparar_prueba_aplica')->nullable();
            $table->boolean('preparar_prueba_listo')->nullable();
            $table->boolean('preparar_prueba_recepcion')->nullable();
            $table->boolean('plumones_aplica')->nullable();
            $table->boolean('plumones_listo')->nullable();
            $table->boolean('plumones_recepcion')->nullable();
            $table->boolean('notebook_aplica')->nullable();
            $table->boolean('notebook_listo')->nullable();
            $table->boolean('notebook_recepcion')->nullable();
            $table->boolean('encuesta_adicional_aplica')->nullable();
            $table->boolean('encuesta_adicional_listo')->nullable();
            $table->boolean('encuesta_adicional_recepcion')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_material_relators');
    }
}
