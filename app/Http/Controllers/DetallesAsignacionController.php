<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DetallesAsignacion;
use Auth;
use Session;
use App\User;

class DetallesAsignacionController extends Controller
{
	public function __construct(){
		date_default_timezone_set('America/Bogota');
	}


    public function index(){

    }


    public function store(Request $request){
    	$hora_registro = date('H:i:s');
    	$hora = $request->hora;
    	if($hora<12){
    		$hora = '0'.$hora;
    	}


    	$detalles = new DetallesAsignacion();
    	$detalles->id_user = $request->id_user;
    	$detalles->id_broker = Auth::user()->id;
    	$detalles->id_estado = $request->id_estado;
    	$detalles->fecha = $request->fecha;
    	$detalles->hora = $hora.':'.$request->minuto;
    	$detalles->hora_registro = $hora_registro;
    	$detalles->observacion = $request->observacion;
    	$detalles->save();

        //update use
    	//dd($request->all());

        $user = User::find($request->id_user);
        $user->id_estado = $request->id_estado;
        $user->save();

    	Session::flash('success','<b>Mensaje! </b>Registro creado correctamente.');
    	return redirect()->back();
    }


    public function detalles($id_user){
    	$detalles = DB::table('detalles_asignacion as da')
    	->join('estados as e','e.id','=','da.id_estado')
    	->join('users as u','u.id','=','da.id_broker')
    	->where('da.id_user',"=",$id_user)->select('*','e.tipo as estado')->orderBy('da.id','DESC')->get();
    	return $detalles;
    }



}
