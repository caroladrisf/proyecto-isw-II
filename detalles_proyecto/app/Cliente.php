<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula',
        'nombre',
        'correo',
        'telefono'
    ];

    /**
     * Obtener los créditos asociados al cliente
     */
    public function creditos()
    {
        return $this->hasMany('App\Credito');
    }
}
