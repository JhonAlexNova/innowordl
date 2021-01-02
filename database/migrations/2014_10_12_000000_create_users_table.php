<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_tipo_documento');
            $table->integer('id_rol');
            $table->integer('id_rh');
            $table->integer('id_ciudad')->nullable();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('documento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->date('created_at',10)->nullable();
            $table->date('updated_at',10)->nullable();

            //foregin
            $table->foreign('id_tipo_documento')->on('tipo_documento')->references('id')->ondelete('cascade');
            $table->foreign('id_rol')->on('tipo_documento')->references('id')->ondelete('cascade');
            $table->foreign('id_rh')->on('rh')->references('id')->ondelete('cascade');
            $table->foreign('id_ciudad')->on('ciudades')->references('id')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
