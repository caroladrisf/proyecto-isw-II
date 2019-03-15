@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mx-auto " id="custom">
        <div class="card-header text-center">
            <h5>Crédito</h5>
        </div>
        <div class="card-body border-dark">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6 class="ml-2">Cliente</h6>
                    @if (!Session::get('cliente_id'))
                    <form method="GET" action="{{ url('/creditos/clientes') }}">
                        <div class="form-group">
                            @if (session('cliente_error'))
                            <div class="alert alert-dismissible alert-warning">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('cliente_error') }}
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
                                <a href="{{ action('CreditoController@asignarCliente', $c->id) }}" class="list-group-item list-group-item-action">
                                    {{ $c->cedula }} - {{ $c->nombre. ' ' . $c->apellido }}</a>
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
                                <td>{{ $cliente->nombre . ' ' . $cliente->apellido }}</td>
                            </tr>
                            @endisset
                            <tr>
                                <td col-span="2">
                                    <form action="{{ action('CreditoController@quitarCliente') }}" method="POST">
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
                    <form method="GET" action="{{ url('/creditos/clientes') }}">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="cliente" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ url('/clientes/create') }}" class="btn btn-block btn-primary">Nuevo cliente</a>
                        </div>
                    </form>
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
                        <td>3</td>
                        <td>₡5.000</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <form action="{{ action('CreditoController@create') }}" method="POST">
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
                                <form action="{{ action('CreditoController@create') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger ml-1" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <p>footer</p>
        </div>
    </div>
</div>
@endsection
