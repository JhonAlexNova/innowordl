<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableDepartamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->date('created_at',10)->nullable();
            $table->date('updated_at',10)->nullable();
        });

        //Schema::dropIfExists('users');
    }


    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}
