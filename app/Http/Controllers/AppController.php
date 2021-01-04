<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado;

class AppController extends Controller
{
    public function index(){
    	return view('app.dashboard.index');
    }

    public function decode64($cadena){
    	$resultado = base64_decode($cadena);
    	return $resultado;
    }

    
}
