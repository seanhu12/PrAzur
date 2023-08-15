<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckOutdoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_outdoors', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('venda_aplica')->nullable();
            $table->boolean('venda_listo')->nullable();
            $table->boolean('venda_recepcion')->nullable();
            $table->boolean('pvc_aplica')->nullable();
            $table->boolean('pvc_listo')->nullable();
            $table->boolean('pvc_recepcion')->nullable();
            $table->boolean('pelota_aplica')->nullable();
            $table->boolean('pelota_listo')->nullable();
            $table->boolean('pelota_recepcion')->nullable();
            $table->boolean('plumones_aplica')->nullable();
            $table->boolean('plumones_listo')->nullable();
            $table->boolean('plumones_recepcion')->nullable();
            $table->boolean('papel_craf_aplica')->nullable();
            $table->boolean('papel_craf_listo')->nullable();
            $table->boolean('papel_craf_recepcion')->nullable();
            $table->boolean('pechera_aplica')->nullable();
            $table->boolean('pechera_listo')->nullable();
            $table->boolean('pechera_recepcion')->nullable();
            $table->boolean('masquin_listo')->nullable();
            $table->boolean('masquin_aplica')->nullable();
            $table->boolean('masquin_recepcion')->nullable();
            $table->boolean('bolsa_basura_aplica')->nullable();
            $table->boolean('bolsa_basura_listo')->nullable();
            $table->boolean('bolsa_basura_recepcion')->nullable();
            $table->boolean('cono_aplica')->nullable();
            $table->boolean('cono_listo')->nullable();
            $table->boolean('cono_recepcion')->nullable();
            $table->boolean('plato_aplica')->nullable();
            $table->boolean('plato_listo')->nullable();
            $table->boolean('plato_recepcion')->nullable();
            $table->boolean('aro_madera_aplica')->nullable();
            $table->boolean('aro_madera_listo')->nullable();
            $table->boolean('aro_madera_recepcion')->nullable();
            $table->boolean('tijera_aplica')->nullable();
            $table->boolean('tijera_listo')->nullable();
            $table->boolean('tijera_recepcion')->nullable();
            $table->boolean('esqui_aplica')->nullable();
            $table->boolean('esqui_listo')->nullable();
            $table->boolean('esqui_recepcion')->nullable();
            $table->text('otros')->nullable();

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
        Schema::dropIfExists('check_outdoors');
    }
}
