<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('factura', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_broker');
            $table->string('numero_factura');
            $table->string('estado');
            $table->string('fecha_acuerdo',10);
            $table->string('hora',15);
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
        Schema::dropIfExists('factura');
    }
}
