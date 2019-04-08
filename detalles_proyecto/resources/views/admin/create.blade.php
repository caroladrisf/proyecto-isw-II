@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="card border-light mx-auto mb-5" id="custom">     
            <div class="card-header text-center">
                <h5>Administrador</h5>
            </div>
            <div class="p-4 shadow">
                <form action="{{ action('AdminController@store') }}" method="post" class="form-group">
                    @csrf
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" name="correo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nombre de Usuario</label>
                        <input type="text" name="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="contrasena" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Repita Contraseña</label>
                        <input type="password" name="re-password" class="form-control">
                    </div>
                    <div class="text-center w-50 mx-auto pt-2">
                        <button type="submit" class="btn btn-primary btn-block"><strong>Agregar</strong></button>
                        <a href="{{ url('/') }}" class="btn btn-secondary btn-block"><strong>Cancelar</strong></a>
                    </div>
                </form>   
            </div>
        </div>
    </div>
</div>
@endsection