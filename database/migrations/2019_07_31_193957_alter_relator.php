<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRelator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relators', function (Blueprint $table) {
            $table->string('mail')->nullable()->change();
            $table->string('celular')->nullable()->change();
            $table->date('vigencia_sence')->nullable()->change();
            $table->unsignedInteger('ciudad_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('relators', function (Blueprint $table) {
            //
        });
    }
}
