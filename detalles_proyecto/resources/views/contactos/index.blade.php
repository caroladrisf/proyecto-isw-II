@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-light mx-auto " id="custom">     
            <div class="card-header text-center">
                <h5>Contactos</h5>
            </div>
            <div class="container">
                <form action="" class="form-inline input-group">
                    <input class="form-control" type="text" placeholder="Buscar" name="" id="">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>            
            </div>
            <div>
                <table class="table table-sm table-hover table-bordered shadow">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">TIPO</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">DIRECCIÓN</th>
                            <th scope="col">TELÉFONO</th>
                            <th scope="col">OPCIONES <i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    @foreach($contactos as $contacto)
                        <tbody>
                            <tr class="text-center">
                                <td>{{$contacto->id}}</td>
                                @if ($contacto->tipo_contacto==1)
                                    <td>Cliente</td>
                                @else
                                    <td>Proveedor</td>
                                @endif
                                <td>{{$contacto->nombre}}</td>
                                <td>{{$contacto->apellido}}</td>
                                <td>{{$contacto->correo}}</td>
                                <td>{{$contacto->direccion}}</td>
                                <td>{{$contacto->numero}}</td>
                                <td>
                                    <div class="row ml-5">
                                        <a href="{{ action('ContactoController@edit', $contacto->id) }}" class="btn btn-info"><i class="fas fa-pen"></i></a>
                                        <form action="{{ action('ContactoController@destroy', $contacto->id) }}" method="POST">
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
                {{$contactos->links()}}
                <div class="text-center w-50 mx-auto pt-2">
                    <a href="{{ url('contactos/create') }}" class="btn btn-primary btn-block"><strong>Agregar contacto</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection