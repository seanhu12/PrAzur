<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_propuesta');
            $table->date('fecha_compromiso')->nullable();
            //$table->unsignedInteger('cant_total_horas')->nullable();
            $table->unsignedDecimal('cant_total_horas',3,1)->nullable();
            $table->unsignedInteger('monto')->nullable();
            $table->unsignedInteger('monto_final')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('observacion_foco')->nullable();
            $table->string('idp');
            $table->unsignedInteger('uf_hora')->nullable();
            $table->boolean('experiencia_ads')->nullable();
            $table->text('experiencia_en')->nullable();
            $table->boolean('experiencia_tematica')->nullable();
            $table->string('last_estado')->nullable()->default('No enviada');
            $table->unsignedInteger('area_id');
            $table->unsignedInteger('tipo_servicio_id')->nullable();
            $table->unsignedInteger('programa_id')->nullable();
            $table->unsignedInteger('curso_id')->nullable();
            $table->unsignedInteger('contacto_otic_id')->nullable();
            $table->unsignedInteger('empresa_id');
            $table->unsignedInteger('otic_id')->nullable();
            $table->unsignedInteger('urgencia_id')->nullable();
            $table->unsignedInteger('complejidad_grupo_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('propuestas', function ($table) {
            $table->foreign('area_id')->references('id')->on('areas');
        });

        Schema::table('propuestas', function ($table) {
            $table->foreign('tipo_servicio_id')->references('id')->on('tipo_servicios');
        });

        Schema::table('propuestas', function ($table) {
            $table->foreign('programa_id')->references('id')->on('programas');
        });

        Schema::table('propuestas', function ($table) {
            $table->foreign('curso_id')->references('id')->on('cursos');
        });

        Schema::table('propuestas', function ($table) {
            $table->foreign('contacto_otic_id')->references('id')->on('contacto_otics');
        });

        Schema::table('propuestas', function ($table) {
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });

        Schema::table('propuestas', function ($table) {
            $table->foreign('otic_id')->references('id')->on('otics');
        });

        Schema::table('propuestas', function ($table) {
            $table->foreign('urgencia_id')->references('id')->on('urgencias');
        });

        Schema::table('propuestas', function($table){
            $table->foreign('complejidad_grupo_id')->references('id')->on('complejidad_grupos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propuestas');
    }
}
