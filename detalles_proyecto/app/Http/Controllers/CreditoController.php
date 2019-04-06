<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Cliente;
use App\Credito;
use App\VentaCredito;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function create(Request $request)
    {
        $cliente = $this->cliente($request->session()->get('cliente_id'));
        $articulos = $this->articulos($request->session()->get('articulos'));
        return view('creditos.index', compact('cliente', 'articulos'));
    }

    public function store(Request $request)
    {
        $errores = [];
        if (empty($request->session()->get('cliente_id'))) {
            $errores[] = 'No se ha seleccionado el cliente';
        }
        if (empty($request->session()->get('articulos'))) {
            $errores[] = 'No se ha seleccionado ningún articulo';
        }
        if (count($errores) > 0) {
            return back()->withErrors($errores);
        }
        $articulos = $this->articulos($request->session()->get('articulos'));
        $credito = new Credito();
        $credito->fecha = now();
        $credito->cliente_id = $request->session()->get('cliente_id');
        $credito->monto_total = 0;
        foreach ($articulos as $articulo) {
            $credito->monto_total += $articulo->cantidad * $articulo->precio_venta;
        }
        $credito->saldo = $credito->monto_total;
        $credito->save();
        if ($credito->id) {
            foreach ($articulos as $venta) {
                VentaCredito::create([
                    'cantidad' => $venta->cantidad,
                    'articulo_id' => $venta->id,
                    'credito_id' => $credito->id
                ]);
                $articulo = Articulo::find($venta->id);
                $articulo->fill(['cantidad' => ($articulo->cantidad - $venta->cantidad)]);
                $articulo->update();
            }
            $request->session()->forget(['cliente_id', 'articulos']);
            return redirect('creditos');
        }
    }

    public function cancelar(Request $request)
    {
        $request->session()->forget(['cliente_id', 'articulos']);
        return redirect('creditos');   
    }

    public function cliente($id)
    {
        $cliente = Cliente::find($id);
        return $cliente;
    }

    public function articulos($session)
    {
        $articulos = [];
        if ($session) {
            foreach ($session as $data) {
                $articulo = Articulo::find($data['id']);
                $articulo->fill(['cantidad' => $data['cantidad']]);
                $articulos[] = $articulo;
            }
        }
        return $articulos;
    }

    public function buscarClientes(Request $request)
    {
        if ($request->query('cliente')){
            $query = '%' . $request->query('cliente') . '%';
            $clientes = Cliente::where('cedula', 'ilike', $query)
            ->orWhere('nombre', 'ilike', $query)
            ->orderBy('id', 'asc')->get();
            if (count($clientes) > 1) {
                $articulos = $this->articulos($request->session()->get('articulos'));
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
        $request->session()->put('cliente_id', $id);
        return redirect('creditos');
    }

    public function quitarCliente(Request $request)
    {
        $request->session()->forget('cliente_id');
        return redirect('creditos');
    }

    public function buscarArticulos(Request $request)
    {
        if ($request->query('art')){
            $query = '%' . $request->query('art') . '%';
            $result = Articulo::where('descripcion', 'ilike', $query)
            ->orderBy('id', 'asc')->get();
            if (count($result) > 1) {
                $cliente = $this->cliente($request->session()->get('cliente_id'));
                $articulos = $this->articulos($request->session()->get('articulos'));
                return view('creditos.index', compact('cliente', 'articulos', 'result'));
            } else if (count($result) == 1) {
                return redirect("/creditos/articulos/{$result[0]->id}");
            } else {
                return redirect('creditos')->with('articulos_error', 'Ningún artículo registrado coincide con la busqueda');
            }
        } else {
            return redirect('creditos');
        }
    }

    public function seleccionarArticulo(Request $request, $id)
    {
        $articulo = Articulo::find($id);
        $cliente = $this->cliente($request->session()->get('cliente_id'));
        $articulos = $this->articulos($request->session()->get('articulos'));
        return view('creditos.index', compact('cliente', 'articulos', 'articulo'));
    }

    public function asignarArticulo(Request $request, $id)
    {
        $cantidad = $request->get('cantidad');
        $request->session()->push('articulos', [ 'id' => $id, 'cantidad' => $cantidad ]);
        return redirect('creditos');
    }

    public function quitarArticulo(Request $request, $id)
    {
        $data = $request->session()->get('articulos');
        $keys = array_keys($data);
        for ($i=0; $i < count($data); $i++) {
            if ($data[$keys[$i]]['id'] === $id) {
                $item = $request->session()->pull("articulos.$keys[$i]");
            }
        }
        return redirect('creditos');
    }
}
