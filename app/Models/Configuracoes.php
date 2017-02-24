<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracoes extends Model
{

	public $timestamps    = false;
	public $incrementing  = false;
    protected $table      = 'CONFIGURACOES';
    protected $primaryKey = ('ID_CONFIG');
}