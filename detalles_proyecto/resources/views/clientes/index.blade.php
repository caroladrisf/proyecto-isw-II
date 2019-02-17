@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-light mx-auto " id="custom">
            <div class="text-center w-50 mx-auto pt-2">
                <a href="#" class="btn btn-primary btn-block"><strong>Agregar cliente</strong></a>
            </div>
            <br>        
            <div class="card-header text-center">
                <h5>Clientes</h5>
            </div>
            <div class="container">
                <form action="">
                    <div class="col-sm-2"></div>
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" name="" id="">
                    <div class="col-sm-2"></div>
                </form>            
            </div>
            <div>
                <table class="table table-sm table-hover table-bordered shadow">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">TELÉFONO</th>
                            <th scope="col">DIRECCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection