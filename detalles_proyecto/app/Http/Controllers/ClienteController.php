<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Contacto;
use App\Telefono;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate(10);
        foreach ($clientes as $cliente) {
            $cliente->contacto = Cliente::find($cliente->id)->contacto;
            /* $cliente->contacto->telefonos = Contacto::find($cliente->contacto->id)->telefonos; */
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contacto = Contacto::create($request->all());
        /* $telefono = $contacto->telefonos()->create([
            'numero' => $request->input('numero'),
            'contacto_id' => $contacto->id
        ]);
        $contacto->telefonos = $telefono; */
        $cliente = Cliente::create(['contacto_id' => $contacto->id]);
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
        $cliente->contacto = Cliente::find($cliente->id)->contacto;
        /* $cliente->contacto->telefonos = Contacto::find($cliente->contacto->id)->telefonos; */
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $contacto = Contacto::findOrFail($cliente->contacto_id);
        $contacto->fill($request->all())->save();
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
        Contacto::destroy($cliente->contacto_id);
        return redirect('clientes');
    }
}
