<?php 
  
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\Produtos;
use App\Models\Clientes;
use DB;

class PedidosController extends Controller 
{

	 static function index(Request $request) {

		
		return view('painel/pedidos/create');

	}


	
} // classe PedidosCONTROLLER