@extends('layouts.app')

@section('content')
    <div class="mx-auto" style="width: 500px">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>

    <div class="card border-light mx-auto shadow" id="login">
        <div class="card-header text-center pt-4">
            <h3>INICIAR SESIÓN</h3>
        </div>
        <div class="card-body">
            <form action="{{ action('AdminController@session') }}" method="POST">
            @csrf
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" name="usuario" class="form-control" value="{{ old('usuario') }}" placeholder="Usuario" required>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
                </div>
                <div class="text-center w-50 mx-auto pt-2">
                    <button type="submit" class="btn btn-primary btn-block"><strong>Ingresar</strong></button>
                </div>
            </form>
        </div>
    </div>

@endsection
