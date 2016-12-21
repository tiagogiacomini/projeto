<?php 
  
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\Produtos;

class ProdutosController extends Controller 
{

	
	public static function index(Request $request) {

		if (!empty($request->user)) {
			$user = $request->user;
		}

		
		$produtos 		= Produtos::orderBy('DESCRICAO')->paginate(10);
		$produtos_count = $produtos->total();

		return view('painel/produtos/index', compact('user', 'produtos', 'produtos_count'));
		
	}

	public static function getBuscaProduto(Request $request) {

		//limpa msg da sessão
		if ($request->session()->has('msg_pesquisa')) {
			$request->session()->forget('msg_pesquisa');
		}	

		//se existir a pesquisa e digitado menos que 5 letras
		if ((strlen($request->pesquisa) < 5 ) && (!empty($request->pesquisa))) {

   		 	$request->session()->flash('msg_pesquisa', 'Para agilizar a pesquisa informe no mínimo 5 caracteres!');
 			
 			return view('painel/produtos/index');

		}

		// passsou dos 5 chars e do campo vazio
	    $produtos = Produtos::where('DESCRICAO', 'like', '%' . $request->pesquisa .'%')
	                        ->orWhere('MODELO', 'like', '%' . $request->pesquisa .'%' )
	                        ->orderBy('DESCRICAO')
	                        ->paginate(10)
	                        ->appends(['pesquisa' => $request->pesquisa]);

		$produtos_count = $produtos->total();
		$pesquisa	    = $request->pesquisa;

 		return view('painel/produtos/index', compact('produtos', 'produtos_count', 'pesquisa'));

	}

} // classe PainelCONTROLLER