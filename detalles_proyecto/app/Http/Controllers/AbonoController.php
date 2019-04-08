<?php

namespace App\Http\Controllers;

use App\AbonoApartado;
use App\AbonoCredito;
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
            if (count($clientes) > 0) {
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
        $abonos = AbonoApartado::where('apartado_id', '=', $apartado->id)->get();
        return view('abonos.apartado', compact('cliente', 'apartado', 'abonos'));
    }

    public function abonarCredito(Cliente $cliente, Credito $credito)
    {
        $abonos = AbonoCredito::where('credito_id', '=', $credito->id)->get();
        return view('abonos.credito', compact('cliente', 'credito', 'abonos'));
    }

    public function guardarAbonoCredito(Request $request, Cliente $cliente, Credito $credito)
    {
        if (! $request->input('abono')) {
            return back()->with('abono_error', 'Escriba el monto que va a abonar.');
        }
        if ($request->input('abono') > $credito->saldo) {
            return back()->with('abono_error', 'La cantidad a abonar debe ser menor o igual al saldo.');
        }
        $abono = new AbonoCredito();
        $abono->abono = $request->input('abono');
        $abono->credito_id = $credito->id;
        $abono->fecha = now();
        $abono->save();
        $credito->saldo -= $request->input('abono');
        $credito->save();
        return redirect("/abonos/clientes/$cliente->id/creditos/$credito->id")->with('abono_msg', "Se abonó ₡$abono->abono al crédito.");
    }

    public function guardarAbonoApartado(Request $request, Cliente $cliente, Apartado $apartado)
    {
        if (! $request->input('abono')) {
            return back()->with('abono_error', 'Escriba el monto que va a abonar.');
        }
        if ($request->input('abono') > $apartado->saldo) {
            return back()->with('abono_error', 'El monto a abonar debe ser menor o igual al saldo.');
        }
        $abono = new AbonoApartado();
        $abono->abono = $request->input('abono');
        $abono->apartado_id = $apartado->id;
        $abono->fecha = now();
        $abono->save();
        $apartado->saldo -= $request->input('abono');
        $apartado->save();
        return redirect("/abonos/clientes/$cliente->id/apartados/$apartado->id")->with('abono_msg', "Se abonó ₡$abono->abono al apartado.");
    }
}
