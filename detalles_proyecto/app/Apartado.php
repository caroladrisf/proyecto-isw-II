<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartado extends Model
{
    protected $table = 'apartados';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'monto_total',
        'saldo',
        'fecha'
    ];

    /**
     * Obtener el cliente al que pertenece el apartado.
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
