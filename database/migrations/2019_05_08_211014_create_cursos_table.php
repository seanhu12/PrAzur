<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_venta');
            $table->string('codigo');
            $table->unsignedInteger('anio_creacion');
            //$table->unsignedInteger('cant_horas');
            //$table->unsignedInteger('cant_horas_practicas');
            //$table->unsignedInteger('cant_horas_teoricas');
            //$table->unsignedInteger('cant_participantes');
            $table->unsignedDecimal('cant_horas',3,1)->nullable();
            $table->unsignedDecimal('cant_horas_practicas',3,1)->nullable();
            $table->unsignedDecimal('cant_horas_teoricas',3,1)->nullable();
            $table->unsignedInteger('cant_participantes')->nullable();
            $table->text('descripcion');
            $table->string('file_name_programa');
            $table->string('hash_file_name_programa');
            $table->unsignedInteger('tematica_id');

            $table->string('nombre_sence')->unique()->nullable();
            $table->unsignedInteger('codigo_sence')->unique()->nullable();
            $table->date('vigencia')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('cursos', function($table){
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
        Schema::dropIfExists('cursos');
    }
}
