<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableEstadosModulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('estados_modulos',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_modulo')->unsigned();
            $table->integer('id_estado')->unsigned();

            $table->date('created_at',10)->nullable();
            $table->date('updated_at',10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados_modulos');
    }
}
