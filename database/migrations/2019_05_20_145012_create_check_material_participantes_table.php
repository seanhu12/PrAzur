<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckMaterialParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_material_participantes', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('gafete_aplica')->nullable();
            $table->boolean('gafete_listo')->nullable();
            $table->boolean('bitacora_aplica')->nullable();
            $table->boolean('bitacora_listo')->nullable();
            $table->boolean('carpeta_ads_aplica')->nullable();
            $table->boolean('carpeta_ads_listo')->nullable();
            $table->boolean('lapices_aplica')->nullable();
            $table->boolean('lapices_listo')->nullable();
            $table->boolean('velobind_aplica')->nullable();
            $table->boolean('velobind_listo')->nullable();

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
        Schema::dropIfExists('check_material_participantes');
    }
}
