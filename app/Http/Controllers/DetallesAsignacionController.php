<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DetallesAsignacion;
use Auth;
use Session;
use App\User;
use App\User_Nivel;
use App\Integrantes_Grupos;

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

	/*	$users = DB::table('users as u')
       ->join('detalles_asignacion as da','da.id_user','=','u.id')
       ->join('matriculas as m','m.id_user','=','u.id')
       ->where('da.id_user','=',$request->id_user)
       ->select('*','da.id as id_det_asig','u.id as id_','m.created_at as fecha_matricula','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();
	 */
		
	

        //update use
    	//dd($request->all());
        $user = User::find($request->id_user);
        $user->id_estado = $request->id_estado;
		$user->save();
		if($request->estado_etapa == "4"){
			if($request->id_nivel){
				$user = DB::table('users as u')
				->join('user_nivel as un','un.id_user','=','u.id')
				->where('u.id','=',$request->id_user)
				->select('*','u.id as id_','u.created_at as fecha_registro','u.hora as hora_reg')->get();
				
				//dd($request->id_nivel);
				$count = 0;
				foreach	($user as $use){
					if($use->id_nivel == $request->id_nivel){
						$count = $count + 1;
					}
				}
				if($count == 0){
					$nivel = new User_Nivel();
					$nivel->id_user = $request->id_user;
					$nivel->id_nivel = $request->id_nivel;
					$nivel->save();
				}
				if($request->id_grupo){
					$integrantes = new Integrantes_Grupos();
					$integrantes->id_estado = $request->id_estado;
					$integrantes->id_grupo = $request->id_grupo;
					$integrantes->id_user = $request->id_user;
					$integrantes->id_broker = Auth::user()->id;  
					$integrantes->id_nivel = $request->id_nivel;
					$integrantes->estado = 'En proceso';
					$integrantes->save();

					$user = User::find($request->id_user);
					$user->id_estado = '19';
					$user->save();
					
				}else{
					$detalles = new DetallesAsignacion();
					$detalles->id_user = $request->id_user;
					$detalles->id_broker = Auth::user()->id;
					$detalles->id_estado = 18;
					$detalles->fecha = $request->fecha;
					$detalles->hora = $hora.':'.$request->minuto;
					$detalles->hora_registro = $hora_registro;
					$detalles->observacion = $request->observacion;
					$detalles->save();	

					$user = User::find($request->id_user);
					$user->id_estado = 18;
					$user->save();
				}
				
			}
		} else{
			$detalles = new DetallesAsignacion();
			$detalles->id_user = $request->id_user;
			$detalles->id_broker = Auth::user()->id;
			$detalles->id_estado = $request->id_estado;
			$detalles->fecha = $request->fecha;
			$detalles->hora = $hora.':'.$request->minuto;
			$detalles->hora_registro = $hora_registro;
			$detalles->observacion = $request->observacion;
			$detalles->save();
		}


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
