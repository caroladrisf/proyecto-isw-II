<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function create(Request $request)
    {
        $cliente = $this->cliente($request->session()->get('cliente_id'));
        $articulos = $this->articulos($request->session()->get('articulos_id'));
        return view('creditos.index', compact('cliente', 'articulos'));
    }

    public function cliente($id)
    {
        $cliente = \App\Cliente::find($id);
        return $cliente;
    }

    public function articulos($id)
    {
        $articulos = \App\Articulo::find($id);
        return $articulos;
    }

    public function buscarClientes(Request $request)
    {
        if ($request->query('cliente')){
            $query = '%' . $request->query('cliente') . '%';
            $clientes = \App\Cliente::where('cedula', 'like', $query)
            ->orWhere('nombre', 'like', $query)
            ->orWhere('apellido', 'like', $query)
            ->orderBy('id', 'asc')->get();
            if (count($clientes) > 1) {
                $articulos = $this->articulos($request->session()->get('articulos_id'));
                return view('creditos.index', compact('clientes', 'articulos'));
            } else if (count($clientes) == 1) {
                return redirect("/creditos/clientes/{$clientes[0]->id}");
            } else {
                return redirect('creditos')->with('cliente_error', 'Ningún cliente registrado coincide con la busqueda');
            }
        } else {
            return redirect('creditos');
        }
    }

    public function asignarCliente(Request $request, $id)
    {
        $cliente = \App\Cliente::find($id);
        $request->session()->put('cliente_id', $cliente->id);
        return redirect('creditos');
    }

    public function quitarCliente(Request $request)
    {
        $request->session()->forget('cliente_id');
        return redirect('creditos');
    }
}
