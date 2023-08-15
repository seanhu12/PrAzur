<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_user', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('rol_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();

            $table->timestamps();
        });

        Schema::table('rol_user', function($table){
            $table->foreign('rol_id')->references('id')->on('rols');
        });

        Schema::table('rol_user', function($table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_user');
    }
}
