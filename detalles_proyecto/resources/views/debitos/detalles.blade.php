@extends('layouts.app')
@section('content')
@php
    $cantidad;
    $cantidades = [];
@endphp
@foreach ($ventas as $venta)
<h5>
    @php
        $cantidad = $venta->cantidad;
        array_push($cantidades, $cantidad);
    @endphp
</h5>
@endforeach
<div class="container">
    <div class="row">
        
        @for ($i = 0; $i < count($detalles); $i++)
        <div class="card ml-1 mr-2 mb-4">
            <div class="card-header bg-primary text-white text-center">
                <h5>{{$detalles[$i]->descripcion}}</h5>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>Cantidad de articulo comprado</th>
                            <th>Monto Unitario</th>
                            <th>Monto total por articulo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$cantidades[$i]}}</td>
                            <td>{{$detalles[$i]->precio_venta}}</td>
                            <td>{{($detalles[$i]->precio_venta*$cantidades[$i])}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endfor
    </div>
</div>

@endsection