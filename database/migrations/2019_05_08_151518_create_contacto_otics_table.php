<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactoOticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_otics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('rut')->nullable();
            $table->string('mail');
            $table->string('telefono_fijo')->nullable();
            $table->string('celular')->nullable();
            $table->string('direccion');
            $table->string('area');
            $table->unsignedInteger('otic_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('contacto_otics', function($table){
            $table->foreign('otic_id')->references('id')->on('otics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacto_otics');
    }
}
