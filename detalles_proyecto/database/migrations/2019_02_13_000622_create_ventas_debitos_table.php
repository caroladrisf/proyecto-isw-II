<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasDebitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_debitos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta_id');
            $table->integer('debito_id');
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->foreign('debito_id')->references('id')->on('debitos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_debitos');
    }
}
