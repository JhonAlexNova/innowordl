<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableRh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->date('created_at',10)->nullable();
            $table->date('updated_at',10)->nullable();
        });

        //Schema::dropIfExists('users');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rh');
    }
}
