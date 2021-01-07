<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableDetallesFactura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('detalles_factura', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_factura');
            $table->string('cantidad');
            $table->text('descripcion');
            $table->string('precio');
            $table->string('descuento',10);
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
        Schema::dropIfExists('detalles_factura');
    }
}
