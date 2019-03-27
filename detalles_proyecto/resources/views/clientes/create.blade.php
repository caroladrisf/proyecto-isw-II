@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="card border-light mx-auto mb-5" id="custom">
            <div class="card-header text-center">
                <h5>Agregar cliente</h5>
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
                <form class="form-group" action="{{ action('ClienteController@store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Cédula</label>
                        <input type="text" value="{{ old('cedula') }}" class="form-control" placeholder="Cédula" name="cedula">
                    </div>
                    <div class="form-group">
                        <label>Nombre completo</label>
                        <input type="text" value="{{ old('nombre') }}" class="form-control" placeholder="Nombre completo" name="nombre">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" value="{{ old('correo') }}" class="form-control" placeholder="Correo" name="correo">
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" value="{{ old('telefono') }}" class="form-control" placeholder="Teléfono" name="telefono">
                    </div>
                    <div class="text-center w-50 mx-auto pt-2">
                        <button type="submit" class="btn btn-primary btn-block"><strong>Guardar</strong></button>
                        <a href="{{ url('clientes') }}" class="btn btn-secondary btn-block"><strong>Cancelar</strong></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection