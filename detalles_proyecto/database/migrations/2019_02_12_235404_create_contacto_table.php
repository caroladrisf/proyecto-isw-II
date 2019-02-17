<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_contacto');
            $table->text('nombre');
            $table->text('apellido')->nullable();
            $table->text('correo')->nullable();
            $table->text('direccion');
            $table->integer('id_telefono')->nullable();
            $table->foreign('id_telefono')->references('id')->on('telefonos');
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
        Schema::dropIfExists('contacto');
    }
}
