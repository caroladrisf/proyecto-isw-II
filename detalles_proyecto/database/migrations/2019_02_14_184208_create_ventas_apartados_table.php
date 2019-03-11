<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasApartadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_apartados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta_id');
            $table->integer('apartado_id');
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->foreign('apartado_id')->references('id')->on('apartados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_apartados');
    }
}
