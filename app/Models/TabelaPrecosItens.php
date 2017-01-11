<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabelaPrecosItens extends Model
{

	public $timestamps    = false;
	public $incrementing  = false;
    protected $table      = 'TABELA_PRECO_ITENS';
    protected $primaryKey = array('ID_TABELA', 'ID_PRODUTO', 'TAMANHO');
}