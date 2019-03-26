<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbonosApartadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonos_apartados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('abono');
            $table->integer('apartado_id');
            $table->dateTime('fecha')->default(now());
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
        Schema::table('abonos_apartados', function (Blueprint $table) {
            Schema::dropIfExists('abonos_apartados');
        });
    }
}
