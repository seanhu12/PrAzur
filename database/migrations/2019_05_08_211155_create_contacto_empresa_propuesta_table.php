<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactoEmpresaPropuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_empresa_propuesta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contacto_empresa_id');
            $table->unsignedInteger('propuesta_id');
            $table->unsignedInteger('tipo_contacto_id');

            $table->timestamps();
        });

        Schema::table('contacto_empresa_propuesta', function($table){
            $table->foreign('contacto_empresa_id')->references('id')->on('contacto_empresas');
        });

        Schema::table('contacto_empresa_propuesta', function($table){
            $table->foreign('propuesta_id')->references('id')->on('propuestas');
        });

        Schema::table('contacto_empresa_propuesta', function($table){
            $table->foreign('tipo_contacto_id')->references('id')->on('tipo_contactos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacto_empresa_propuesta');
    }
}
