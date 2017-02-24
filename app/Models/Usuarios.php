<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{

	public $timestamps    = false;
	public $incrementing  = false;
    protected $table      = 'USUARIOS';
    protected $primaryKey = ('ID_USUARIO');
}