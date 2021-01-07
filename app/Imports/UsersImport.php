<?php

namespace App\Imports;

use App\User;
use DB;
use App\TypeUser;
use App\AsignacionSeguimiento;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */

    public function __construct()
    {
       //America/Bogota
       date_default_timezone_set('America/Bogota');
    }


    public function model(array $row)
    {

           $hora = date("H:i:s");
           $id_broker = '';
           $usuario = new User();
           
            $origen = DB::table('origen')->where('tipo','like','%'.$row['origen'].'%')->get();
            $tipo_docoumento = DB::table('tipo_documento')->where('sigla','=',$row['tipo_documento'])->get();
            $broker = User::where('documento','=',$row['documento_broker'])->select('*')->get();
            $verificar_user = User::where('documento','=',$row['documento'])->select('*')->get();

            if(count($verificar_user)==0){
                if(count($origen)>0){
                  $usuario->id_origen = $origen[0]->id;
                }
                if(count($tipo_docoumento)>0){
                  $usuario->id_tipo_documento = $tipo_docoumento[0]->id;
                }

                if(count($broker)>0){
                  $id_broker = $broker[0]->id;
                }

                $usuario->nombres = $row['nombres'];
                $usuario->apellidos = $row['apellidos'];
                $usuario->documento = $row['documento'];
                $usuario->direccion = $row['direccion'];
                $usuario->telefono = $row['telefono'];
                $usuario->email = $row['correo'];
                $usuario->password = Hash::make($row['documento']);
                $usuario->hora = $hora;
                $usuario->save();
                
                 
                
                
                
               

                $id_user =  $usuario->id;
                $user_type = new TypeUser();
                $user_type->id_user = $id_user;
                $user_type->id_rol = 6;
                $user_type->save();

                //asignacion
                if($id_broker!=''){
                    $asignacion = new AsignacionSeguimiento();
                    $asignacion->id_user = $id_user;
                    $asignacion->id_broker = $id_broker;
                    $asignacion->hora = $hora;
                    $asignacion->save();   
                }
            }
    }
}  