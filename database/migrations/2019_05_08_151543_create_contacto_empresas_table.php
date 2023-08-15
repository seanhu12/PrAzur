<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactoEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('rut')->nullable();
            $table->string('mail');
            $table->string('telefono_fijo')->nullable();
            $table->string('celular')->nullable();
            $table->string('direccion');
            $table->string('area');
            $table->string('cargo');
            $table->unsignedInteger('empresa_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('contacto_empresas', function($table){
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacto_empresas');
    }
}
