<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\IntegrantesGrupo;
use App\Estado;
use App\EstadoModulo;
use App\DetallesAsignacion;
use Auth;
use DB;

class CarteraController extends Controller
{
    public $page;

    public function __construct(){
        date_default_timezone_set('America/Bogota');

        if(!empty($_REQUEST['page'])){
            $this->page = $_REQUEST['page'];
        }
    }



    public function index()
    {

        if($this->page=='recompra'){
            $integrantes_grupos = $this->users_check_recompra();
            return view('app.cartera.recompra',compact('integrantes_grupos'));
        }else if($this->page=='tareas_dia'){
            $tareas_dia = $this->tareas_dias();
            return view('app.cartera.tareas_dia',compact('tareas_dia'));
        }else if($this->page=='tareas_vencidas'){
            $tareas_vencidas = $this->tareas_vencidas();
            return view('app.cartera.tareas_vencidas',compact('tareas_vencidas'));
        }else if($this->page=='facturar'){
            $users = $this->facturar();
            return view('app.cartera.facturar',compact('users'));
        }else if($this->page=='facturacion_pendiente_pago'){
            $users = $this->pendientes_pago();
            return view('app.cartera.pendientes_pago',compact('users'));
        }
    }


    public function facturar(){
        //pendientes 
        $users = DB::table('users as u')
            ->join('detalles_asignacion as da','da.id_user','=','u.id')
            ->join('estados as e','e.id','=','u.id_estado')
            ->where('u.id_estado','=','14')->where('da.id_estado','=','14')->where('da.estado','=','1')
            ->where('da.id_broker','=',Auth::user()->id)
            ->select('*','da.id as id_det_asig','u.id as id_','da.created_at as fecha_registro','u.hora as hora_reg','da.fecha as fecha_evento','da.hora as hora_evento')->get();
            //dd($users);

            return $users;
    }

    public function pendientes_pago(){
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

            //dd($users);
            return $users;
    }


    public function users_check_recompra(){ //usuarios faltando 5 dias para el vencimiento de la factura y nivel
        $fecha_actual = date('Y-m-d');
        $date_future = strtotime('+5 day', strtotime($fecha_actual));
        $fecha_futuro = date('Y-m-d', $date_future);

        $consulta_update  = IntegrantesGrupo::with('users')->whereBetween('fecha_fin',[$fecha_actual, $fecha_futuro])->where('estado','En proceso')->get();
        //
        foreach ($consulta_update as $key => $value) {
            $user = IntegrantesGrupo::find($value->id);
            $user->estado = 'preventa';
            $user->id_estado = 14;
            $user->save();
        }
        $integrantes_grupos =  IntegrantesGrupo::with('users')->whereBetween('fecha_fin',[$fecha_actual, $fecha_futuro])->where('estado','preventa')->where('id_estado',14)->get();

        return $integrantes_grupos; 
    }


    public function  tareas_vencidas(){

        $tareas_vencidas = DetallesAsignacion::with(['users'])
        ->where('id_modulo',5)
        ->where('estado',1)
        ->where('id_broker',Auth::user()->id)
        ->where('fecha','<',date('Y-m-d'))
        ->where('id_estado','!=',13)->where('id_estado','!=',14)->where('id_estado','!=',5) 
        ->get();
        return $tareas_vencidas;
    }


    public function tareas_dias(){
        $tareas_dia = DetallesAsignacion::with(['users'])
        ->where('id_modulo',5)
        ->where('estado',1)
        ->where('id_estado','!=',13)->where('id_estado','!=',14)->where('id_estado','!=',5) 
        ->where('id_broker',Auth::user()->id)
        ->where('fecha',date('Y-m-d'))->get();
        return $tareas_dia;
    }





    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_user)
    {
        $app = new AppController();
        $id_user = $app->decode64($id_user);
        $estadosModulo = EstadoModulo::with('estados')->where('id_modulo',5)->get();
        $user = User::find($id_user);

        if($this->page=='recompra'){
            //usuarios con fecha 5 dias antes de finalizar el curso activo
             $programa_user = IntegrantesGrupo::with(['users','niveles','grupos'])->where('id_user',$id_user)->get()->last();
             return view('app.cartera.detalles',compact('estadosModulo','user','programa_user'));
        }elseif($this->page=='tareas_dia'){
            //usuarios con una actividad pendiente
            $detalles_asignacion = DetallesAsignacion::with('users')->where('id_user',$id_user)->where('id_modulo',5)->where('estado',1)->get()->last();
            $programa_user = IntegrantesGrupo::with(['users','niveles','grupos'])->where('id_user',$id_user)->get()->last();

           // dd($detalles_asignacion);

            return view('app.cartera.detalles',compact('estadosModulo','user','programa_user','detalles_asignacion'));
        }
       

       // dd($programa_user);

        
        
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
