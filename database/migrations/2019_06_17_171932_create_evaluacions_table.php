<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedDecimal('nota',2,1);
            $table->unsignedInteger('participante_servicio_id');
            $table->string('tipo');
            $table->timestamps();
        });

        Schema::table('evaluacions', function ($table) {
            $table->foreign('participante_servicio_id')->references('id')->on('participante_servicio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluacions');
    }
}
