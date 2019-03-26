<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbonosCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonos_creditos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('abono');
            $table->integer('credito_id');
            $table->dateTime('fecha')->default(now());
            $table->foreign('credito_id')->references('id')->on('creditos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonos_creditos');
    }
}
