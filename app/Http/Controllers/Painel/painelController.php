<?php 
  
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\CEP;
use App\Models\Clientes;
use App\Models\Configuracoes;



class PainelController extends Controller 
{

	public static function getPainel(Request $request) {

		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}

		return view('painel/index');  

	}


	public static function buscaCEP($cep) {

				
		$resultado = CEP::where('CEP.CEP', addslashes($cep))
		                ->join('CIDADES', 'CIDADES.ID_CIDADE', '=' , 'CEP.ID_CIDADE')
		                ->first();

		return $resultado->toJson();

	}

	public static function buscaCliente($pesquisa) {

		$resultado = Clientes::where('CNPJ', addslashes($pesquisa))		                    
		                     ->first();



		return $resultado->toJson();

	}

	public static function config() {


		if (!session()->has('userdata')) {
			return redirect()->route('login')->with('msg_login', 'É necessário efetuar o login para continuar!');
    	}

		

		$config = Configuracoes::findOrFail(1);
		
		return view('painel/config/edit', compact('config'));

	}

	public static function storeConfig(Request $request) {


		$config = Configuracoes::findOrFail(1);


		if (isset($request->flag_pedido_grade)) {

			$config->FLG_IMP_PEDIDO_GRADE = 1;

		} else {

			$config->FLG_IMP_PEDIDO_GRADE = 0;			

		}

		if (isset($request->flag_pedido_tam_modo_lista)) {

			$config->FLG_IMP_TAM_MODO_LISTA = 1;

		} else {

			$config->FLG_IMP_TAM_MODO_LISTA = 0;			

		}



		$config->save();


		return redirect()->route('home');


	}
	 
} // classe PainelCONTROLLER'