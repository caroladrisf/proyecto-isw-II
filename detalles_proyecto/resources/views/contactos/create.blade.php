@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="card border-light mx-auto mb-5" id="custom">
            <div class="card-header text-center">
                <h5>Agregar contacto</h5>
            </div>
            <div class="p-4 shadow">
                <form class="form-group" action="{{ action('ContactoController@store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tipo Contacto</label>
                        <select name="tipo_contacto">
                            <option value="1">Cliente</option>
                            <option value="2">Proveedor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" value="{{ old('nombre') }}" class="form-control" placeholder="Nombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" value="{{ old('apellido') }}" class="form-control" placeholder="Apellido" name="apellido">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" value="{{ old('correo') }}" class="form-control" placeholder="Correo" name="correo">
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" value="{{ old('direccion') }}" class="form-control" placeholder="Dirección" name="direccion">
                    </div>
                    <div class="form-group">
                        <label>Número</label>
                        <input type="text" value="{{ old('id_numero') }}" class="form-control" placeholder="Número" name="numero">
                    </div>
                    <div class="text-center w-50 mx-auto pt-2">
                        <button type="submit" class="btn btn-primary btn-block"><strong>Sub</strong></button>
                        <a href="{{ url('contactos') }}" class="btn btn-secondary btn-block"><strong>Cancelar</strong></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection