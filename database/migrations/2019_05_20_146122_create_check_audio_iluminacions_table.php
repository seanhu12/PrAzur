<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckAudioIluminacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_audio_iluminacions', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('parlantes_aplica')->nullable();
            $table->boolean('parlantes_listo')->nullable();
            $table->boolean('parlantes_recepcion')->nullable();
            $table->boolean('atril_aplica')->nullable();
            $table->boolean('atril_listo')->nullable();
            $table->boolean('atril_recepcion')->nullable();
            $table->boolean('alargador_aplica')->nullable();
            $table->boolean('alargador_listo')->nullable();
            $table->boolean('alargador_recepcion')->nullable();
            $table->boolean('foco_aplica')->nullable();
            $table->boolean('foco_listo')->nullable();
            $table->boolean('foco_recepcion')->nullable();
            $table->boolean('microfono_cintillo_aplica')->nullable();
            $table->boolean('microfono_cintillo_listo')->nullable();
            $table->boolean('microfono_cintillo_recepcion')->nullable();
            $table->boolean('microfono_inalambrico_aplica')->nullable();
            $table->boolean('microfono_inalambrico_listo')->nullable();
            $table->boolean('microfono_inalambrico_recepcion')->nullable();
            $table->text('otros')->nullable();
            /*$table->boolean('proyector_aplica')->nullable();
            $table->boolean('proyector_listo')->nullable();
            $table->boolean('proyector_recepcion')->nullable();*/

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
        Schema::dropIfExists('check_audio_iluminacions');
    }
}
