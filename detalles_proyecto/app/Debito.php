<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debito extends Model
{
    protected $table = 'debitos';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'nombre',
        'monto_total',
        'fecha'
    ];
}
