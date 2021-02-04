<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\TypeUser;
use Session;
use DB;
use App\Rol;
use App\AsignacionSeguimiento;
use Auth;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Matricula;


//use Illuminate\Http\Controllers\OrigenController;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */

    public $page = '';
    public $id_rol = '';


    public function __construct()
    {
       //America/Bogota
       date_default_timezone_set('America/Bogota');
       if(!empty($_REQUEST['page'])){
            $this->page = $_REQUEST['page'];
       }

    }





    public function get_rols(){
        $rols = Rol::where('id','!=','1')->where('id','!=','2')->select('*')->get();
        return $rols;
    }

    public function get_user_rols(){
            $users_rols = DB::table('rol as r')
            ->join('type_user as tu','tu.id_rol','r.id')
            ->where('tu.id_rol','!=','6')
            ->select('*')->get();
            return $users_rols;
    }


    public function get_nuevos_clientes(){
        if(Session::get('id_rol')== 2){//administrador
             $users = DB::table('users as u')
            ->join('type_user as tu','tu.id_user','=','u.id')
            ->join('rol as r','r.id','=','tu.id_rol')
            //->join('asignacion_seguimiento as as','as.id_broker','=','u.id')
            ->where('tu.id_rol','=','6')
            ->where('u.id_estado','=',11)
            ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg')->orderBy('U.id','DESC')->get();
           

        }else if(Session::get('id_rol')== 3 || Session::get('id_rol')== 4 || Session::get('id_rol')== 5){//admisiones
             $users = DB::table('users as u')
            ->join('type_user as tu','tu.id_user','=','u.id')
            ->join('rol as r','r.id','=','tu.id_rol')
            ->join('asignacion_seguimiento as as','as.id_user','=','u.id')
            ->where('tu.id_rol','=','6')
            ->where('u.id_estado','=',11)
            ->where('as.id_broker','=',Auth::user()->id)
            ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg')->orderBy('U.id','DESC')->get();
          // dd($users);
        }
        //dd($users);
        return $users;
    }

    public function get_brokers(){
       $users = DB::table('users as u')
        ->join('type_user as tu','tu.id_user','=','u.id')
        ->join('rol as r','r.id','=','tu.id_rol')
        ->where('tu.id_rol','!=','6')
        ->where('tu.id_rol','!=','1')
        ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg')->groupBy('u.id')->orderBy('u.id','DESC')->get();
//        dd($users);

        return $users;
    }


    public function get_all_users(){

             $users = DB::table('users as u')
            ->join('type_user as tu','tu.id_user','=','u.id')
            ->join('rol as r','r.id','=','tu.id_rol')
            ->join('estados as e','e.id','=','u.id_estado')
            //->join('asignacion_seguimiento as as','as.id_broker','=','u.id')
            ->where('tu.id_rol','!=','1')
            //->where('u.id_estado','=','1')
            ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg','e.tipo as estado')->orderBy('U.id','DESC')->get();
            //dd($users);
            return $users; 
    }


    public function get_tareas_dia(){
        //broker
        $fecha = date('Y-m-d');
            if(Session::get('id_rol')== 1 || Session::get('id_rol')== 2){
                $users = DB::table('users as u')
                ->join('type_user as tu','tu.id_user','=','u.id')
                ->join('rol as r','r.id','=','tu.id_rol')
                ->join('asignacion_seguimiento as as','as.id_user','=','u.id')
                ->join('detalles_asignacion as da','da.id_user','=','u.id')
                 ->join('estados as e','e.id','=','da.id_estado')
                ->where('tu.id_rol','=','6')
                ->where('u.id_estado','=','1')
                ->where('da.fecha','=',$fecha)
                ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();
            }else if(Session::get('id_rol')== 3 || Session::get('id_rol')== 4 || Session::get('id_rol')== 5){ //brokers
                $users = DB::table('users as u')
                ->join('type_user as tu','tu.id_user','=','u.id')
                ->join('rol as r','r.id','=','tu.id_rol')
                ->join('asignacion_seguimiento as as','as.id_user','=','u.id')
                ->join('detalles_asignacion as da','da.id_user','=','u.id')
                 ->join('estados as e','e.id','=','da.id_estado')
                ->where('tu.id_rol','=','6')
                ->where('u.id_estado','=','1')
                ->where('da.id_broker','=',Auth::user()->id)
                ->where('da.fecha','=',$fecha)
                ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();
            }
            
            
            //dd($users);
             return $users;

    }

    public function get_tareas_vencidas(){
        //broker
            $fecha_actual = date('Y-m-d');
             if(Session::get('id_rol')== 1 || Session::get('id_rol')== 2){
                 $users = DB::table('users as u')
                ->join('type_user as tu','tu.id_user','=','u.id')
                ->join('rol as r','r.id','=','tu.id_rol')
                ->join('asignacion_seguimiento as as','as.id_user','=','u.id')
                ->join('detalles_asignacion as da','da.id_user','=','u.id')
                 ->join('estados as e','e.id','=','da.id_estado')
                ->where('tu.id_rol','=','6')
                ->where('u.id_estado','=','1')
                ->where('da.fecha','<',$fecha_actual)
                ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();
             }else if(Session::get('id_rol')== 3 || Session::get('id_rol')== 4 || Session::get('id_rol')== 5){
                $users = DB::table('users as u')
                ->join('type_user as tu','tu.id_user','=','u.id')
                ->join('rol as r','r.id','=','tu.id_rol')
                ->join('asignacion_seguimiento as as','as.id_user','=','u.id')
                ->join('detalles_asignacion as da','da.id_user','=','u.id')
                 ->join('estados as e','e.id','=','da.id_estado')
                ->where('tu.id_rol','=','6')
                ->where('u.id_estado','=','1')
                ->where('da.id_broker','=',Auth::user()->id)
                ->where('da.fecha','<',$fecha_actual)
                ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();
             }

           
            //dd();
             return $users;

    }

    public function get_pendientes_facturacion(){//falta filtrar
        if(Session::get('id_rol')== 1 || Session::get('id_rol')== 2){
            $fecha_actual = date('Y-m-d');
            $users = DB::table('users as u')
            ->join('type_user as tu','tu.id_user','=','u.id')
            ->join('rol as r','r.id','=','tu.id_rol')
            ->join('asignacion_seguimiento as as','as.id_user','=','u.id')
            ->join('detalles_asignacion as da','da.id_user','=','u.id')
             ->join('estados as e','e.id','=','da.id_estado')
            ->where('tu.id_rol','=','6')
            ->where('u.id_estado','=','4')->where('da.id_estado','=','4')->where('da.estado','=','1')
            ->select('*','da.id as id_det_asig','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();

        }else if(Session::get('id_rol')== 3){
            $users = DB::table('users as u')
            ->join('detalles_asignacion as da','da.id_user','=','u.id')
            ->join('estados as e','e.id','=','u.id_estado')
            ->where('u.id_estado','=','4')->where('da.id_estado','=','4')->where('da.estado','=','1')
            ->where('da.id_broker','=',Auth::user()->id)
            ->select('*','da.id as id_det_asig','u.id as id_','da.created_at as fecha_registro','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();
            
        }
        //dd($users);
        return $users;

    }

    public function facturacion_pendiente_pago(){
        $fecha_actual = date('Y-m-d');
        if(Session::get('id_rol')== 1 || Session::get('id_rol')== 2){
            $users = DB::table('users as u')
            ->join('type_user as tu','tu.id_user','=','u.id')
            ->join('rol as r','r.id','=','tu.id_rol')
            ->join('asignacion_seguimiento as as','as.id_user','=','u.id')
            ->join('detalles_asignacion as da','da.id_user','=','u.id')
            ->join('factura as f','f.id_user','u.id')
            ->where('f.estado','=','no pagada')
            ->where('u.id_estado','=','4')->where('da.id_estado','=','4')
            ->select('*','da.id as id_det_asig','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();

        }else if(Session::get('id_rol')== 3){
           $users = DB::table('users as u')
            ->join('type_user as tu','tu.id_user','=','u.id')
            ->join('rol as r','r.id','=','tu.id_rol')
            ->join('asignacion_seguimiento as as','as.id_user','=','u.id')
            ->join('detalles_asignacion as da','da.id_user','=','u.id')
            ->join('factura as f','f.id_user','u.id')
            ->where('f.estado','=','no pagada')
            ->where('u.id_estado','=','4')->where('da.id_estado','=','4')
            ->where('da.id_broker','=',Auth::user()->id)
            ->select('*','da.id as id_det_asig','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();
            
        }
        //dd($users);
        return $users;
    }


    public function matriculados(){
         $users = DB::table('users as u')
        ->join('type_user as tu','tu.id_user','=','u.id')
        ->join('rol as r','r.id','=','tu.id_rol')
        ->join('asignacion_seguimiento as as','as.id_user','=','u.id')
        ->join('detalles_asignacion as da','da.id_user','=','u.id')
        ->join('matriculas as m','m.id_user','=','u.id')

        ->where('u.id_estado','=','6')->where('da.id_estado','=','6')
        ->select('*','da.id as id_det_asig','u.id as id_','r.tipo as rol','m.created_at as fecha_matricula','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();

        return $users;
    }




    public function index()
    {

        $users = new UsuarioController();
        if($this->page!=''){
            if($this->page=='all'){
                if(Session::get('id_rol')== 1 || Session::get('id_rol')== 2){
                    $users = $users->get_all_users();
                }else{
                    return redirect()->back();
                }
                
            }else if($this->page=='nuevos_clientes'){
                $users = $users->get_nuevos_clientes(); 
            }else if($this->page=='tareas_dia'){
                $users = $users->get_tareas_dia(); 
            }else if($this->page=='tareas_vencidas'){
                $users = $users->get_tareas_vencidas(); 
            }else if($this->page=='facturar'){
                $users = $users->get_pendientes_facturacion(); 
            }else if($this->page=='facturacion_pendiente_pago'){
                $users = $users->facturacion_pendiente_pago();
            }else if($this->page=='matriculados'){
                $users = $users->matriculados();
            }else if($this->page=='profile'){
                $tipos_documentos = new TipoDocumentoController();
                $tipos_documentos = $tipos_documentos->index();
                return view('auth.profile',compact('tipos_documentos'));
            }else if($this->page=='permisos'){
                $rols = $this->get_rols();
                $brokers = $this->get_brokers();
                $users_rols = $this->get_user_rols();

                //dd($users_rols);
                return view('app.permiso.index',compact('rols','brokers','users_rols'));
            }
        }
        
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
        set_time_limit(0);
         $hora = date("H:i:s");
        
        if($request->file('file')){
            Excel::import(new UsersImport, $request->file('file'));
            Session::flash('success','<b>Mensaje!</b> Listado de usuarios importado correctamente.');
        }else{
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

            //asignacion
            if($request->id_broker){
                $asignacion = new AsignacionSeguimiento();
                $asignacion->id_user = $id_user;
                $asignacion->id_broker = $request->id_broker;
                $asignacion->hora = $hora;
                $asignacion->save();   
            }
            Session::flash('success','<b>Mensaje!</b> usuario creado correctamente');
        }

            
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $app = new AppController();
        $id = $app->decode64($id);


        $user = DB::table('users as u')
        ->join('type_user as tu','tu.id_user','=','u.id')
        ->join('rol as r','r.id','=','tu.id_rol')
        ->where('u.id','=',$id)
        ->select('*','u.id as id_','r.tipo as rol','u.created_at as fecha_registro','u.hora as hora_reg')->get();
        $user = $user[0];


        

        $tipos_documentos = new TipoDocumentoController();
        $tipos_documentos = $tipos_documentos->index();


        //
        $users = new UsuarioController();
        $users = $users->get_brokers();



        //
        $estadoCont = new EstadoController();
        $estados = $estadoCont->get_estados();


        //
        $detallesAsgCont = new DetallesAsignacionController();
        $detalles = $detallesAsgCont->detalles($user->id_user);


        //


        if($this->page!=''){
            if($this->page=='all' || $this->page=='nuevos_clientes' || $this->page=='tareas_dia' || $this->page=='tareas_vencidas'){
                return view('app.asignacion.detalles',compact('user','tipos_documentos','users','estados','detalles'));
            }else if($this->page=='facturar'){
                $facturasCont = new FacturaController();
                $facturas = $facturasCont->get_facturas_user($id);
               return view('app.asignacion.detalles',compact('user','tipos_documentos','users','estados','detalles','facturas'));
            }else if($this->page=='matriculados'){
                //dd($users);
                $matricula = Matricula::where('id_user','=',$user->id_user)->where('estado','=',1)->select('*')->get()->last();
               // dd($);

                return view('app.asignacion.detalles',compact('user','tipos_documentos','users','estados','detalles','matricula'));
            }
        }


        
    }

    public function update(Request $request, $id)
    {

           

            if($request->page=='permisos'){//via ajax

                if($request->estado==1){
                    $sql = TypeUser::where('id_user','=',$request->id_rol)->where('id_rol','=',$request->id_rol)->select('*')->get();
                    if(count($sql)==0){
                         $user_type = new TypeUser();
                        $user_type->id_user = $request->id_user;
                        $user_type->id_rol = $request->id_rol;
                        $user_type->save();
                    }
                }else if($request->estado==2){

                        $sql = TypeUser::where('id_user','=',$request->id_user)->where('id_rol','=',$request->id_rol)->select('*')->get()->last();
                       
                        if($sql){
                            $user_type = TypeUser::find($sql->id);
                            $user_type->delete();
                        }
                }

                return 'success';
            }else if($request->page=='bloqueo'){
                $user = User::find($request->id_user);
                $user->estado = $request->estado;
                $user->save();
                return 'success';
            }else{
                 $usuario = User::find($id);
                $usuario->id_tipo_documento = $request->id_tipo_documento;
                $usuario->nombres = $request->nombres;
                $usuario->apellidos = $request->apellidos;
                $usuario->documento = $request->documento;
                $usuario->direccion = $request->direccion;
                $usuario->telefono = $request->telefono;
                $usuario->email = $request->email;
                $usuario->fecha_nacimiento = $request->fecha_nacimiento;
                $usuario->save();
                

                if($request->page){
                    $page = $request->page;
                    if($page=='matriculados'){
                        $matricula = Matricula::find($request->id_matricula);
                        $matricula->id_broker = $request->id_broker;
                        $matricula->save();
                    }
                }
            }



            Session::flash('success','<b>Mensaje!</b> usuario actualizado correctamente');
            return redirect()->back();
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
