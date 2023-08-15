<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisenoTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseno_tecnicos', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('diseno_tecnico_listo')->nullable();
            $table->boolean('manual_aplica')->nullable();
            $table->boolean('prueba_aplica')->nullable();
            $table->boolean('guia_aplica')->nullable();
            $table->boolean('encuesta_empresa_aplica')->nullable();
            $table->boolean('encuesta_adicionales_aplica')->nullable();
            $table->text('detalle')->nullable();
            $table->unsignedInteger('estructura_id')->nullable();

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
        Schema::dropIfExists('diseno_tecnicos');

    }
}
