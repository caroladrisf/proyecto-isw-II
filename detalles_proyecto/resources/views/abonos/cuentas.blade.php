@extends('layouts.app')
@section('content')
<ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/abonos') }}">Cliente</a>
    </li>
    <li class="nav-item active show">
        <a class="nav-link" data-toggle="tab" href="#">Cuenta</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#">Abono</a>
    </li>
</ul>
<div class="container mt-5" id="custom">
    @isset($cliente)
    <h6>Cliente</h6>
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

    @isset($creditos)
    <h6>Créditos</h6>
    <div class="scrollable">
        <table class="table table-sm table-hover table-bordered">
            <tr>
                <th scope="col"><div>Fecha</div></th>
                <th scope="col"><div>Saldo</div></th>
                <th scope="col"><div><i class="fas fa-cog"></i></div></th>
            </tr>
            @foreach($creditos as $credito)
            <tr>
                <td>{{ $credito->fecha }}</td>
                <td>₡{{ $credito->saldo }}</td>
                <td><a href="{{ action('AbonoController@abonarCredito', [$cliente->id, $credito->id]) }}" class="btn btn-info">Abonar a este crédito</td>
            </tr>
            @endforeach
        </table>
    </div>
    @endisset

    @isset($apartados)
    <h6>Apartados</h6>
    <div class="scrollable">
        <table class="table table-sm table-hover table-bordered">
            <tr>
                <th scope="col"><div>Fecha</div></th>
                <th scope="col"><div>Saldo</div></th>
                <th scope="col"><div><i class="fas fa-cog"></i></div></th>
            </tr>
            @foreach($apartados as $apartado)
            <tr>
                <td>{{ $apartado->fecha }}</td>
                <td>₡{{ $apartado->saldo }}</td>
                <td><a href="{{ action('AbonoController@abonarApartado', [$cliente->id, $apartado->id]) }}" class="btn btn-info">Abonar a esta cuenta</td>
            </tr>
            @endforeach
        </table>
    </div>
    @endisset

</div>
@endsection
