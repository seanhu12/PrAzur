<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_compras', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('numero');
            $table->unsignedInteger('empresa_id');
            $table->unsignedInteger('servicio_id');

            $table->unique(['numero','servicio_id']);

            $table->timestamps();
            //$table->softDeletes();
        });

        Schema::table('orden_compras', function($table){
            $table->foreign('servicio_id')->references('id')->on('servicios');
        });

        Schema::table('orden_compras', function($table){
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
        Schema::dropIfExists('orden_compras');
    }
}
