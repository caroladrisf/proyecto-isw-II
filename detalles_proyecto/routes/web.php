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

    Route::get('/', 'DashboardController');
    
    // Rutas de los CRUDs
    Route::resources([
        'articulos' => 'ArticuloController',
        'clientes'  => 'ClienteController',
        'proveedores' => 'ProveedorController',
        'admin'     => 'AdminController'
    ]);

    // Rutas de ventas a crédito
    Route::get('/creditos', 'CreditoController@create');
    Route::post('/creditos', 'CreditoController@store');
    Route::delete('/creditos', 'CreditoController@cancelar');
    Route::get('/creditos/clientes', 'CreditoController@buscarClientes');
    Route::get('/creditos/clientes/{id}', 'CreditoController@asignarCliente');
    Route::delete('/creditos/cliente', 'CreditoController@quitarCliente');
    Route::get('/creditos/articulos', 'CreditoController@buscarArticulos');
    Route::get('/creditos/articulos/{id}', 'CreditoController@seleccionarArticulo');
    Route::post('/creditos/articulos/{id}', 'CreditoController@asignarArticulo');
    Route::delete('/creditos/articulos/{id}', 'CreditoController@quitarArticulo');
    
    // Rutas de ventas a débito
    Route::get('/debitos', 'DebitoController@create');
    Route::get('/debitos/registros', 'DebitoController@registros');
    Route::post('/debitos', 'DebitoController@store');
    Route::delete('/debitos', 'DebitoController@cancelar');
    Route::get('/debitos/clientes', 'DebitoController@buscarClientes');
    Route::get('/debitos/clientes/{id}', 'DebitoController@asignarCliente');
    Route::delete('/debitos/cliente', 'DebitoController@quitarCliente');
    Route::get('/debitos/articulos', 'DebitoController@buscarArticulos');
    Route::get('/debitos/articulos/{id}', 'DebitoController@seleccionarArticulo');
    Route::post('/debitos/articulos/{id}', 'DebitoController@asignarArticulo');
    Route::delete('/debitos/articulos/{id}', 'DebitoController@quitarArticulo');

    // Rutas de apartados
    Route::get('/apartados', 'ApartadoController@create');
    Route::post('/apartados', 'ApartadoController@store');
    Route::delete('/apartados', 'ApartadoController@cancelar');
    Route::delete('/apartados/{id}', 'ApartadoController@eliminar');
    Route::get('/apartados/clientes', 'ApartadoController@buscarClientes');
    Route::get('/apartados/clientes/{id}', 'ApartadoController@asignarCliente');
    Route::delete('/apartados/cliente', 'ApartadoController@quitarCliente');
    Route::get('/apartados/articulos', 'ApartadoController@buscarArticulos');
    Route::get('/apartados/articulos/{id}', 'ApartadoController@seleccionarArticulo');
    Route::post('/apartados/articulos/{id}', 'ApartadoController@asignarArticulo');
    Route::delete('/apartados/articulos/{id}', 'ApartadoController@quitarArticulo');

    // Rutas de abonos
    Route::get('/abonos', 'AbonoController@index');
    Route::get('/abonos/clientes', 'AbonoController@buscarClientes');
    Route::get('/abonos/clientes/{cliente}', 'AbonoController@buscarCuentas');
    Route::get('/abonos/clientes/{cliente}/creditos/{credito}', 'AbonoController@abonarCredito');
    Route::post('/abonos/clientes/{cliente}/creditos/{credito}', 'AbonoController@guardarAbonoCredito');
    Route::get('/abonos/clientes/{cliente}/apartados/{apartado}', 'AbonoController@abonarApartado');
    Route::post('/abonos/clientes/{cliente}/apartados/{apartado}', 'AbonoController@guardarAbonoApartado');

});
