<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = '%' . $request->query('buscar') . '%';
        if ($query) {
            $clientes = Cliente::where('cedula', 'like', $query)
                                ->orWhere('nombre', 'like', $query)
                                ->orWhere('apellido', 'like', $query)
                                ->orderBy('id', 'asc')->paginate(6);
        } else {
            $clientes = Cliente::orderBy('id', 'asc')->paginate(10);
        }
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        $cliente = Cliente::create($request->all());
        return redirect('clientes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ClienteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->fill($request->all());
        $cliente->update();
        return redirect('clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        Cliente::destroy($cliente->id);
        return redirect('clientes');
    }
}
