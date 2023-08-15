<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckCierresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_cierres', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('diplomas_aplica')->nullable();
            $table->boolean('diplomas_listo')->nullable();
            $table->boolean('nota_listo')->nullable();
            $table->boolean('orden_compra_listo')->nullable();
            $table->boolean('certificado_sence_aplica')->nullable();
            $table->boolean('certificado_sence_listo')->nullable();
            $table->boolean('libro_asistencia_listo')->nullable();
            $table->boolean('resultado_encuestas_ads_listo')->nullable();

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
        Schema::dropIfExists('check_cierres');
    }
}
