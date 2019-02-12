<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente');
            $table->double('saldo');
            $table->date('fecha')->default(now());
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
        Schema::table('apartados', function (Blueprint $table) {
            //
        });
    }
}
