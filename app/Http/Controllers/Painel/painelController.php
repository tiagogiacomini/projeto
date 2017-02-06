<?php 
  
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\CEP;
use App\Models\Clientes;



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
	
} // classe PainelCONTROLLER