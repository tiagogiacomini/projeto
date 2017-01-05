<?php 
  
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\Pedidos;
use App\Models\Produtos;
use App\Models\Clientes;
use DB;
use Carbon\Carbon;
use Cookie;

class PedidosController extends Controller 
{

	public static function create() {

		if (empty(Cookie::get('userdata'))) {
			return redirect()->route('login');
		} 
	
		return view('painel/pedidos/create');

	}

	public static function store(Request $request) {


		$pedido = new Pedidos;
		dd($pedido);

	}


	
} // classe PedidosCONTROLLER