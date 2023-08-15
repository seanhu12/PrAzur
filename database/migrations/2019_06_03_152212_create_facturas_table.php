<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('numero');
            $table->unsignedInteger('monto');
            $table->date('fecha_emision');
            $table->date('fecha_pago');
            $table->unsignedInteger('orden_compra_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('facturas', function($table){
            $table->foreign('orden_compra_id')->references('id')->on('orden_compras');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
