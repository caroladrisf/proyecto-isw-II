<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Apartado;
use App\Cliente;
use App\VentaApartado;
use Illuminate\Http\Request;

class ApartadoController extends Controller
{
    public function create(Request $request)
    {
        $cliente = $this->cliente($request->session()->get('cliente_id'));
        $articulos = $this->articulos($request->session()->get('articulos'));
        return view('apartados.index', compact('cliente', 'articulos'));
    }

    public function store(Request $request)
    {
        $articulos = $this->articulos($request->session()->get('articulos'));
        $apartado = new Apartado();
        $apartado->fecha = now();
        $apartado->cliente_id = $request->session()->get('cliente_id');
        $apartado->monto_total = 0;
        foreach ($articulos as $articulo) {
            $apartado->monto_total += $articulo->cantidad * $articulo->precio_venta;
        }
        $apartado->saldo = $apartado->monto_total;
        $apartado->save();
        if ($apartado->id) {
            foreach ($articulos as $venta) {
                VentaApartado::create([
                    'cantidad' => $venta->cantidad,
                    'articulo_id' => $venta->id,
                    'apartado_id' => $apartado->id
                ]);
                $articulo = Articulo::find($venta->id);
                $articulo->fill(['cantidad' => ($articulo->cantidad - $venta->cantidad)]);
                $articulo->update();
            }
            $request->session()->forget(['cliente_id', 'articulos']);
            return redirect('apartados');
        }
    }

    public function cancelar(Request $request)
    {
        $request->session()->forget(['cliente_id', 'articulos']);
        return redirect('apartados');   
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
            ->orWhere('nombre', 'like', $query)
            ->orderBy('id', 'asc')->get();
            if (count($clientes) > 1) {
                $articulos = $this->articulos($request->session()->get('articulos'));
                return view('apartados.index', compact('clientes', 'articulos'));
            } else if (count($clientes) == 1) {
                return redirect("/apartados/clientes/{$clientes[0]->id}");
            } else {
                return redirect('apartados')->with('cliente_error', 'Ningún cliente registrado coincide con la busqueda');
            }
        } else {
            return redirect('apartados');
        }
    }

    public function asignarCliente(Request $request, $id)
    {
        $request->session()->put('cliente_id', $id);
        return redirect('apartados');
    }

    public function quitarCliente(Request $request)
    {
        $request->session()->forget('cliente_id');
        return redirect('apartados');
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
                return view('apartados.index', compact('cliente', 'articulos', 'result'));
            } else if (count($result) == 1) {
                return redirect("/apartados/articulos/{$result[0]->id}");
            } else {
                return redirect('apartados')->with('articulos_error', 'Ningún artículo registrado coincide con la busqueda');
            }
        } else {
            return redirect('apartados');
        }
    }

    public function seleccionarArticulo(Request $request, $id)
    {
        $articulo = Articulo::find($id);
        $cliente = $this->cliente($request->session()->get('cliente_id'));
        $articulos = $this->articulos($request->session()->get('articulos'));
        return view('apartados.index', compact('cliente', 'articulos', 'articulo'));
    }

    public function asignarArticulo(Request $request, $id)
    {
        $cantidad = $request->get('cantidad');
        $request->session()->push('articulos', [ 'id' => $id, 'cantidad' => $cantidad ]);
        return redirect('apartados');
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
        return redirect('apartados');
    }
}
