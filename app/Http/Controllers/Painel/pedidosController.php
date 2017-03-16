<?php 
  
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\Pedidos;
use App\Models\Produtos;
use App\Models\Clientes;
use App\Models\PrazoPagamentos;
use App\Models\TabelaPrecosItens;
use App\Models\PedidosItens;
use App\Models\Configuracoes;
use DB;
use Carbon\Carbon;

class PedidosController extends Controller 
{

	public static function index(Request $request) {

		// verifica LOGIN
		if ( !session()->has('userdata') ) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}


    	// decifra os dados DO USUARIO(VENDEDOR)
    	$data          = explode('|', session()->get('userdata'));
    	$vendedor_nome = $data[0];
    	$vendedor_id   = $data[1];	

    	// vai APAGAR os PEDIDOS que não foram concluidos
    	// FLG_CONCLUIDO = 0;
    	$delecao = Pedidos::where('FLG_CONCLUIDO', 0)
    	                  ->where('PEDIDOS.ID_VENDEDOR', $vendedor_id)
    	                  ->delete();

    	
    	//VAI LISTAR APENAS PEDIDOS DO VENDEDOR LOGADO NO SISTEMA
    	$pedidos = Pedidos::where('PEDIDOS.ID_VENDEDOR', $vendedor_id)
    	                  ->where('FLG_CONCLUIDO', 1)
    	                  ->orderBy('DATA_EMISSAO', 'DESC')
						  ->orderBy('ID_PEDIDO', 'DESC')    	                  
    	                  ->join('CLIENTES', 'CLIENTES.CNPJ' ,'=', 'PEDIDOS.CNPJ_CLIFOR')
    	                  ->join('PRAZO_PAGAMENTOS', 'PRAZO_PAGAMENTOS.ID_PRAZO', '=', 'PEDIDOS.ID_PRAZO')
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

									   ->orderBy('ORD')
									   ->get();

