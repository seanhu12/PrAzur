<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckSencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_sences', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('sence_id_cargado_aplica')->nullable();
            $table->boolean('sence_id_cargado_listo')->nullable();
            $table->boolean('verificar_lector_bio_aplica')->nullable();
            $table->boolean('verificar_lector_bio_listo')->nullable();
            $table->boolean('verificar_lector_bio_recepcion')->nullable();
            $table->boolean('reglamento_sence_aplica')->nullable();
            $table->boolean('reglamento_sence_listo')->nullable();

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
        Schema::dropIfExists('check_sences');
    }
}
