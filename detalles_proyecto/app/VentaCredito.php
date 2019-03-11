<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaCredito extends Model
{
    protected $table = 'ventas_creditos';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'venta_id',
        'credito_id',
    ];

    public function articulo()
    {
        return $this->hasMany(
            'App\Venta'
        );
    }
}
