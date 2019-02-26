<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'tipo_contacto',
        'nombre',
        'apellido',
        'correo',
        'direccion',
        'id_telefono'
    ];
}