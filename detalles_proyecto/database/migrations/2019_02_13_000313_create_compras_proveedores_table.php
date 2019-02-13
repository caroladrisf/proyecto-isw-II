<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_proveedor');
            $table->integer('id_articulo');
            $table->integer('cantidad');
            $table->date('fecha')->default(now());
            $table->text('codigo_factura')->nullable();
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
            $table->foreign('id_articulo')->references('id')->on('articulos');
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
        Schema::dropIfExists('compras_proveedores');
    }
}
