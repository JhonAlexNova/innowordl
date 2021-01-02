<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableAsignacionSeguimientoController extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('asignacion_seguimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_broker');
            $table->date('hora',11);
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
        Schema::dropIfExists('asignacion_seguimiento');
    }
}
