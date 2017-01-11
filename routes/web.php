<?php

use Illuminate\Http\Request;

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

Route::get('/', 'Auth\AuthController@showLogin')->name('login');


// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('logout');


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
	Route::get('painel/clientes/show/{cnpj}', 'Painel\clientesController@show')->name('show_cliente');
	Route::get('painel/clientes/edit/{cnpj}', 'Painel\clientesController@edit')->name('edit_cliente');
	Route::post('painel/clientes/update/{cnpj}', 'Painel\clientesController@update');	
	Route::get('painel/clientes/create', 'Painel\clientesController@create');	
	Route::post('painel/clientes/store', 'Painel\clientesController@store');

// PEDIDOS
Route::get( 'painel/pedidos', 'Painel\pedidosController@index')->name('pedidos');
	Route::get('painel/pedidos/busca', 'Painel\pedidosController@getBuscaPedido');
	Route::get( 'painel/pedidos/create', 'Painel\pedidosController@create');
	Route::post('painel/pedidos/store', 'Painel\pedidosController@store');

	Route::post('painel/pedidos/additem', 'Painel\pedidosController@addItem');
	
	//buscas de produto
	Route::get('painel/pedidos/busca_prod_modelo/{modelo}', 'Painel\pedidosController@buscaProdModelo');
	Route::get('painel/pedidos/busca_prod_descr/{descricao}', 'Painel\pedidosController@buscaProdDescr');	
	Route::get('painel/pedidos/busca_prod_tamanho/{id_produto}/{tabela_preco}', 'Painel\pedidosController@buscaProdTamanhos');		
	



