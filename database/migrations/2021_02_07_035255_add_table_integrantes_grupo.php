<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableIntegrantesGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes_grupos',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('id_broker')->unsigned();
            $table->integer('id_nivel')->unsigned();
            $table->integer('id_grupo')->unsigned();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->enum('estado',['aprobado','reprobado']);

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
        Schema::dropIfExists('integrantes_grupos');
    }
}
