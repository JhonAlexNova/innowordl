<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableDetallesAsignacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('detalles_asignacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_broker');
            $table->integer('id_estado');
            $table->string('fecha',10);
            $table->string('hora',15);
            $table->string('hora_registro',15);
            $table->text('observacion');
            $table->date('created_at',10)->nullable();
            $table->date('updated_at',10)->nullable();
        });
        //Schema::dropIfExists('documentos');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_asignacion');
    }
}
