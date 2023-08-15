<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckCoordinacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_coordinacions', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('coordinar_sala_listo')->nullable();
            $table->boolean('coffee_aplica')->nullable();
            $table->boolean('coffee_listo')->nullable();
            $table->boolean('almuerzo_aplica')->nullable();
            $table->boolean('almuerzo_listo')->nullable();
            $table->boolean('nomina_participantes_listo')->nullable();

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
        Schema::dropIfExists('check_coordinacions');
    }
}
