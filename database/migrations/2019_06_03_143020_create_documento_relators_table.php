<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoRelatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_relators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name');
            $table->string('hash_file_name');
            $table->unsignedInteger('relator_id');

            $table->timestamps();
        });


        Schema::table('documento_relators', function($table){
            $table->foreign('relator_id')->references('id')->on('relators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_relators');
    }
}
