<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debitos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->nullable();
            $table->text('nombre')->nullable();
            $table->double('monto_total');
            $table->date('fecha')->default(now());
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debitos');
    }
}
