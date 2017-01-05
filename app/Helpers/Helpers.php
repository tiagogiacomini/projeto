<?php

namespace App\Helpers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Cookie;


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



}