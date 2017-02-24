<?php

namespace App\Helpers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;


class Helpers extends Controller 
{

	// FAZ MASCARAS DE ACORDO COM O PARAMETRO PASSADO EM $mask
	// EXEMPLOS:
	/* 
		$cnpj = '17804682000198';
		echo Mask($cnpj, "##.###.###/####-##").'<BR>';

		$cpf = '21450479480';
		echo Mask("###.###.###-##",$cpf).'<BR>';

		$cep = '36970000';
		echo Mask("#####-###",$cep).'<BR>';

		$telefone = '3391922727';
		echo Mask("(##)####-####",$telefone).'<BR>';

		$data = '21072014';
		echo Mask("##/##/####",$data);
	*/
	public static function Mask($val, $mask){

		$maskared = '';
		$k        = 0;
		
		for ($i = 0; $i<=strlen($mask)-1; $i++) {
		 	
		 	if ($mask[$i] == '#') {
		 		if (isset($val[$k]))
		 		   $maskared .= $val[$k++];	
		 	
		 	} else {
		 	
		 	if (isset($mask[$i]))
		 		$maskared .= $mask[$i];
		 	}
		}
	
		return $maskared;

	}

	public static function getBrowser() {
		
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		
		if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {

			$browser_version = $matched[1];
			$browser 		 = 'IE';

		} elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
			
			$browser_version = $matched[1];
			$browser 	     = 'Opera';

		} elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
			
			$browser_version = $matched[1];
			$browser 	     = 'Firefox';

		} elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
			
			$browser_version = $matched[1];
			$browser 		 = 'Chrome';

		} elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
			
			$browser_version = $matched[1];
			$browser 		 = 'Safari';

		} else {
			// não reconhecido
			$browser_version = 0;
			$browser 		 = 'Desconhecido';
		}
		
		return $browser;

	}

}