@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mx-auto" style="max-width: 600px">
        <div class="card-header text-center">
            <h5>LOGIN</h5>
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
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
    </div>
</div>

@endsection
