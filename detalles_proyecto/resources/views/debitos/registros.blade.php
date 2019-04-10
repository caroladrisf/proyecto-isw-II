@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card mx-auto" id="custom">
        <div class="card-header text-center">
            <h5>Registro de ventas a contado</h5>
        </div>
        <div class="card-body border-dark">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <h6 class="ml-2">Realiza tú búsqueda por fecha de venta</h6>
                    <form method="GET" action="{{'/debitos/registros/busqueda'}}">
                        <div class="input-group">
                        <input type="text" name="busqueda" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group mt-2">
                        @if (session('busqueda_error'))
                        <div class="alert alert-dismissible alert-warning">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p class="font-weight-bold">{{ session('busqueda_error') }}</p>
                        </div>
                        @endif
                    </div>
                    @isset($fechas)
                    <div class="row ml-1 mr-1">
                        @foreach ($fechas as $fecha)
                        <div class="card ml-1 mr-1 mb-4" style="width: 18rem;">
                            <div class="card-header bg-info">
                            <h5 class="card-title">Fecha: {{$fecha->fecha}}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">La venta fue realizada por un monto de: {{$fecha->monto_total}}</p>
                                <form method="GET" action="{{'/debitos/detalles'}}">
                                    <button name="id_de" value="{{$fecha->id}}" class="btn btn-success" type="submit">Mostrar detalles</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection