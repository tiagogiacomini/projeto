<?php 
  
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\Clientes;
use App\Helpers ;
use DB;

class ClientesController extends Controller 
{

	
	public static function index(Request $request) {

		//limpa msg da sessão		
		if ($request->session()->has('status')) {
			$request->session()->forget('status');
		}	

		$clientes_count = Clientes::all()->count();
		$clientes       = Clientes::orderBy('CNPJ')->paginate(15);

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
	                        ->paginate(15)
	                        ->appends(['pesquisa' => $request->pesquisa]);

		$clientes_count = $clientes->count();
		$pesquisa	    = $request->pesquisa;

 		return view('painel/clientes/index', compact('clientes', 'clientes_count', 'pesquisa'));

	}


	public static function create() {

		return view('painel.clientes.create');
	
	}


	public static function store(Request $request) {


		//VALIDACAO
		if (empty($request->edit_cnpj)) {
			
			$request->session()->flash('cnpj_cliente', 'É obrigatório o preenchimento do CPF/CNPJ!');
			return view('painel/clientes/create');

		}

		if (empty($request->edit_razao)) {
			
			$request->session()->flash('razao_cliente', 'É obrigatório o preenchimento da NOME/RAZÃO SOCIAL!');
			return view('painel/clientes/create');
			
		}

		if (empty($request->edit_ierg)) {
			
			$request->session()->flash('ierg_cliente', 'É obrigatório o preenchimento da IE/RG!');
			return view('painel/clientes/create');
			
		}
		
		if (empty($request->edit_cep)) {
			
			$request->session()->flash('cep_cliente', 'É obrigatório o preenchimento do CEP!');
			return view('painel/clientes/create');
			
		}

		if ($request->session()->has('cnpj_cliente')) {
			$request->session()->forget('cnpj_cliente');
		}	

		if ($request->session()->has('razao_cliente')) {
			$request->session()->forget('razao_cliente');
		}	

  		if ($request->session()->has('ierg_cliente')) {
			$request->session()->forget('ierg_cliente');
		}	
		
		if ($request->session()->has('cep_cliente')) {
			$request->session()->forget('cep_cliente');
		}	


		$cliente                = new Clientes;
		$cliente->CNPJ          = $request->edit_cnpj;
		$cliente->RAZAO         = $request->edit_razao;
		$cliente->NOME_FANTASIA = $request->edit_nome;
		$cliente->IERG          = $request->edit_ierg;
		$cliente->ENDERECO	    = $request->edit_endereco;
		$cliente->BAIRRO 	    = $request->edit_bairro;		
		$cliente->CEP           = $request->edit_cep;
		$cliente->CIDADE        = $request->edit_cidade;
		$cliente->ESTADO        = $request->edit_estado;
		$cliente->TELEFONE      = $request->edit_telefone;			
		$cliente->save();


		if ($request->session()->has('origem_cad_cliente')) {
			if ($request->session()->get('origem_cad_cliente') == 'listagem') {
				return view('painel/clientes/busca?pesquisa='. $request->edit_cnpj) ;
			} else {
				return view('painel/produtos'); //teste somente não se asssute
			}
		}


	}

	
} // classe PainelCONTROLLER
