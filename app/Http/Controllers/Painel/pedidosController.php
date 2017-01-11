<?php 
  
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\Pedidos;
use App\Models\Produtos;
use App\Models\Clientes;
use App\Models\TabelaPrecosItens;
use App\Models\PedidosItens;
use DB;
use Carbon\Carbon;

class PedidosController extends Controller 
{

	public static function index(Request $request) {

		// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}


    	// decifra os dados DO USUARIO(VENDEDOR)
    	$data          = explode('|', session()->get('userdata'));
    	$vendedor_nome = $data[0];
    	$vendedor_id   = $data[1];	

    	
    	//VAI LISTAR APENAS PEDIDOS DO VENDEDOR LOGADO NO SISTEMA
    	$pedidos = Pedidos::where('ID_VENDEDOR', $vendedor_id)
    	                  ->orderBy('DATA_EMISSAO', 'DESC')
    	                  ->join('CLIENTES', 'CLIENTES.CNPJ' ,'=', 'PEDIDOS.CNPJ_CLIFOR')
    	                  ->paginate(10)
    	                  ->appends(['pesquisa' => $request->pesquisa]);


    	
    	return view('painel/pedidos/index', compact('pedidos'));


	}

	public static function buscaProdModelo($modelo) {
		
		$produto = Produtos::where('MODELO', 'LIKE', addslashes($modelo))
		                   ->first();

		return $produto->toJson();

	}
	
	public static function buscaProdDescr($descricao) {

		$produto = Produtos::where('DESCRICAO', 'LIKE', addslashes($descricao))
		                   ->first();

		return $produto->toJson();
		
	}
	
	public static function buscaProdTamanhos($id_produto, $tabela_preco) {

		
		$tamanhos = TabelaPrecosItens::where([['ID_PRODUTO','=', $id_produto],
			                                  ['ID_TABELA', '=', $tabela_preco]])

									   ->orderBy('TAMANHO')
		                               ->get();


		return $tamanhos->toJson();

	}

	

	public static function getBuscaPedido(Request $request) {


    	// decifra os dados DO USUARIO(VENDEDOR)
    	$data          = explode('|', session()->get('userdata'));
    	$vendedor_nome = $data[0];
    	$vendedor_id   = $data[1];	


    	//VAI LISTAR APENAS PEDIDOS DO VENDEDOR LOGADO NO SISTEMA
    	$pedidos = Pedidos::where([['ID_VENDEDOR', '=', $vendedor_id ], 
    		                       ['ID_PEDIDO'  , 'LIKE', '%' . $request->pesquisa . '%']])
    	                  ->orderBy('DATA_EMISSAO', 'DESC')
    	                  ->join('CLIENTES', 'CLIENTES.CNPJ' ,'=', 'PEDIDOS.CNPJ_CLIFOR')
    	                  ->paginate(10)
    	                  ->appends(['pesquisa' => $request->pesquisa]);


		$pedidos_count  = $pedidos->total();
		$pesquisa	    = $request->pesquisa;

 		return view('painel/pedidos/index', compact('pedidos', 'pedidos_count', 'pesquisa'));
	}

	public static function create() {

		// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}

    	// decifra os dados DO USUARIO(VENDEDOR)
    	$data          = explode('|', session()->get('userdata'));
    	$vendedor_nome = $data[0];
    	$vendedor_id   = $data[1];

		$pedido 				   = new Pedidos;
		$pedido->CNPJ_CLIFOR       = '00000000000000';
		$pedido->ID_VENDEDOR	   = $vendedor_id;
		$pedido->DATA_EMISSAO	   = date('Y-m-d');
		$pedido->PREVISAO_ENTREGA  = date('Y-m-d');
		$pedido->save();

		$id_pedido = $pedido->ID_PEDIDO;

		return view('painel/pedidos/create', compact('vendedor_nome', 'vendedor_id', 'id_pedido'));

	}

	public static function store(Request $request) {

		if (!$request->id_pedido) {

		}

		$pedido 				   = Pedidos::findOrFail($request->id_pedido);
		$pedido->CNPJ_CLIFOR       = $request->pesquisa_cliente;
		$pedido->ID_VENDEDOR	   = $request->id_vendedor;
		$pedido->DATA_EMISSAO	   = $request->edit_dataemissao;
		$pedido->PREVISAO_ENTREGA  = $request->edit_dataentrega;
		$pedido->CONDICAO_PAGTO	   = $request->edit_formapagto;
		$pedido->OBSERVACAO		   = $request->edit_obs;

		if ($pedido->save()) {
			return redirect()->route('pedidos')->with('cad_pedido_msg', 'Pedido cadastrado com sucesso!');
		} 	

		
		
	}

	public static function addItem(Request $request) {

		
		$item       			= new PedidosItens;
		$item->ID_PRODUTO 		= $request->id_produto;
		$item->ID_PEDIDO  		= $request->id_pedido;
		$item->TAMANHO    		= $request->tamanho;
		$item->PRECO_UNITARIO   = $request->preco;
		$item->QUANTIDADE       = $request->quantidade;
		$item->PRECO_TOTAL      = ($request->quantidade * $request->preco);
		
		if ( $item->save() ) {
			return $item->toJson();	
		} else {
			return 'Erro incluindo este produto!';
		}

		

	}

	
} // classe PedidosCONTROLLER