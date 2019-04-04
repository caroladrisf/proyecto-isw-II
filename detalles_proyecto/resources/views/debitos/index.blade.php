@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mx-auto " id="custom">
        <div class="card-header text-center">
            <h5>Débito</h5>
        </div>
        <div class="card-body border-dark">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6 class="ml-2">Cliente</h6>
                    @if (!Session::get('cliente_id'))
                    <form method="GET" action="{{ url('/debitos/clientes') }}">
                        <div class="form-group">
                            @if (session('cliente_error'))
                            <div class="alert alert-dismissible alert-warning">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <p>{{ session('cliente_error') }}</p>
                            </div>
                            @endif
                            <small class="form-text text-muted">Busque un cliente por número de cédula,
                                nombre o apellido.</small>
                            <div class="input-group">
                                <input type="text" name="cliente" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            @isset($clientes)
                            <div class="list-group mr-5">
                                @foreach ($clientes as $c)
                                <a href="{{ action('DebitoController@asignarCliente', $c->id) }}" class="list-group-item list-group-item-action">
                                    {{ $c->cedula }} - {{ $c->nombre }}</a>
                                @endforeach
                            </div>
                            @endisset
                        </div>
                    </form>
                    @else
                    <table class="table table-borderless table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Cédula</th>
                                <th scope="col">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($cliente)
                            <tr>
                                <td>{{ $cliente->cedula }}</td>
                                <td>{{ $cliente->nombre }}</td>
                            </tr>
                            @endisset
                            <tr>
                                <td col-span="2">
                                    <form action="{{ action('DebitoController@quitarCliente') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-primary" type="submit">Cambiar cliente</button>
                                    </form>
                                </td>
                            </tr>
                        <tbody>
                    </table>
                    @endif
                </div>
                <div class="col-md-6">
                    <h6 class="ml-2">Artículo</h6>
                    <form method="GET" action="{{ url('/debitos/articulos') }}">
                        <div class="form-group">
                            @if (session('articulo_error'))
                            <div class="alert alert-dismissible alert-warning">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <p>{{ session('articulo_error') }}</p>
                            </div>
                            @endif
                            <div class="input-group">
                                <input type="text" name="art" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            @isset($result)
                            <div class="list-group mr-5">
                                @foreach ($result as $art)
                                <a href="{{ action('DebitoController@seleccionarArticulo', $art->id) }}" class="list-group-item list-group-item-action">
                                    {{ $art->descripcion }} - ₡{{ $art->precio_venta }}</a>
                                @endforeach
                            </div>
                            @endisset
                        </div>
                    </form>
                    @isset($articulo)
                    <form method="POST" action="{{ action('DebitoController@asignarArticulo', $articulo->id) }}">
                        @csrf
                        <table class="table table-borderless table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $articulo->descripcion }}</td>
                                    <td><input type="number" value="1" name="cantidad" min="1" max="{{ $articulo->cantidad }}" class="form-control"></td>
                                </tr>
                            <tbody>
                        </table>
                        <div>
                            <button type="submit" class="btn btn-block btn-primary">Añadir artículo a la tabla</button>
                        </div>
                    </form>
                    @endisset
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
                    @if (Session::get('articulos'))
                    @isset($articulos)
                    @php $total = 0 @endphp
                    @for ($i=0; $i < count($articulos); $i++)
                    <tr>
                        <th scope="row">{{$i + 1}}</th>
                        <td>{{$articulos[$i]->descripcion}}</td>
                        <td>{{$articulos[$i]->cantidad}}</td>
                        <td>₡{{$articulos[$i]->precio_venta * $articulos[$i]->cantidad}}</td>
                        @php 
                        $total += $articulos[$i]->precio_venta * $articulos[$i]->cantidad
                        @endphp
                        <td>
                            <div class="d-flex justify-content-center">
                                <form action="{{ action('DebitoController@quitarArticulo', $articulos[$i]->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger ml-1" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endfor
                    <tr>
                        <th scope="row" colspan="3">TOTAL</th>
                        <td>
                            ₡{{$total}}
                        </td>
                    </tr>
                    @endisset
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end align-items-center">
            <form class="w-25 mx-1" method="POST" action="{{ action('DebitoController@store') }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-block">Aceptar</button>
            </form>
            <form class="w-25 mx-1" method="POST" action="{{ action('DebitoController@cancelar') }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-secondary btn-block">Cancelar</button>
            </form>
        </div>
    </div>
</div>
@endsection