<?php 
  
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\Clientes;
use App\Models\TabelaPrecos;
use App\Helpers;
use DB;

class ClientesController extends Controller 
{

	public static function index(Request $request) {

		// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}


		//limpa msg da sessão		
		if ($request->session()->has('status')) {
			$request->session()->forget('status');
		}	

		$clientes       = Clientes::orderBy('CNPJ')
								  ->paginate(10);
		$clientes_count = $clientes->total();


		return view('painel/clientes/index', compact('clientes', 'clientes_count'));
		
	}


	public static function getBuscaCliente(Request $request) {

		//limpa msg da sessão
		if ($request->session()->has('msg_pesquisa')) {
			$request->session()->forget('msg_pesquisa');
		}	

		//se existir a pesquisa e digitado menos que 5 letras
		if ((strlen($request->pesquisa) < 5 ) && (!empty($request->pesquisa))) {

   		 	$request->session()->flash('msg_pesquisa', 'Para agilizar a pesquisa informe no mínimo 5 caracteres!');
 			
 			return view('painel/clientes/index');

		}

		// passsou dos 5 chars e do campo vazio
	    $clientes = Clientes::where('RAZAO', 'like', '%' . $request->pesquisa .'%')
	                        ->orWhere('CNPJ', 'like', '%' . $request->pesquisa .'%' )
	                        ->orderBy('CNPJ')
	                        ->paginate(10)
	                        ->appends(['pesquisa' => $request->pesquisa]);

		$clientes_count = $clientes->total();
		$pesquisa	    = $request->pesquisa;

 		return view('painel/clientes/index', compact('clientes', 'clientes_count', 'pesquisa'));

	}


	public static function create() {

		// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}


		$tabelaPrecos = TabelaPrecos::pluck('DESCRICAO', 'ID_TABELA');

		return view('painel/clientes/create', compact('cliente', 'tabelaPrecos'));
	
	}

	public static function show($cnpj) {

		// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}


		$cliente      = Clientes::findOrFail($cnpj);
		$tabelaPrecos = TabelaPrecos::pluck('DESCRICAO', 'ID_TABELA');
		
		return view('painel/clientes/show', compact('cliente', 'tabelaPrecos'));
	
	}

	public static function edit($cnpj) {
		
		// verifica LOGIN
		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}

		$cliente      = Clientes::findOrFail($cnpj);
		$tabelaPrecos = TabelaPrecos::pluck('DESCRICAO', 'ID_TABELA');

		return view('painel/clientes/edit', compact('cliente', 'tabelaPrecos'));
	
	}

	public static function update(Request $request, $cnpj) {


		$cliente = Clientes::findOrFail($cnpj);

	//	dd($request);

		try  {

			$cliente->CNPJ          = $request->edit_cnpj;
			$cliente->RAZAO         = mb_strtoupper($request->edit_razao);
			$cliente->NOME_FANTASIA = mb_strtoupper($request->edit_nome);
			$cliente->IERG          = $request->edit_ierg;
			$cliente->ENDERECO	    = mb_strtoupper($request->edit_endereco);
			$cliente->NUMERO	    = $request->edit_numero;
			$cliente->BAIRRO 	    = mb_strtoupper($request->edit_bairro);		
			$cliente->CEP           = $request->edit_cep;
			$cliente->CIDADE        = mb_strtoupper($request->edit_cidade);
			$cliente->ESTADO        = mb_strtoupper($request->edit_estado);
			$cliente->TELEFONE      = $request->edit_telefone;			
			$cliente->PFPJ 			= mb_strtoupper($request->edit_tipopessoa);
			$cliente->ID_TABELA		= $request->edit_tabpreco;			

			$cliente->save();

		
			return redirect()->route('clientes')->with('cad_cliente_msg', 'Cliente editado com sucesso!');

		}
		
		catch(Exception $e) {

			return redirect()->route('clientes')->with('cad_cliente_msg', $e->getMessage());			

		}

	}


	
	public static function store(Request $request) {


		try {


			$cliente                = new Clientes;
			$cliente->CNPJ          = $request->edit_cnpj;
			$cliente->RAZAO         = mb_strtoupper($request->edit_razao);
			$cliente->NOME_FANTASIA = mb_strtoupper($request->edit_nome);
			$cliente->IERG          = $request->edit_ierg;
			$cliente->ENDERECO	    = mb_strtoupper($request->edit_endereco);
			$cliente->NUMERO	    = $request->edit_numero;
			$cliente->BAIRRO 	    = mb_strtoupper($request->edit_bairro);		
			$cliente->CEP           = $request->edit_cep;
			$cliente->CIDADE        = mb_strtoupper($request->edit_cidade);
			$cliente->ESTADO        = mb_strtoupper($request->edit_estado);
			$cliente->TELEFONE      = $request->edit_telefone;			
			$cliente->PFPJ 			= mb_strtoupper($request->edit_tipopessoa);
			$cliente->ID_TABELA		= $request->edit_tabpreco;			
		
			$cliente->save();
			
		
			return redirect()->route('clientes')->with('cad_cliente_msg', 'Cliente cadastrado com sucesso!');

		}
		
		catch(Exception $e) {

			return redirect()->route('clientes')->with('cad_cliente_msg', $e->getMessage());			

		}


	}


	public static function listClientes() {

		$clientes = Clientes::all();
		return $clientes->toJson();

	}

	
} // classe PainelCONTROLLER
