<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabelaPrecos extends Model
{

	public $timestamps    = false;
	public $incrementing  = false;
    protected $table      = 'TABELA_PRECOS';
    protected $primaryKey = ('ID_TABELA');
}