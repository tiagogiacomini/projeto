<?php 
  
namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades;

class AuthController extends Controller 
{

	public $usuario_nome;
	public $usuario_senha;
	public $falha_login = false;


	public static function showLogin(Request $request) {

		return view('login', compact('nome_usuario', 'senha_usuario', 'falha_login'));

	}


	public function postLogin(Request $request) {
	

		if (isset($request->edit_usuario )) {
	   		$usuario_nome = mb_strtoupper($request->edit_usuario);
		}
	
		if (isset($request->edit_password )) {
			$usuario_senha = $request->edit_password;
		}
		
		if (!is_null($usuario_nome)) {

			// faz o select do usuário
			$usuario = DB::select("select USUARIOS.NOME, USUARIOS.SENHA from USUARIOS where USUARIOS.NOME = '$usuario_nome'", [1]);

			// se não achar o usuário
			if (!$usuario) {

				$falha_login = true;
				return view('login', compact('nome_usuario', 'senha_usuario', 'falha_login'));

			}

			// se chegar aqui, achou o usuario, verifica chave do array do banco e atribui as senhas digitadas e do banco
			if (array_key_exists(0, $usuario)) {
		
				$senha_md5_usuario = md5($usuario_senha);
				$senha_md5_banco   = $usuario[0]->SENHA;

			} else {

				$falha_login = true;
				return view('login', compact('nome_usuario', 'senha_usuario', 'falha_login'));

			}
		
		// valida senhas
		if (isset($senha_md5_usuario) && (isset($senha_md5_banco))) 
			if (!empty($senha_md5_usuario) && (!empty($senha_md5_banco))) 
			    if (strtoupper($senha_md5_usuario) == strtoupper($senha_md5_banco)) {

			    	//passou no LOGIN

					$falha_login = false;


					return redirect()->route('home', [ 'user' => $usuario_nome ] );
   			    
						
				} else {

					$falha_login = true;
					return view('login', compact('nome_usuario', 'senha_usuario', 'falha_login'));
								
				}			
	
		}
	
		//$falha_login = false;
		//return redirect()->route('home');

	}		
	
} // classe AuthCONTROLLER