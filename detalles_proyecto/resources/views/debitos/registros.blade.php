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
                    <h6 class="ml-2">Realiza tú búsqueda por cliente o fecha</h6>
                <form method="GET" action="{{'/debitos/registros/busqueda'}}">
                    <div class="input-group">
                        <input type="text" name="busqueda" class="form-control">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        @if (session('cliente_error'))
                            <div class="alert alert-dismissible alert-warning">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <p>{{ session('cliente_error') }}</p>
                            </div>
                        @endif
                    </div>
                </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection