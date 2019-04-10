@extends('layouts.app')
@section('content')
@foreach ($ventas as $venta)
<h5>

    {{$venta->articulo_id}}
</h5>
@endforeach

@foreach ($detalles as $detalle)
<h5>{{$detalle}}</h5>
@endforeach
@endsection