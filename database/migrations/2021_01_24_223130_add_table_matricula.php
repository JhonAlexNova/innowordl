<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableMatricula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_broker');
            $table->string('estado');
            $table->string('hora_registro',15);
            $table->date('created_at',10)->nullable();
            $table->date('updated_at',10)->nullable();
            //
            $table->foreign('id_user')->on('users')->references('id')->delete('cascade');
            $table->foreign('id_broker')->on('users')->references('id')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
}
