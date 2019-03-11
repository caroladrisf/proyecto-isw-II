@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card border-light mx-auto " id="custom">
        <div class="card-header text-center">
            <h5>Crédito</h5>
        </div>
        <div class="shadow pb-3">
            <div class="p-4">
                <div>
                    <form method="GET" action="{{ action('ContactoController@search') }}" class="form-group row">
                        <label class="col-sm-2 col-form-label text-center">Cédula del cliente</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="nombre" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('/contactos/create') }}" class="col-sm-2 btn btn-primary">Nuevo cliente</a>
                    </form>
                    @if ($cliente)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" readonly="" class="form-control-plaintext" value="{{ $cliente->nombre }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Correo</label>
                        <div class="col-sm-10">
                            <input type="text" readonly="" class="form-control-plaintext" value="{{ $cliente->correo }}">
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-center">Artículo</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="text" name="articulo" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-2 col-form-label text-center">Cantidad</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="1">
                        </div>
                        <a href="#" class="col-sm-2 btn btn-primary">Agregar</a>
                    </div>
                </div>
            </div>
            <table class="table table-sm table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col"><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Artículo #1</td>
                        <td><input type="text" name="cantidad" value="1" class="form-control form-control-sm"></td>
                        <td>₡5.000</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <form action="{{ action('VentaCreditoController@create') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger ml-1" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Artículo #2</td>
                        <td>2</td>
                        <td>₡20.000</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <form action="{{ action('VentaCreditoController@create') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger ml-1" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center w-50 mx-auto pt-2">
                <a href="ventas.html" class="btn btn-primary btn-block"><strong>Confirmar venta</strong></a>
            </div>
        </div>
    </div>
</div>
@endsection