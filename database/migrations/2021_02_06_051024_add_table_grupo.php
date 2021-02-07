<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_nivel')->unsigned();
            $table->string('nombre');
            $table->string('fecha_inicio')->nullable();
            $table->string('fecha_fin')->nullable();

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
        Schema::dropIfExists('grupos');
    }
}
