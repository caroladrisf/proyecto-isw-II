<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contacto;
use App\Telefono;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactos = DB::table('contacto')->join('telefonos', 'contacto.id_telefono', '=', 'telefonos.id')->select('contacto.*', 'telefonos.numero')->get();
        return view('contactos.index', compact('contactos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contactos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $telefono = new Telefono();
        $contacto = new Contacto();
        $telefono->numero = $request->input('numero');
        $id_telefono = DB::table('telefonos')->insertGetId(['numero'=>"$telefono->numero"]);
        echo $id_telefono;
        $contacto->fill($request->all());
        $contacto->id_telefono = $id_telefono;
        $contacto = DB::table('contacto')->insert(
            ['tipo_contacto'=>"$contacto->tipo_contacto",
            'nombre'=>"$contacto->nombre",
            'apellido'=>"$contacto->apellido",
            'correo'=>"$contacto->correo",
            'direccion'=>"$contacto->direccion",
            'id_telefono'=>"$contacto->id_telefono",
            ]);
        return redirect('/contactos');
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
    public function edit($id)
    {
        $contacto = DB::table('contacto')->where('contacto.id', '=', "$id")->join('telefonos', 'contacto.id_telefono', '=', 'telefonos.id')->select('contacto.*', 'telefonos.numero')->get();
        return view('contactos.edit', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('contacto')->where('id', $id)->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
