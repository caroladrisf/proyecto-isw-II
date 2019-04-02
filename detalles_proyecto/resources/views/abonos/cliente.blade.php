@extends('layouts.app')
@section('content')
<ul class="nav nav-tabs nav-fill">
    <li class="nav-item active show">
        <a class="nav-link" data-toggle="tab" href="">Cliente</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="">Cuenta</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="">Abono</a>
    </li>
</ul>
<div class="container mt-5" id="custom">
    <form method="GET" action="{{ url('/abonos/clientes') }}">
        <div class="form-group">
            @if (session('cliente_error'))
            <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p>{{ session('cliente_error') }}</p>
            </div>
            @endif
            <small class="form-text text-muted">Busque un cliente por número de cédula, nombre o apellido.</small>
            <div class="input-group">
                <input type="text" name="cliente" class="form-control">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
            @isset($clientes)
            <div class="list-group mr-5">
                @foreach ($clientes as $c)
                <a href="{{ action('AbonoController@buscarCuentas', $c->id) }}"
                    class="list-group-item list-group-item-action">
                    {{ $c->cedula }} - {{ $c->nombre }}</a>
                @endforeach
            </div>
            @endisset
        </div>
    </form>
    @isset($cliente)
    <table class="table table-borderless table-sm">
        <thead>
            <tr>
                <th scope="col">Cédula</th>
                <th scope="col">Nombre</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $cliente->cedula }}</td>
                <td>{{ $cliente->nombre }}</td>
            </tr>
        <tbody>
    </table>
    @endisset
</div>
@endsection
