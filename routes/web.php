<?php

use Illuminate\Http\Request;
use App\Models\Produtos;
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


Route::get('/', 'Auth\AuthController@showLogin');


// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

 /*
Route::post('painel/home', [
    'middleware' => 'auth',
    'uses' => 'PainelController@getPainel',
    'name' => 'home'
]);
*/

Route::get( 'painel/home', 'Painel\painelController@getPainel')->name('home');

// faz a busca do CEP
Route::get('painel/buscacep/{cep}', 'Painel\painelController@buscaCEP');

// faz a busca do CLIENTE
Route::get('painel/buscacliente/{pesquisa}', 'Painel\painelController@buscaCliente');


// PRODUTOS
Route::get( 'painel/produtos', 'Painel\produtosController@index' )->name('produtos');
	Route::get('painel/produtos/busca', 'Painel\produtosController@getBuscaProduto');	

// CLIENTES
Route::get( 'painel/clientes', 'Painel\clientesController@index' )->name('clientes');
	Route::get('painel/clientes/busca', 'Painel\clientesController@getBuscaCliente');
	Route::get('painel/clientes/adiciona', 'Painel\clientesController@create');	
	Route::post('painel/clientes/store', 'Painel\clientesController@store');

// PEDIDOS
Route::get( 'painel/pedido', 'Painel\pedidosController@index')->name('pedido');

