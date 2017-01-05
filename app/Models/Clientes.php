<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{

	public $timestamps    = false;
	public $incrementing  = false;
    protected $table      = 'CLIENTES';
    protected $primaryKey = ('CNPJ');
}