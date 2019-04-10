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
                    <tbody>
                        <tr>
                            <th>Cantidad de articulo comprado:</th>
                            <td class="pl-2">{{$cantidades[$i]}}</td>
                        </tr>
                        <tr>
                            <th>Monto Unitario:</th>
                            <td class="pl-2">{{$detalles[$i]->precio_venta}}</td>
                        </tr>
                        <tr>
                            <th>Monto total por articulo:</th>
                            <td class="pl-2">{{($detalles[$i]->precio_venta*$cantidades[$i])}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endfor
    </div>
</div>

@endsection