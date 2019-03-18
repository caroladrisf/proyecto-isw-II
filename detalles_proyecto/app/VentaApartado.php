<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaApartado extends Model
{
    protected $table = 'ventas_apartados';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cantidad',
        'articulo_id',
        'apartado_id',
    ];
}
