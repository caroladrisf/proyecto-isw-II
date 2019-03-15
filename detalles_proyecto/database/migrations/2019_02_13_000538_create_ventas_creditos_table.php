<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_creditos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->integer('articulo_id');
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->integer('credito_id');
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
        Schema::dropIfExists('ventas_creditos');
    }
}
