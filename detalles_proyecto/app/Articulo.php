<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'descripcion',
        'cantidad',
        'precio_compra',
        'precio_venta'
    ];
}
