<?php

namespace App\Http\Controllers;

use App\AbonoCredito;
use App\Http\Requests\AbonoRequest;
use App\Apartado;
use App\Cliente;
use App\Credito;
use Illuminate\Http\Request;

class AbonoController extends Controller
{
    public function index()
    {
        return view('abonos.cliente');
    }

    public function buscarClientes(Request $request)
    {
        if ($request->query('cliente')){
            $query = '%' . $request->query('cliente') . '%';
            $clientes = Cliente::where('cedula', 'ilike', $query)
            ->orWhere('nombre', 'ilike', $query)
            ->orderBy('id', 'asc')->get();
            if ($clientes) {
                return view('abonos.cliente', compact('clientes'));
            } else {
                return redirect('abonos')->with('cliente_error', 'Ningún cliente registrado coincide con la busqueda');
            }
        } else {
            return redirect('abonos');
        }
    }

    public function buscarCuentas(Cliente $cliente)
    {
        $creditos = Credito::where('cliente_id', '=', $cliente->id)->get();
        $apartados = Apartado::where('cliente_id', '=', $cliente->id)->get();
        return view('abonos.cuentas', compact('cliente', 'creditos', 'apartados'));
    }

    public function abonarApartado(Cliente $cliente, Apartado $apartado)
    {
        var_dump($cliente, $apartado);
    }

    public function abonarCredito(Cliente $cliente, Credito $credito)
    {
        return view('abonos.credito', compact('cliente', 'credito'));
    }

    public function guardarAbonoCredito(AbonoRequest $request, Cliente $cliente, Credito $credito)
    {
        $abono = new AbonoCredito();
        $abono->abono = $request->input('abono');
        $abono->credito_id = $credito->id;
        $abono->fecha = now();
        $abono->save();
        $credito->saldo -= $request->input('abono');
        $credito->save();
    }
}
