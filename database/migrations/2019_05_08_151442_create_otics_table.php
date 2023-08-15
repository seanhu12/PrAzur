<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('rut')->unique();
            $table->string('telefono_fijo')->nullable();
            $table->string('celular')->nullable();
            $table->string('mail');
            $table->string('direccion');

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
        Schema::dropIfExists('otics');
    }
}
