<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasCredito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventas_credito', function (Blueprint $table) {
            $table->increments('id');
            $table->foreing('id_cliente')->references('id')->on('cliente');
            $table->double('saldo');
            $table->date('fecha_compra')->default(now());
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
        Schema::table('ventas_credito', function (Blueprint $table) {
            //
        });
    }
}