		return $tamanhos->toJson();

	}
	

	public static function getBuscaPedido(Request $request) {


    	// decifra os dados DO USUARIO(VENDEDOR)
    	$data          = explode('|', session()->get('userdata'));
    	$vendedor_nome = $data[0];
    	$vendedor_id   = $data[1];	


    	//VAI LISTAR APENAS PEDIDOS DO VENDEDOR LOGADO NO SISTEMA
    	$pedidos = Pedidos::where([['PEDIDOS.ID_VENDEDOR', '=', $vendedor_id ], 
    		                       ['ID_PEDIDO'  , 'LIKE', '%' . $request->pesquisa . '%']])
    	                  ->where('FLG_CONCLUIDO', 1)
    	                  ->orderBy('DATA_EMISSAO', 'DESC')
					   	  ->orderBy('ID_PEDIDO', 'DESC')    	                      	                  
    	                  ->join('CLIENTES', 'CLIENTES.CNPJ' ,'=', 'PEDIDOS.CNPJ_CLIFOR')
    	                  ->join('PRAZO_PAGAMENTOS', 'PRAZO_PAGAMENTOS.ID_PRAZO', '=', 'PEDIDOS.ID_PRAZO')
    	                  ->paginate(10)
    	                  ->appends(['pesquisa' => $request->pesquisa]);


		$pesquisa = $request->pesquisa;

 		return view('painel/pedidos/index', compact('pedidos', 'pesquisa'));
	}


	static function verificaItensPedido($id) {

		if (!$id) {
			return false;
		}

		return PedidosItens::where('ID_PEDIDO', $id)->count();

	}


	public static function create() {

		// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}

		// recebe as configuracoes para atribuições     	
    	$config = Configuracoes::findOrFail(1);

    	// monta o selectbox (combobox) com os prazos de pagamento
		$prazoPagto = PrazoPagamentos::pluck('DESCRICAO', 'ID_PRAZO');

    	// decifra os dados DO USUARIO(VENDEDOR)
    	$data          = explode('|', session()->get('userdata'));
    	$vendedor_nome = $data[0];
    	$vendedor_id   = $data[1];

		//insere um pedido DEFAULT para ter o ID 
		$pedido 				   = new Pedidos;
		$pedido->CNPJ_CLIFOR       = '00000000000000';
		$pedido->ID_VENDEDOR	   = $vendedor_id;
		$pedido->ID_PRAZO    	   = -1;
		$pedido->DATA_EMISSAO	   = date('Y-m-d');
		$pedido->PREVISAO_ENTREGA  = date('Y-m-d');
		$pedido->FLG_CONCLUIDO     = 0;
		$pedido->save();

		$id_pedido = $pedido->ID_PEDIDO;

		return view('painel/pedidos/create', compact('vendedor_nome', 'vendedor_id', 'id_pedido', 'prazoPagto', 'config'));

	}

	public static function store(Request $request) {

	
		// ANTES DE SALVAR, VERIFICA SE EXISTE ITENS, SE NÃO HOUVER, EXCLUI
		if (!PedidosController::verificaItensPedido($request->id_pedido)) {
			
			$pedido = Pedidos::findOrFail($request->id_pedido);
			$pedido->delete();

			return redirect()->route('pedidos');

		}

		$config = Configuracoes::findOrFail(1);

		$dt_emissao = \DateTime::createFromFormat('d/m/Y', $request->edit_dataemissao);
		$dt_entrega = \DateTime::createFromFormat('d/m/Y',  $request->edit_dataentrega );
		
		$pedido 				   = Pedidos::findOrFail($request->id_pedido);
		$pedido->CNPJ_CLIFOR       = $request->pesquisa_cliente;
		$pedido->ID_VENDEDOR	   = $request->id_vendedor;
		
		if ( $config->FLG_PRAZO_PAGTO_TABELA_EXTERNA == 1) {
  	  		$pedido->ID_PRAZO = $request->edit_prazopagto;
  	  	} else {
  	  		$pedido->PRAZO_PAGTO = $request->edit_prazopagto;
  	  	}

		$pedido->DATA_EMISSAO	   = $dt_emissao->format('Y-m-d');
		$pedido->PREVISAO_ENTREGA  = $dt_entrega->format('Y-m-d');
		$pedido->OBSERVACAO		   = $request->edit_obs;
		$pedido->FLG_CONCLUIDO	   = 1;

		if ($pedido->save()) {
			return redirect()->route('pedidos')->with('cad_pedido_msg', 'Pedido cadastrado com sucesso!');
		} 	
		
	}

	public static function delete($id) {

		//deleção de PEDIDO
		$pedido = Pedidos::where('ID_PEDIDO', $id)
		                 ->delete();

		return redirect()->route('pedidos')->with('cad_pedido_msg', 'Pedido excluído com sucesso!');

	}

	public static function addItem(Request $request) {

		
		$config = Configuracoes::findOrFail(1);

		$total     = 0;

		// SALVA ITENS DO AJAX VINDO EM MODO GRADE
		if ( $config->FLG_USA_GRADE_PEDIDO == 1 ) {

			$arr = $request->json();

			foreach ( $arr as $item_ped ) {

				
				if ( $item_ped['quantidade']  > 0 ) {
					//ADICIONA ITEM 
					$item       			= new PedidosItens;
					$item->ID_PRODUTO 		=   $item_ped[ 'id_produto' ];
					$item->ID_PEDIDO  		=   $item_ped[ 'id_pedido'  ];
					$item->TAMANHO    		=   $item_ped[ 'tamanho'    ];
					$item->PRECO_UNITARIO   =   $item_ped[ 'preco'      ];
					$item->QUANTIDADE       =   $item_ped[ 'quantidade' ];
					$item->PRECO_TOTAL      = ( $item_ped[ 'quantidade' ] * $item_ped[ 'preco' ] );
					
					$id_pedido = $item_ped[ 'id_pedido'  ];	
					$total     = ( $total + $item->PRECO_TOTAL );

					$item->save();
				}

			} 
	
			//se adicionar SOMA NO TOTAL DO PEDIDO
			$total_ped        = Pedidos::findOrFail( $id_pedido );
			$total_ped->TOTAL = ( $total_ped->TOTAL + $total) ;
			$total_ped->save();

			//FORMATANDO VALORES POR AQUI
			//adiciona o TOTAL do pedido no JSON
			array_add( $item, 'TOTAL_PEDIDO', number_format( $total_ped->TOTAL     , 2, ',', '.') );
	//		array_add( $item, 'TOTAL_ITEM'  , number_format( $item->PRECO_TOTAL    , 2, ',', '.') );
	//		array_add( $item, 'PRECO_UNT'   , number_format( $item->PRECO_UNITARIO , 2, ',', '.') );			

			
		} else {
		
			$it_arr = $request->json();

			//ADICIONA ITEM 
			$item       			= new PedidosItens;
			$item->ID_PRODUTO 		= $it_arr->get( 'id_produto' );
			$item->ID_PEDIDO  		= $it_arr->get( 'id_pedido'  );
			$item->TAMANHO    		= $it_arr->get( 'tamanho'    );
			$item->PRECO_UNITARIO   = $it_arr->get( 'preco'      );
			$item->QUANTIDADE       = $it_arr->get( 'quantidade' );
			$item->PRECO_TOTAL      = ( $it_arr->get( 'quantidade' ) * $it_arr->get( 'preco' ) );

			$id_pedido = $it_arr->get( 'id_pedido' );
			$total     = ( $total + $item->PRECO_TOTAL );

			$item->save();

			//se adicionar SOMA NO TOTAL DO PEDIDO
			$total_ped        = Pedidos::findOrFail( $id_pedido );
			$total_ped->TOTAL = ( $total_ped->TOTAL + $total) ;
			$total_ped->save();

			//FORMATANDO VALORES POR AQUI
			//adiciona o TOTAL do pedido no JSON
			array_add( $item, 'TOTAL_PEDIDO', number_format( $total_ped->TOTAL     , 2, ',', '.') );
			array_add( $item, 'TOTAL_ITEM'  , number_format( $item->PRECO_TOTAL    , 2, ',', '.') );
			array_add( $item, 'PRECO_UNT'   , number_format( $item->PRECO_UNITARIO , 2, ',', '.') );

		} // MODO SIMPLES (NAO GRADE)

			
		
		return $item->toJson();	
		

	}

	public static function pegaItensPedido($id) {

		
		//recebe dados das CONFIGURACOES PARA SABER se IMPRIME GRADE OU LISTA
		$config = Configuracoes::findOrFail(1);

		if ( $config->FLG_IMP_PEDIDO_GRADE == 1) 
			$modo_impressao = 'GRADE'; else
			$modo_impressao = 'LISTA';



		$itens = PedidosItens::where('ID_PEDIDO', $id)
							 ->join('PRODUTOS', 'PRODUTOS.ID_PRODUTO', '=', 'PEDIDOS_ITENS.ID_PRODUTO')
		                     ->get();

		// MODO GRADE                   
		if ( $modo_impressao == 'GRADE') {

			$produtos = [];
			$grade    = array(
				 '34' => 0,
				 '36' => 0,
				 '38' => 0,
				 '40' => 0,
				 '42' => 0,
				 '44' => 0,
				 '46' => 0,
				 '48' => 0,
				 '50' => 0,
				 '52' => 0,
				 '54' => 0,
				 '56' => 0,
				 '58' => 0,
				 '60' => 0,
				 '62' => 0
				);

			$tamanho = '';
			
			foreach($itens as $item){

				$produtos[$item->ID_PRODUTO]['ID_PRODUTO'] = $item->ID_PRODUTO;
				$produtos[$item->ID_PRODUTO]['ID_PEDIDO' ] = $item->ID_PEDIDO;
				$produtos[$item->ID_PRODUTO]['PRECO'	 ] = $item->PRECO_UNITARIO;
				$produtos[$item->ID_PRODUTO]['TOTAL' 	 ] = $item->PRECO_TOTAL;
				$produtos[$item->ID_PRODUTO]['MODELO'	 ] = $item->MODELO . ' ' . substr( $item->DESCRICAO, 0, 15);
				$produtos[$item->ID_PRODUTO]['QTD_TOTAL' ] = 0; // faz a conta na hora de mostrar na tela


				
				// Atribui a grade completa e vazia para o produto caso nao exista
				if (!isset($produtos[$item->ID_PRODUTO]['GRADE'])) {
					$produtos[$item->ID_PRODUTO]['GRADE'] = $grade;
				}
		
				// Atribui quantidades a grade (e soma caso exista 2 registros com o mesmo tamanho validar modelo se isso acontecera)
				if ($item->TAMANHO == 'P') {
					$tamanho = '56';
				} else 
					if ($item->TAMANHO == 'M') {
						$tamanho = '58';
					} else 
						if ($item->TAMANHO == 'G') {
							$tamanho = '60';
						} else 
							if ($item->TAMANHO == 'GG') {
								$tamanho = '62';
							} else
								$tamanho = $item->TAMANHO;


				$produtos[$item->ID_PRODUTO]['GRADE'][$tamanho] += $item->QUANTIDADE;

			}	

			return json_encode($produtos);

		} //MODO GRADE


		return $itens->toJson();	

	}



	public static function removeItem(Request $request) {

		//PK's
		$id_pedido  = $request->id_pedido;
		$id_produto = $request->id_produto;
		$tamanho    = $request->tamanho;

		try
		{ 
			// pega o valor deste registro
			$total = PedidosItens::where( 'ID_PEDIDO' , $id_pedido  )
			                     ->where( 'ID_PRODUTO', $id_produto )
			                     ->where( 'TAMANHO'   , $tamanho    )
			                     ->value( 'PRECO_TOTAL' );

			                     
			// procura pelo item e deleta
			$item = PedidosItens::where( 'ID_PEDIDO' , $id_pedido  )
			                    ->where( 'ID_PRODUTO', $id_produto )
			                    ->where( 'TAMANHO'   , $tamanho    )
			                    ->delete();

			
			//se remover SUBTRAI NO TOTAL DO PEDIDO
			$total_ped        = Pedidos::findOrFail($id_pedido);
			$total_ped->TOTAL = ( $total_ped->TOTAL - $total) ;
			$total_ped->save();
			
			return response( ['STATUS' => 'OK', 'TOTAL' => number_format( $total_ped->TOTAL , 2, ',', '.')] );

		} catch ( Exception $e ) {

			return response( ['STATUS' => 'ERRO', 'ERRO' => $e->getMessage()] );
		}

	}
		

	public static function show($id) {

    	// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}

    	// decifra os dados DO USUARIO(VENDEDOR)
    	$data          = explode('|', session()->get('userdata'));
    	$vendedor_nome = $data[0];

    	$config  = Configuracoes::findOrFail(1);
		
		$pedido  = Pedidos::findOrFail($id);

	 	// monta o selectbox (combobox) com os prazos de pagamento
		$prazoPagto = PrazoPagamentos::pluck('DESCRICAO', 'ID_PRAZO');

		// monta o array dos itens
		$itens   = PedidosItens::where('ID_PEDIDO', $id)
		                       ->join('PRODUTOS', 'PRODUTOS.ID_PRODUTO', '=', 'PEDIDOS_ITENS.ID_PRODUTO')
		                       ->get();
		
		$cliente = Clientes::where('CNPJ', $pedido->CNPJ_CLIFOR)
		                   ->first();


		//recebe dados das CONFIGURACOES PARA SABER se IMPRIME GRADE OU LISTA
		if ( $config->FLG_IMP_PEDIDO_GRADE == 1) 
			$modo_impressao = 'GRADE'; else
			$modo_impressao = 'LISTA';

		// MODO GRADE                   
		if ( $modo_impressao == 'GRADE') {

			$produtos = [];
			$grade    = array(
				 '34' => 0,
				 '36' => 0,
				 '38' => 0,
				 '40' => 0,
				 '42' => 0,
				 '44' => 0,
				 '46' => 0,
				 '48' => 0,
				 '50' => 0,
				 '52' => 0,
				 '54' => 0,
				 '56' => 0,
				 '58' => 0,
				 '60' => 0,
				 '62' => 0
				);

			$tamanho = '';
			
			foreach($itens as $item){

				$produtos[$item->ID_PRODUTO]['ID_PRODUTO'] = $item->ID_PRODUTO;
				$produtos[$item->ID_PRODUTO]['ID_PEDIDO' ] = $item->ID_PEDIDO;
				$produtos[$item->ID_PRODUTO]['PRECO'	 ] = $item->PRECO_UNITARIO;
				$produtos[$item->ID_PRODUTO]['TOTAL' 	 ] = $item->PRECO_TOTAL;
				$produtos[$item->ID_PRODUTO]['MODELO'	 ] = $item->MODELO . ' ' . substr( $item->DESCRICAO, 0, 15);
				$produtos[$item->ID_PRODUTO]['QTD_TOTAL' ] = 0; // faz a conta na hora de mostrar na tela


				
				// Atribui a grade completa e vazia para o produto caso nao exista
				if (!isset($produtos[$item->ID_PRODUTO]['GRADE'])) {
					$produtos[$item->ID_PRODUTO]['GRADE'] = $grade;
				}
		
				// Atribui quantidades a grade (e soma caso exista 2 registros com o mesmo tamanho validar modelo se isso acontecera)
				if ($item->TAMANHO == 'P') {
					$tamanho = '56';
				} else 
					if ($item->TAMANHO == 'M') {
						$tamanho = '58';
					} else 
						if ($item->TAMANHO == 'G') {
							$tamanho = '60';
						} else 
							if ($item->TAMANHO == 'GG') {
								$tamanho = '62';
							} else
								$tamanho = $item->TAMANHO;


				$produtos[$item->ID_PRODUTO]['GRADE'][$tamanho] += $item->QUANTIDADE;

			}	

			return view('painel/pedidos/show', compact('pedido', 'produtos', 'cliente', 'vendedor_nome', 'prazoPagto', 'config'));

		} //MODO GRADE







		return view('painel/pedidos/show', compact('pedido', 'itens', 'cliente', 'vendedor_nome', 'prazoPagto', 'config'));

	}


	public static function edit($id) {

		// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}

    	// decifra os dados DO USUARIO(VENDEDOR)
    	$data          = explode('|', session()->get('userdata'));
    	$vendedor_nome = $data[0];

		$config  = Configuracoes::findOrFail(1);
		
		$pedido  = Pedidos::findOrFail($id);

		// monta o selectbox (combobox) com os prazos de pagamento
		$prazoPagto = PrazoPagamentos::pluck('DESCRICAO', 'ID_PRAZO');
		
		//monta os itens 
		$itens   = PedidosItens::where('ID_PEDIDO', $id)
		                       ->join('PRODUTOS', 'PRODUTOS.ID_PRODUTO', '=', 'PEDIDOS_ITENS.ID_PRODUTO')
		                       ->get();
		
		$cliente = Clientes::where('CNPJ', $pedido->CNPJ_CLIFOR)
		                   ->first();

		
		//recebe dados das CONFIGURACOES PARA SABER se IMPRIME GRADE OU LISTA
		if ( $config->FLG_IMP_PEDIDO_GRADE == 1) 
			$modo_impressao = 'GRADE'; else
			$modo_impressao = 'LISTA';

		// MODO GRADE                   
		if ( $modo_impressao == 'GRADE') {

			$produtos = [];
			$grade    = array(
				 '34' => 0,
				 '36' => 0,
				 '38' => 0,
				 '40' => 0,
				 '42' => 0,
				 '44' => 0,
				 '46' => 0,
				 '48' => 0,
				 '50' => 0,
				 '52' => 0,
				 '54' => 0,
				 '56' => 0,
				 '58' => 0,
				 '60' => 0,
				 '62' => 0
				);

			$tamanho = '';
			
			foreach($itens as $item){

				$produtos[$item->ID_PRODUTO]['ID_PRODUTO'] = $item->ID_PRODUTO;
				$produtos[$item->ID_PRODUTO]['ID_PEDIDO' ] = $item->ID_PEDIDO;
				$produtos[$item->ID_PRODUTO]['PRECO'	 ] = $item->PRECO_UNITARIO;
				$produtos[$item->ID_PRODUTO]['TOTAL' 	 ] = $item->PRECO_TOTAL;
				$produtos[$item->ID_PRODUTO]['MODELO'	 ] = $item->MODELO . ' ' . substr( $item->DESCRICAO, 0, 15);
				$produtos[$item->ID_PRODUTO]['QTD_TOTAL' ] = 0; // faz a conta na hora de mostrar na tela


				
				// Atribui a grade completa e vazia para o produto caso nao exista
				if (!isset($produtos[$item->ID_PRODUTO]['GRADE'])) {
					$produtos[$item->ID_PRODUTO]['GRADE'] = $grade;
				}
		
				// Atribui quantidades a grade (e soma caso exista 2 registros com o mesmo tamanho validar modelo se isso acontecera)
				if ($item->TAMANHO == 'P') {
					$tamanho = '56';
				} else 
					if ($item->TAMANHO == 'M') {
						$tamanho = '58';
					} else 
						if ($item->TAMANHO == 'G') {
							$tamanho = '60';
						} else 
							if ($item->TAMANHO == 'GG') {
								$tamanho = '62';
							} else
								$tamanho = $item->TAMANHO;


				$produtos[$item->ID_PRODUTO]['GRADE'][$tamanho] += $item->QUANTIDADE;

			}	

			return view('painel/pedidos/edit', compact('pedido', 'produtos', 'cliente', 'vendedor_nome', 'prazoPagto', 'config'));

		} //MODO GRADE

		// MODO LISTA
		return view('painel/pedidos/edit', compact('pedido', 'itens', 'cliente', 'vendedor_nome', 'prazoPagto', 'config'));

	}

	public static function update(Request $request) {
		
		$config = Configuracoes::findOrFail(1);

		$dt_emissao = \DateTime::createFromFormat('d/m/Y', $request->edit_dataemissao);
		$dt_entrega = \DateTime::createFromFormat('d/m/Y',  $request->edit_dataentrega );
		
		$pedido 				   = Pedidos::findOrFail($request->id_pedido);
		$pedido->DATA_EMISSAO	   = $dt_emissao->format('Y-m-d');
		$pedido->PREVISAO_ENTREGA  = $dt_entrega->format('Y-m-d');
		
		if ( $config->FLG_PRAZO_PAGTO_TABELA_EXTERNA == 1) {
  	  		$pedido->ID_PRAZO = $request->edit_prazopagto;
  	  	} else {
  	  		$pedido->PRAZO_PAGTO = $request->edit_prazopagto;
  	  	}

		$pedido->OBSERVACAO		   = $request->edit_obs;
		$pedido->FLG_CONCLUIDO	   = 1;

		if ($pedido->save()) {
			return redirect()->route('pedidos')->with('cad_pedido_msg', 'Pedido atualizado com sucesso!');
		} 	
		
	}


	public static function print($id) {
		
		// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}

	
		//recebe dados das CONFIGURACOES PARA SABER se IMPRIME GRADE OU LISTA
		$config = Configuracoes::findOrFail(1);

		if ( $config->FLG_IMP_PEDIDO_GRADE == 1) 
			$modo_impressao = 'GRADE'; else
			$modo_impressao = 'LISTA';


		// ANTES DE IMPRIMIR, VERIFICA SE EXISTE ITENS, SE NÃO HOUVER, NEM IMPRIMI
		if (PedidosController::verificaItensPedido($id)) {

			// decifra os dados DO USUARIO(VENDEDOR)
	    	$data          = explode('|', session()->get('userdata'));
	    	$vendedor_nome = $data[0];

			$pedido  = Pedidos::findOrFail($id);


			// traz o prazo de pagamento 
			$prazoPagto = PrazoPagamentos::where('ID_PRAZO', $pedido->ID_PRAZO)->first();


			// traz os itens
			$itens = PedidosItens::where('ID_PEDIDO', $id)
			                     ->join('PRODUTOS', 'PRODUTOS.ID_PRODUTO', '=', 'PEDIDOS_ITENS.ID_PRODUTO')
			                     ->get();

			
			$cliente = Clientes::where('CNPJ', $pedido->CNPJ_CLIFOR)
			                   ->first();
				

			// MODO GRADE                   
 			if ( $modo_impressao == 'GRADE') {

				$produtos = [];
				$grade    = array(
					 '34' => 0,
					 '36' => 0,
					 '38' => 0,
					 '40' => 0,
					 '42' => 0,
					 '44' => 0,
					 '46' => 0,
					 '48' => 0,
					 '50' => 0,
					 '52' => 0,
					 '54' => 0,
					 '56' => 0,
					 '58' => 0,
					 '60' => 0,
					 '62' => 0
					);

				$tamanho    = '';
				
				foreach($itens as $item){


					$produtos[$item->ID_PRODUTO]['ID_PRODUTO'] = $item->ID_PRODUTO;
					$produtos[$item->ID_PRODUTO]['ID_PEDIDO' ] = $item->ID_PEDIDO;
					$produtos[$item->ID_PRODUTO]['PRECO'	 ] = $item->PRECO_UNITARIO;
					$produtos[$item->ID_PRODUTO]['TOTAL' 	 ] = $item->PRECO_TOTAL;
					$produtos[$item->ID_PRODUTO]['MODELO'	 ] = $item->MODELO . ' ' . substr( $item->DESCRICAO, 0, 5);
					$produtos[$item->ID_PRODUTO]['QTD_TOTAL' ] = 0; // faz a conta na hora de mostrar

					
					// Atribui a grade completa e vazia para o produto caso nao exista
					if (!isset($produtos[$item->ID_PRODUTO]['GRADE'])) {
						$produtos[$item->ID_PRODUTO]['GRADE'] = $grade;
					}
			
					// Atribui quantidades a grade (e soma caso exista 2 registros com o mesmo tamanho validar modelo se isso acontecera)
					if ($item->TAMANHO == 'P') {
						$tamanho = '56';
					} else 
						if ($item->TAMANHO == 'M') {
							$tamanho = '58';
						} else 
							if ($item->TAMANHO == 'G') {
								$tamanho = '60';
							} else 
								if ($item->TAMANHO == 'GG') {
									$tamanho = '62';
								} else
									$tamanho = $item->TAMANHO;


					$produtos[$item->ID_PRODUTO]['GRADE'][$tamanho] += $item->QUANTIDADE;

				}	
	
				return view('painel/pedidos/print', compact('pedido', 'produtos', 'cliente', 'vendedor_nome', 'prazoPagto', 'config'));

			} //MODO GRADE



			return view('painel/pedidos/print', compact('pedido', 'itens', 'cliente', 'vendedor_nome', 'prazoPagto', 'config'));

	
 		}


	} //print pedido

	
} // classe PedidosCONTROLLER