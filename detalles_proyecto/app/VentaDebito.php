<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaDebito extends Model
{
    protected $table = 'ventas_debitos';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cantidad',
        'articulo_id',
        'debito_id',
    ];
}
