<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoProgramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_programa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('programa_id');
            $table->unsignedInteger('curso_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('curso_programa', function($table){
            $table->foreign('programa_id')->references('id')->on('programas');
        });

        Schema::table('curso_programa', function($table){
            $table->foreign('curso_id')->references('id')->on('cursos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_programa');
    }
}
