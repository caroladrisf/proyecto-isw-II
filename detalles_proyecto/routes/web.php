<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas de iniciar y cerrar sesión
Route::get('/admin/session', 'AdminController@login')->name('login');
Route::post('/admin/session', 'AdminController@session');
Route::get('/logout', 'AdminController@logout')->name('logout');

Route::middleware(['admin'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::resources([
        'articulos' => 'ArticuloController',
        'clientes'  => 'ClienteController',
        'admin'     => 'AdminController',
        'debitos'   => 'VentaDebitoController'
    ]);

    // Rutas de ventas a crédito
    Route::get('/creditos', 'CreditoController@create');
    Route::get('/creditos/clientes', 'CreditoController@buscarClientes');
    Route::get('/creditos/clientes/{id}', 'CreditoController@asignarCliente');

});
