<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbonoApartado extends Model
{
    protected $table = 'abonos_apartados';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'abono',
        'apartado_id',
        'fecha'
    ];
}
