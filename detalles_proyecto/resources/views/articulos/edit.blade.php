@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="card border-light mx-auto mb-5" id="custom">
            <div class="card-header text-center">
                <h5>Editar artículo</h5>
            </div>
            <div class="p-4 shadow">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ action('ArticuloController@update', $articulo->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label>Descripción</label>
                        <input name="descripcion" value="{{ $articulo->descripcion }}" type="text" class="form-control" placeholder="Descripción">
                    </div>
                    <div class="form-group">
                        <label>Cantidad</label>
                        <input name="cantidad" value="{{ $articulo->cantidad }}" type="text" class="form-control" placeholder="Cantidad">
                    </div>
                    <div class="form-group">
                        <label>Precio de compra</label>
                        <input name="precio_compra" value="{{ $articulo->precio_compra }}" type="text" class="form-control" placeholder="₡">
                    </div>
                    <div class="form-group">
                        <label>Precio de venta</label>
                        <input name="precio_venta" value="{{ $articulo->precio_venta }}" type="text" class="form-control" placeholder="₡">
                    </div>
                    <div class="text-center w-50 mx-auto pt-2">
                        <button type="submit" class="btn btn-primary btn-block"><strong>Guardar</strong></button>
                        <a href="{{ url('articulos') }}" class="btn btn-secondary btn-block"><strong>Cancelar</strong></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
