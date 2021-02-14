<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DetallesAsignacion;
use Auth;
use Session;
use App\User;
use App\User_Nivel;

class DetallesAsignacionController extends Controller
{
	public function __construct(){
		date_default_timezone_set('America/Bogota');
	}


    public function index(){

    }


    public function store(Request $request){
    	//dd($request->all());
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

       //verificar que el usuario no tenga mas estados activos.
       $sql = DetallesAsignacion::where('id_user',$request->id_user)->where('estado',1)->select('*')->get();
       if(count($sql)==0){
       //	dd($sql);
       		$detalles = new DetallesAsignacion();
			$detalles->id_user = $request->id_user;
			$detalles->id_modulo = $request->id_modulo;
			$detalles->id_broker = Auth::user()->id;
			$detalles->id_estado = $request->id_estado;
			$detalles->fecha = $request->fecha;
			$detalles->hora = $hora.':'.$request->minuto;
			$detalles->hora_registro = $hora_registro;
			$detalles->observacion = $request->observacion;
			$detalles->save();
			

			$user = User::find($request->id_user);
			$user->id_estado = $request->id_estado;
			$user->save();
			Session::flash('success','<b>Mensaje! </b>Registro creado correctamente.');


	        $user = User::find($request->id_user);
	        $user->id_estado = $request->id_estado;
			$user->save();

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
			}
       }else{
       		Session::flash('error','<b>Advertencia! </b>Este usuario tiene tareas pendientes por atender. ');
       }


			
	

        //update use
    	//dd($request->all());

		
		


    	
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
