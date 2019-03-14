<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function create(Request $request)
    {
        $request->session()->forget('cliente_id');
        return view('creditos.index');
    }

    public function buscarClientes(Request $request)
    {
        $request->session()->forget('cliente_id');
        $query = '%' . $request->query('cedula') . '%';
        $contactos = \App\Contacto::where('cedula', 'like', $query)->get();
        if ($contactos) {
            foreach ($contactos as $contacto) {
                $contacto->cliente = \App\Contacto::find($contacto->id)->cliente;
            }
            return view('creditos.index', compact('contactos'));
        } else {
            return back()->withErrors('No se encontró el cliente');
        }
    }

    public function asignarCliente(Request $request, $id)
    {
        $cliente = \App\Cliente::find($id)->first();
        $cliente->contacto = \App\Cliente::find($cliente->id)->contacto;
        $request->session()->put('cliente_id', $cliente->id);
        return view('creditos.index', compact('cliente'));
    }
}
