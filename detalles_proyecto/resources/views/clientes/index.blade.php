@extends('layouts.app')

@section('content')

<div class="container" id="custom">
    <div class="row p-2">
        <form action="{{ action('ClienteController@index') }}" class="col-8" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="buscar" placeholder="Buscar">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <div class="text-center col-4">
            <a href="{{ url('clientes/create') }}" class="btn btn-primary btn-block"><strong>Agregar cliente</strong></a>
        </div>
    </div>
    <div class="card border-light mx-auto">
        <div class="card-header text-center">
            <h5>Clientes</h5>
        </div>
        <div>
            <table class="table table-sm table-hover table-bordered shadow">
                <thead>
                    <tr class="text-center">
                        <th scope="col">CÉDULA</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">APELLIDO</th>
                        <th scope="col">CORREO</th>
                        <th scope="col">TELÉFONO</th>
                        <th scope="col">OPCIONES <i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                @foreach($clientes as $cliente)
                <tbody>
                    <tr class="text-center">
                        <td>{{$cliente->contacto->cedula}}</td>
                        <td>{{$cliente->contacto->nombre}}</td>
                        <td>{{$cliente->contacto->apellido}}</td>
                        <td>{{$cliente->contacto->correo}}</td>
                        <td>{{$cliente->contacto->telefono}}</td>
                        <td>
                            <div class="row ml-5">
                                <a href="{{ action('ClienteController@edit', $cliente->id) }}" class="btn btn-info"><i
                                        class="fas fa-pen"></i></a>
                                <form action="{{ action('ClienteController@destroy', $cliente->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $clientes->links() }}
    </div>
</div>

@endsection
