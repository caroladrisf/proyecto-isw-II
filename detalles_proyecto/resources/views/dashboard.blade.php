@extends('layouts.app')

@section('content')
<div class="container">
    <div class="my-3 d-flex justify-content-center">
        <img src="{{ asset('detalles.jpg') }}" height="70px">
    </div>
    <div class="jumbotron p-5">
        <h2 class="display-4" style="font-size: 2rem;">Apartados pendientes</h2>
        <p class="lead">Listado de los apartados que están cerca de los dos meses límite para cancelar.</p>
        <hr class="my-2">
        <div class="scrollable">
            <table class="table table-sm table-hover table-bordered">
                <tr>
                    <th scope="col">
                        <div>Cliente</div>
                    </th>
                    <th scope="col">
                        <div>Fecha</div>
                    </th>
                    <th scope="col">
                        <div>Saldo</div>
                    </th>
                    <th scope="col">
                        <div><i class="fas fa-cog"></i></div>
                    </th>
                </tr>
                @isset($apartados)
                @foreach($apartados as $apartado)
                <tr>
                    <td>{{ $apartado->cliente->nombre }}</td>
                    <td>{{ $apartado->fecha }}</td>
                    <td>₡{{ $apartado->saldo }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ action('AbonoController@abonarApartado', [$apartado->cliente_id, $apartado->id]) }}" class="btn btn-info">Abonar</a>
                            <form action="{{ action('ApartadoController@eliminar', $apartado->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger ml-1" type="submit">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endisset
            </table>
        </div>
    </div>
</div>
@endsection
