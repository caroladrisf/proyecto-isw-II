<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $table = 'creditos';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'monto_total',
        'fecha'
    ];
}
