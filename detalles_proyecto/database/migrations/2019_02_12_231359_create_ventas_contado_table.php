<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasContadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventas_contado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente');
            $table->double('total_compra');
            $table->date('fecha_compra')->default(now());
            $table->foreign('id_cliente')->references('id')->on('cliente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventas_contado', function (Blueprint $table) {
            //
        });
    }
}
