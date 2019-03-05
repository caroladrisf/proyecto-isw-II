@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-light mx-auto" id="custom">
            <div class="card-header text-center">
                <h5>Débito</h5>
            </div>
            <div class="shadow pb-3">
                <div class="p-4">
                    <form action="" method="GET">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Cliente</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="buscar_cliente" placeholder="Buscar">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <button class="btn btn-primary">Agregar cliente</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Cliente:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Artículo</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="buscar_articulo" placeholder="Buscar">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-2 col-form-label">Cantidad</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="cantidad">
                                    <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <button class="btn btn-primary">Agregar a venta</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <table class="table table-sm table-hover table-bordered shadow">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col"><i class="fas fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection