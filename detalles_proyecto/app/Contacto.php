<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contactos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula',
        'nombre',
        'apellido',
        'correo',
        'telefono'
    ];

    /**
     * Obtener la información de contacto del cliente
     */
    public function cliente()
    {
        return $this->hasOne('App\Cliente');
    }
}
