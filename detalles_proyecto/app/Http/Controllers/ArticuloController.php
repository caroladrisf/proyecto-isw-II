<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\ArticuloRequest;
use App\Articulo;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->query('buscar');
        if ($query) {
            $articulos = Articulo::where('descripcion', 'like', '%' . $query . '%')
            ->orderBy('id', 'asc')->paginate(6);
        } else {
            $articulos = Articulo::orderBy('id', 'asc')->orderBy('id', 'asc')->paginate(6);
        }
        return view('articulos.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticulo  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticuloRequest $request)
    {
        $articulo = new Articulo();
        $articulo->fill($request->all());
        $articulo->save();
        return redirect('/articulos');
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
    public function edit(Articulo $articulo)
    {
        return view('articulos.edit', compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticuloRequest $request, Articulo $articulo)
    {
        $articulo->fill($request->all());
        $articulo->update();
        return redirect('/articulos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        $articulo->delete();
        return redirect('/articulos');
    }
}
