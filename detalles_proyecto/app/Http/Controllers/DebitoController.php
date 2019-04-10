<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Cliente;
use App\Debito;
use App\VentaDebito;
use Illuminate\Http\Request;

class DebitoController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cliente = $this->cliente($request->session()->get('cliente_id'));
        $articulos = $this->articulos($request->session()->get('articulos'));
        return view('debitos.index', compact('cliente', 'articulos'));
    }

    /**
     * Show the registros view
     */
    public function registros()
    {
        return view('debitos.registros');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $debito = new Debito();
        $debito->fecha = now();
        $debito->cliente_id = $request->session()->get('cliente_id');
        $debito->monto_total = 0;
        foreach ($articulos as $articulo) {
            $debito->monto_total += $articulo->cantidad * $articulo->precio_venta;
        }
        $debito->save();
        if ($debito->id) {
            foreach ($articulos as $venta) {
                Ventadebito::create([
                    'cantidad' => $venta->cantidad,
                    'articulo_id' => $venta->id,
                    'debito_id' => $debito->id
                ]);
                $articulo = Articulo::find($venta->id);
                $articulo->fill(['cantidad' => ($articulo->cantidad - $venta->cantidad)]);
                $articulo->update();
            }
            $request->session()->forget(['cliente_id', 'articulos']);
            return redirect('debitos');
        }
    }

    public function cancelar(Request $request)
    {
        $request->session()->forget(['cliente_id', 'articulos']);
        return redirect('debitos');   
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

    public function busquedaRegistro(Request $request){
        if($request->query('busqueda')){
            $busqueda = $request->query('busqueda');
            $query = '%' . $busqueda . '%';
            $fechas = Debito::where('fecha', 'ilike', $query)
            ->orderBy('id', 'asc')->get();
            if(count($fechas) >= 1){
                return view('debitos.registros', compact('fechas'));
            } else {
                $err_msg = "No hay coincidencias con la fecha '" . $request->query('busqueda') . "'";
                return redirect('debitos/registros')->with('busqueda_error', $err_msg);
            }
        } else {
            return redirect('debitos/registros')->with('busqueda_error', 'Digita una fecha');
        }
    }

    public function detallesVenta(Request $request){
        if($request->query('id_de')){
            $debito_id = $request->query('id_de');
            $ventas = VentaDebito::where('debito_id', 'ilike', $debito_id)
            ->orderBy('id', 'asc')->get();
            $articulos = [];
            if($ventas){
                foreach ($ventas as $venta) {
                    array_push($articulos, $venta->articulo_id);
                }
            }
            $arts = [];
            if($articulos){
                foreach ($articulos as $articulo) {
                    $art = Articulo::where('id', '=', $articulo)
                    ->orderBy('id', 'asc')->get();
                    array_push($arts, $art);
                }
            }
            $detalles = [];
            if($arts){
                for ($i=0; $i < count($arts); $i++) { 
                    $articulo = $arts[$i][0]->descripcion;
                    array_push($detalles, $articulo);
                }
            }
            return view('debitos.detalles', compact('ventas', 'detalles'));
        }
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
                return view('debitos.index', compact('clientes', 'articulos'));
            } else if (count($clientes) == 1) {
                return redirect("/debitos/clientes/{$clientes[0]->id}");
            } else {
                return redirect('debitos')->with('cliente_error', 'Ningún cliente registrado coincide con la busqueda');
            }
        } else {
            return redirect('debitos');
        }
    }

    public function asignarCliente(Request $request, $id)
    {
        $request->session()->put('cliente_id', $id);
        return redirect('debitos');
    }

    public function quitarCliente(Request $request)
    {
        $request->session()->forget('cliente_id');
        return redirect('debitos');
    }

    public function buscarArticulos(Request $request)
    {
        if ($request->query('art')){
            $query = '%' . $request->query('art') . '%';
            $result = Articulo::where('descripcion', 'ilike', $query)->where('cantidad', '>', 0)
            ->orderBy('id', 'asc')->get();
            if (count($result) > 1) {
                $cliente = $this->cliente($request->session()->get('cliente_id'));
                $articulos = $this->articulos($request->session()->get('articulos'));
                return view('debitos.index', compact('cliente', 'articulos', 'result'));
            } else if (count($result) == 1) {
                return redirect("/debitos/articulos/{$result[0]->id}");
            } else {
                return redirect('debitos')->with('articulos_error', 'Ningún artículo registrado coincide con la busqueda o 
                No hay más cantidad de este artículo en inventario');
            }
        } else {
            return redirect('debitos');
        }
    }

    public function seleccionarArticulo(Request $request, $id)
    {
        $articulo = Articulo::find($id);
        $cliente = $this->cliente($request->session()->get('cliente_id'));
        $articulos = $this->articulos($request->session()->get('articulos'));
        return view('debitos.index', compact('cliente', 'articulos', 'articulo'));
    }

    public function asignarArticulo(Request $request, $id)
    {
        $cantidad = $request->get('cantidad');
        $request->session()->push('articulos', [ 'id' => $id, 'cantidad' => $cantidad ]);
        return redirect('debitos');
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
        return redirect('debitos');
    }
}
