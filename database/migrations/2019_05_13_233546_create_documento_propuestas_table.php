<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoPropuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_propuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name');
            $table->string('hash_file_name');
            $table->unsignedInteger('propuesta_id');

            $table->timestamps();
        });


        Schema::table('documento_propuestas', function($table){
            $table->foreign('propuesta_id')->references('id')->on('propuestas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_propuestas');
    }
}
