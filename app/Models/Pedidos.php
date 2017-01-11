<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{


    protected $table      = 'PEDIDOS';
    public $incrementing  = true;
    public $timestamps    = false;
    protected $primaryKey = ('ID_PEDIDO');

    public function items() {

    	return $this->hasMany('App\Models\PedidosItens');
    	
    }

}