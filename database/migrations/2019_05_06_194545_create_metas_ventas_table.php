<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetasVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('anio')->nullable();
            $table->unsignedInteger('mes')->nullable();
            $table->date('fecha_reporte')->nullable();
            $table->unsignedInteger('monto_meta')->nullable();
            $table->unsignedInteger('monto_vendido')->nullable();
            $table->unsignedInteger('empresa_id');
            $table->unique(['anio', 'mes','empresa_id']);
            $table->timestamps();
        });

        Schema::table('metas_ventas', function($table){
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
        Schema::dropIfExists('metas_ventas');
    }
}
