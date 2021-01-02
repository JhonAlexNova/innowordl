<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\TypeUser;
use Session;
use DB;
USE App\Rol;

//use Illuminate\Http\Controllers\OrigenController;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */



    public function __construct()
    {
       //America/Bogota
       date_default_timezone_set('America/Bogota');
    }


    public function get_rols(){
        $rols = Rol::where('id','!=','1')->where('id','!=','2')->select('*')->get();
        return $rols;
    }


    public function get_nuevos_clientes(){

        if(Session::get('id_rol')==2){//administrador
             $users = DB::table('users as u')
            ->join('type_user as tu','tu.id_user','=','u.id')
            ->join('rol as r','r.id','=','tu.id_rol')
            ->where('tu.id_rol','=','6')
            ->where('u.estado','=','1')
            ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg')->orderBy('U.id','DESC')->get(); 
        }
        return $users;
    }

    public function get_brokers(){
       $users = DB::table('users as u')
        ->join('type_user as tu','tu.id_user','=','u.id')
        ->join('rol as r','r.id','=','tu.id_rol')
        ->where('tu.id_rol','!=','6')
        ->where('tu.id_rol','!=','1')
        ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg')->orderBy('U.id','DESC')->get();

        return $users;
    }




    public function index()
    {
        $users = new UsuarioController();
        $users = $users->get_nuevos_clientes();
        return view('app.usuario.index',compact('users'));
    }


    public function create()
    {
        $fuentes = new OrigenController();
        $fuentes = $fuentes->index();

        $departamentos = new DepartamentoController();
        $departamentos = $departamentos->index();

        $tipos_documentos = new TipoDocumentoController();
        $tipos_documentos = $tipos_documentos->index();

        $rols = new UsuarioController();
        $rols = $rols->get_rols();

        $users = new UsuarioController();
        $users = $users->get_brokers();

        return view('app.usuario.create',compact('fuentes','departamentos','tipos_documentos','rols','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
         $hora = date("H:i:s");

        $usuario = new User();
        $usuario->id_origen = $request->id_origen;
        $usuario->id_tipo_documento = $request->id_tipo_documento;
        $usuario->id_ciudad = $request->id_ciudad;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->documento = $request->documento;
        $usuario->direccion = $request->direccion;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->documento);
        $usuario->hora = $hora;
        $usuario->save();

        $id_user =  $usuario->id;

        $user_type = new TypeUser();
        $user_type->id_user = $id_user;
        $user_type->id_rol = $request->id_rol;
        $user_type->save();




        Session::flash('success','Registro creado correctamente.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
