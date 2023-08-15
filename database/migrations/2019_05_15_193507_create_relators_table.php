<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('rut')->unique();
            $table->string('mail')->unique();
            $table->string('celular');
            $table->date('vigencia_sence');
            $table->unsignedInteger('ciudad_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('relators', function($table){
            $table->foreign('ciudad_id')->references('id')->on('ciudads');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relators');

    }
}
