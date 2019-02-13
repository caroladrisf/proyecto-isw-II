@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-light mx-auto " id="custom">
            <div class="card-header text-center">
                <h5>Listado de artículos</h5>
            </div>
            <div>
                <table class="table table-sm table-hover table-bordered shadow">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">DESCRIPCIÓN</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">PRECIO COMPRA</th>
                            <th scope="col">PRECIO VENTA</th>
                            <th scope="col">OPCIONES <i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Artículo #1</td>
                            <td>5</td>
                            <td>₡10.000</td>
                            <td>₡10.450</td>
                            <td>
                                <div class="row ml-5">
                                    <a href="#" class="btn btn-info"><i class="fas fa-pen"></i></a>
                                    <form action="/" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Artículo #2</td>
                            <td>12</td>
                            <td>₡8.000</td>
                            <td>₡9.000</td>
                            <td>
                                <div class="row ml-5">
                                    <a href="#" class="btn btn-info"><i class="fas fa-pen"></i></a>
                                    <form action="/" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center w-50 mx-auto pt-2">
                    <a href="#" class="btn btn-primary btn-block"><strong>Agregar artículo</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
