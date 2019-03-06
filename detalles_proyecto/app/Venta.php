<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_articulo',
        'cantidad',
        'id_tipo'
    ];
}
