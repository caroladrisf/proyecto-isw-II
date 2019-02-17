@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-light mx-auto " id="custom">
            <div class="card-header text-center">
                <h5>Listado de artículos</h5>
            </div>
            <div>
                <table class="table table-sm table-hover table-bordered shadow">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">DESCRIPCIÓN</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">PRECIO COMPRA</th>
                            <th scope="col">PRECIO VENTA</th>
                            <th scope="col">OPCIONES <i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articulos as $articulo)
                        <tr>
                            <th scope="row">{{ $articulo['id'] }}</th>
                            <td>{{ $articulo['descripcion'] }}</td>
                            <td>{{ $articulo['cantidad'] }}</td>
                            <td>₡ {{ $articulo['precio_compra'] }}</td>
                            <td>₡ {{ $articulo['precio_venta'] }}</td>
                            <td>
                                <div class="row ml-5">
                                    <a href="{{ action('ArticuloController@edit', $articulo['id']) }}" class="btn btn-info"><i class="fas fa-pen"></i></a>
                                    <form action="{{ action('ArticuloController@destroy', $articulo['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center w-50 mx-auto pt-2">
                    <a href="{{ url('articulos/create') }}" class="btn btn-primary btn-block"><strong>Agregar artículo</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
