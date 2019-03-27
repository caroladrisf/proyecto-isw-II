<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbonoCredito extends Model
{
    protected $table = 'abonos_creditos';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'abono',
        'credito_id',
        'fecha'
    ];
}
