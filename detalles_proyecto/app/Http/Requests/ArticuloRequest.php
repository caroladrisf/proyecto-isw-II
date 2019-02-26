<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descripcion'   => 'required',
            'cantidad'      => 'required|integer|min:1',
            'precio_compra' => 'required|numeric',
            'precio_venta'  => 'required|numeric|gte:precio_compra'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'descripcion.required' => 'Escriba una descripción',
            'cantidad.required'  => 'Escriba una cantidad',
            'cantidad.integer'  => 'La cantidad debe ser un número entero',
            'cantidad.min'  => 'La cantidad debe ser mínimo 1',
            'precio_compra.required'  => 'Escriba el precio de compra',
            'precio_compra.numeric'  => 'El precio de compra debe ser un número',
            'precio_venta.required'  => 'Escriba el precio de venta',
            'precio_venta.numeric'  => 'El precio de venta debe ser un número',
            'precio_venta.gte'  => 'El precio de venta debe ser mayor o igual al precio de compra',
        ];
    }
}
