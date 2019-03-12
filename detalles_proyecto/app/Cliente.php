<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contacto_id'
    ];

    /**
     * Obtener los créditos asociados al cliente
     */
    public function creditos()
    {
        return $this->hasMany('App\Credito');
    }

    /**
     * Obtener la información de contacto del cliente
     */
    public function contacto()
    {
        return $this->belongsTo('App\Contacto');
    }
}
