@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="card border-light mx-auto mb-5" id="custom">
            <div class="card-header text-center">
                <h5>Editar contacto</h5>
            </div>
            <div class="p-4 shadow">
            <form class="form-group" action="/contactos/{{$contacto[0]->id}}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label>Tipo Contacto</label>
                        <select name="tipo_contacto" value="{{$contacto[0]->tipo_contacto}}">
                            @if ($contacto[0]->tipo_contacto==1)
                                <option value="1" selected>Cliente</option>
                                <option value="2">Proveedor</option>
                            @else
                                <option value="1">Cliente</option>
                                <option value="2" selected>Proveedor</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" value="{{$contacto[0]->nombre}}" class="form-control" placeholder="Nombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" value="{{$contacto[0]->apellido}}" class="form-control" placeholder="Apellido" name="apellido">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" value="{{$contacto[0]->correo}}" class="form-control" placeholder="Correo" name="correo">
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" value="{{$contacto[0]->direccion}}" class="form-control" placeholder="Dirección" name="direccion">
                    </div>
                    <div class="form-group">
                        <label>Número</label>
                        <input type="text" value="{{$contacto[0]->numero}}" class="form-control" placeholder="Número" name="numero">
                    </div>
                    <div class="text-center w-50 mx-auto pt-2">
                        <button type="submit" class="btn btn-primary btn-block"><strong>Actualizar</strong></button>
                        <a href="{{ url('contactos') }}" class="btn btn-secondary btn-block"><strong>Cancelar</strong></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection