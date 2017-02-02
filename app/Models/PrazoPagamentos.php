<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrazoPagamentos extends Model
{

	public $timestamps    = false;
	public $incrementing  = false;
    protected $table      = 'PRAZO_PAGAMENTOS';
    protected $primaryKey = ('ID_PRAZO');
}