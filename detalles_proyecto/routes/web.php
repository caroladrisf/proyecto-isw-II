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

Route::get('/', function () {
    return view('welcome');
})->middleware('admin');

// Rutas de iniciar y cerrar sesión
Route::get('/admin/session', 'AdminController@login')->name('login');
Route::post('/admin/session', 'AdminController@session');
Route::get('/logout', 'AdminController@logout')->name('logout');


Route::resources([
    'articulos' => 'ArticuloController',
    'contactos' => 'ContactoController',
    'admin' => 'AdminController',
    'debitos' => 'VentaDebitoController'
]/* , ['middleware' => ['admin']] */);

