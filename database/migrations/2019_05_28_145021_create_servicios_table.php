<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ot');
            $table->string('nombre');
            $table->date('fecha_ejecucion');
            $table->string('horario')->nullable();
            $table->string('lugar_realizacion')->nullable();
            $table->string('salon')->nullable();
            //$table->unsignedInteger('cant_horas')->nullable();
            $table->unsignedDecimal('cant_horas',3,1)->nullable();
            $table->unsignedInteger('cant_participantes')->nullable();
            $table->string('orden_compra')->nullable();
            $table->text('detalles')->nullable();
            $table->string('id_accion')->nullable();
            $table->string('horario_coffee_am')->nullable();
            $table->string('horario_coffee_pm')->nullable();
            $table->string('horario_almuerzo')->nullable();
            $table->boolean('sence_aplica')->nullable();
            $table->unsignedInteger('monto_servicio')->nullable();
            $table->text('observaciones_checklist')->nullable();
            $table->boolean('outdoor_aplica')->nullable();

            $table->boolean('logistica_listo')->nullable();
            $table->boolean('cierre_listo')->nullable();

            $table->boolean('audio_iluminacion_aplica')->nullable();
            $table->boolean('diploma_programa_aplica')->nullable();
            $table->string('certificado_sence')->nullable();
            $table->string('last_estado_operacional')->nullable()->default('A tiempo');
            $table->string('last_etapa')->nullable()->default('Diseño');

            $table->unsignedInteger('curso_id');
            $table->unsignedInteger('ciudad_id')->nullable();
            $table->unsignedInteger('propuesta_id')->nullable();
            $table->unsignedInteger('relator_id')->nullable();
            $table->unsignedInteger('notebook_id')->nullable();
            $table->unsignedInteger('proyector_id')->nullable();

            $table->unsignedInteger('diseno_tecnico_id')->nullable();
            $table->unsignedInteger('check_coordinacion_id')->nullable();
            $table->unsignedInteger('check_material_participante_id')->nullable();
            $table->unsignedInteger('check_material_relator_id')->nullable();
            $table->unsignedInteger('check_sence_id')->nullable();
            $table->unsignedInteger('check_cierre_id')->nullable();
            $table->unsignedInteger('check_outdoor_id')->nullable();
            $table->unsignedInteger('check_audio_iluminacion_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('servicios', function($table){
            $table->foreign('curso_id')->references('id')->on('cursos');
        });

        Schema::table('servicios', function($table){
            $table->foreign('ciudad_id')->references('id')->on('ciudads');
        });

        Schema::table('servicios', function($table){
            $table->foreign('propuesta_id')->references('id')->on('propuestas');
        });

        Schema::table('servicios', function($table){
            $table->foreign('relator_id')->references('id')->on('relators');
        });

        Schema::table('servicios', function($table){
            $table->foreign('notebook_id')->references('id')->on('notebooks');
        });

        Schema::table('servicios', function($table){
            $table->foreign('proyector_id')->references('id')->on('proyectors');
        });

        //checklist
        Schema::table('servicios', function($table){
            $table->foreign('diseno_tecnico_id')->references('id')->on('diseno_tecnicos');
        });

        Schema::table('servicios', function($table){
            $table->foreign('check_coordinacion_id')->references('id')->on('check_coordinacions');
        });

        Schema::table('servicios', function($table){
            $table->foreign('check_material_participante_id')->references('id')->on('check_material_participantes');
        });

        Schema::table('servicios', function($table){
            $table->foreign('check_material_relator_id')->references('id')->on('check_material_relators');
        });

        Schema::table('servicios', function($table){
            $table->foreign('check_sence_id')->references('id')->on('check_sences');
        });

        Schema::table('servicios', function($table){
            $table->foreign('check_cierre_id')->references('id')->on('check_cierres');
        });

        Schema::table('servicios', function($table){
            $table->foreign('check_outdoor_id')->references('id')->on('check_outdoors');
        });

        Schema::table('servicios', function($table){
            $table->foreign('check_audio_iluminacion_id')->references('id')->on('check_audio_iluminacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
