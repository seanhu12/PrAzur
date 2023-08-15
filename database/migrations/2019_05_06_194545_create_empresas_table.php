<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('razon_social')->nullable();
            $table->string('rut')->unique();
            $table->string('telefono_fijo')->nullable();
            $table->string('celular')->nullable();
            $table->string('mail')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedInteger('ciudad_id')->nullable();
            $table->unsignedInteger('holding_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('empresas', function($table){
            $table->foreign('ciudad_id')->references('id')->on('ciudads');
        });

        Schema::table('empresas', function($table){
            $table->foreign('holding_id')->references('id')->on('empresas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
