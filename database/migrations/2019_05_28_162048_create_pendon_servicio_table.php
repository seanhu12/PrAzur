<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendonServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendon_servicio', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('pendon_id')->nullable();
            $table->unsignedInteger('servicio_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pendon_servicio', function($table){
            $table->foreign('pendon_id')->references('id')->on('pendons');
        });

        Schema::table('pendon_servicio', function($table){
            $table->foreign('servicio_id')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendon_servicio');
    }
}
