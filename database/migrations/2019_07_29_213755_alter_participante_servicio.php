<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterParticipanteServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participante_servicio', function (Blueprint $table) {
            $table->dropForeign('participante_servicio_encuesta_ads_id_foreign');
            $table->dropColumn('encuesta_ads_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participante_servicio', function (Blueprint $table) {
            //
        });
    }
}
