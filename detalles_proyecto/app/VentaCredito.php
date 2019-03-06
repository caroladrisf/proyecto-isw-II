<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaCredito extends Model
{
    protected $fillable = ['id_cliente', 'saldo'];

    public function articulo()
    {
        return $this->hasMany(
            'App\Venta'
        );
    }
}
