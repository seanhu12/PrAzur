<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendonTematicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendon_tematica', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pendon_id');
            $table->unsignedInteger('tematica_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pendon_tematica', function ($table) {
            $table->foreign('pendon_id')->references('id')->on('pendons');
        });

        Schema::table('pendon_tematica', function ($table) {
            $table->foreign('tematica_id')->references('id')->on('tematicas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendon_tematica');
    }
}
