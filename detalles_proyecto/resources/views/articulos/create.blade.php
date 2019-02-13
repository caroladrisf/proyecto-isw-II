@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="card border-light mx-auto mb-5" id="custom">
            <div class="card-header text-center">
                <h5>Agregar artículo</h5>
            </div>
            <div class="p-4 shadow">
                <form>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" class="form-control" placeholder="Descripción">
                    </div>
                    <div class="form-group">
                        <label>Cantidad</label>
                        <input type="text" class="form-control" placeholder="Cantidad">
                    </div>
                    <div class="form-group">
                        <label>Precio de compra</label>
                        <input type="text" class="form-control" placeholder="₡">
                    </div>
                    <div class="form-group">
                        <label>Precio de venta</label>
                        <input type="text" class="form-control" placeholder="₡">
                    </div>
                </form>
                <div class="text-center w-50 mx-auto pt-2">
                    <a href="#" class="btn btn-primary btn-block"><strong>Guardar</strong></a>
                    <a href="#" class="btn btn-secondary btn-block"><strong>Cancelar</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
