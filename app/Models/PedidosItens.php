<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidosItens extends Model
{


    protected $table      = 'PEDIDOS_ITENS';
    public $incrementing  = false;
    public $timestamps    = false;
    protected $primaryKey = array('ID_PEDIDO', 'ID_PRODUTO', 'TAMANHO');

    

}