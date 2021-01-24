<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresaController extends Controller
{
    public function get_empresa(){
    	$empresa = Empresa::get()->last();
    	return $empresa;
    }
}
