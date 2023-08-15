<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_checklists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->unique();
            $table->string('file_name');
            $table->string('hash_file_name');
            $table->unsignedInteger('servicio_id');
            $table->unsignedInteger('tipo_documento_checklist_id');
            $table->timestamps();
        });

        Schema::table('documento_checklists', function ($table) {
            $table->foreign('servicio_id')->references('id')->on('servicios');
        });

        Schema::table('documento_checklists', function ( $table) {
            $table->foreign('tipo_documento_checklist_id')->references('id')->on('tipo_documento_checklists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_checklists');
    }
}
