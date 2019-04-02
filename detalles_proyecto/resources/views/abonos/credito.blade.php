@extends('layouts.app')
@section('content')
<ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/abonos') }}">Cliente</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ action('AbonoController@buscarCuentas', $cliente->id) }}">Cuenta</a>
    </li>
    <li class="nav-item active show">
        <a class="nav-link" href="#">Abono</a>
    </li>
</ul>
<div class="container mt-3" id="custom">

    <div class="row">
        <div class="col-sm-12 pl-2 pt-2" style="background-color: #26a69a;">
            <h6 class="text-white text-center">Información del crédito</h6>
        </div>
        <div class="col-sm-6">
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
        <div class="col-sm-6">
            @isset($credito)
            <table class="table table-borderless table-sm">
                <thead>
                    <tr>
                        <th scope="col">Monto total</th>
                        <th scope="col">Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>₡{{ $credito->monto_total }}</td>
                        <td>₡{{ $credito->saldo }}</td>
                    </tr>
                <tbody>
            </table>
            @endisset
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <div class="pl-2 pt-2 pb-1" style="background-color: #26a69a;">
                <h6 class="text-white text-center">Abonos</h6>
            </div>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01/02/2018</td>
                        <td>12340</td>
                    </tr>
                    <tr>
                        <td>01/02/2018</td>
                        <td>12340</td>
                    </tr>
                    <tr>
                        <td>01/02/2018</td>
                        <td>12340</td>
                    </tr>
                <tbody>
            </table>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
            <div class="pl-2 pt-2 pb-1" style="background-color: #26a69a;">
                <h6 class="text-white text-center">Abono</h6>
            </div>
            <form action="{{ action('AbonoController@guardarAbonoCredito', [$cliente->id, $credito->id]) }}" method="post" class="p-2">
                @csrf
                <div class="form-group">
                    <label>Monto</label>
                    <input name="abono" type="text" class="form-control" placeholder="₡">
                </div>

                <div class="d-flex justify-content-between align-items-center pt-2">
                    <button type="submit" class="btn btn-primary"><strong>Guardar</strong></button>
                    <a href="/" class="btn btn-secondary"><strong>Cancelar</strong></a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
