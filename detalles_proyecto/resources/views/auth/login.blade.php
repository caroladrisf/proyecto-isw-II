@extends('layouts.app')

@section('content')

    <div class="card border-light mx-auto shadow" id="login">
        <div class="card-header text-center pt-4">
            <h3>LOGIN</h3>
        </div>
        <div class="card-body">
            <form action="{{ action('AdminController@session') }}" method="POST">
            @csrf
                <div class="form-group">
                    <label>Correo electrónico o usuario</label>
                    <input type="text" name="username" class="form-control" placeholder="Correo electrónico o usuario">
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                </div>
                <div class="text-center w-50 mx-auto pt-2">
                    <button type="submit" class="btn btn-primary btn-block"><strong>Ingresar</strong></button>
                </div>
            </form>
        </div>
    </div>

@endsection
