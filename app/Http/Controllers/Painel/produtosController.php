<?php 
  
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\Produtos;

class ProdutosController extends Controller 
{

	
	public static function getProdutos(Request $request) {

		
		
		if (!empty($request->user)) {
			$user = $request->user;
		}


		$produtos_count = Produtos::all()->count();
		$produtos = Produtos::orderBy('MODELO')->get();

			//$produtos = DB::select('select PRODUTOS.MODELO, PRODUTOS.DESCRICAO from PRODUTOS', [1])->paginate(25);


	//	$data = $request->session()->all();
	//	dd($data);

		return view('painel/produtos', compact('user', 'produtos', 'produtos_count'));

		
	}


	
} // classe PainelCONTROLLER