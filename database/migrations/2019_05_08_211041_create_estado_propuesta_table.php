<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoPropuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_propuesta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('propuesta_id');
            $table->unsignedInteger('estado_id');
            $table->unsignedInteger('motivo_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('estado_propuesta', function ($table) {
            $table->foreign('propuesta_id')->references('id')->on('propuestas');
        });

        Schema::table('estado_propuesta', function ($table) {
            $table->foreign('estado_id')->references('id')->on('estados');
        });

        Schema::table('estado_propuesta', function ($table) {
            $table->foreign('motivo_id')->references('id')->on('motivos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_propuesta');
    }
}
