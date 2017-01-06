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

class PedidosController extends Controller 
{

	public static function create() {

		// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}

    	// decifra os dados DO USUARIO(VENDEDOR)
    	$data          = explode('|', session()->get('userdata'));
    	$vendedor_nome = $data[0];
    	$vendedor_id   = $data[1];	
	
		return view('painel/pedidos/create', compact('vendedor_nome', 'vendedor_id'));

	}

	public static function store(Request $request) {


		$pedido 				   = new Pedidos;
		$pedido->CNPJ_CLIFOR       = $request->pesquisa_cliente;
		$pedido->ID_VENDEDOR	   = $request->id_vendedor;
		$pedido->DATA_EMISSAO	   = $request->edit_dataemissao;
		$pedido->PREVISAO_ENTREGA  = $request->edit_dataentrega;
		$pedido->CONDICAO_PAGTO	   = $request->edit_formapagto;
		$pedido->OBSERVACAO		   = $request->edit_obs;

		if ($pedido->save()) {
			return redirect()->route('pedido-itens', ['id_pedido' => $pedido->ID_PEDIDO]);
		} 	

		
		
	}

	public static function addItens($id_pedido) {

		$pedido    = Pedidos::where('ID_PEDIDO', $id_pedido)->first();
		$produtos  = DB::select("select CONCAT(MODELO,' - ', DESCRICAO) as PRODUTO, ID_PRODUTO from PRODUTOS ORDER BY MODELO");
		//$produtos  = Produtos::select('MODELO', 'DESCRICAO')->get();	

	//	$produtos = $produtos->toArray();

		dd($produtos);

		if (!$pedido) {
			
			//criar VIEW PARA ERROS!!! - U R G E N T E
			return view('errors/503');
		}
	
    	// decifra os dados DO USUARIO(VENDEDOR)
    	$data          = explode('|', session()->get('userdata'));
    	$vendedor_nome = $data[0];
    	$vendedor_id   = $data[1];	

		return view('painel/pedidos/itens', compact('vendedor_nome', 'pedido', 'produtos'));

	}

	
} // classe PedidosCONTROLLER