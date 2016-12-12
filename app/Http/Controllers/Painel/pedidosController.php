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

	 static function getPedido(Request $request) {


	 	$dados_cliente = array();

 		$dados_cliente = ['cnpj' => $request->cnpj_cliente];
 				

		if (!empty($dados_cliente['cnpj'])) {

			$query_cliente = Clientes::where('CNPJ', 'like', $dados_cliente['cnpj'])->first(); 
			
			if (!empty($query_cliente)) {
				$dados_cliente['nome'] = $query_cliente->NOME_FANTASIA;	

			} else {
				$dados_cliente['achou'] = 'CNPJ/CPF informado não foi encontrado!';
			}

		}	
		
		return view('painel/pedidos/create', compact('dados_cliente'));

	}


	
} // classe PedidosCONTROLLER