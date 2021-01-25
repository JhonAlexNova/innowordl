<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\User;
use DB;
use Auth;
use App\DetallesFactura;
use App\DetallesAsignacion;
use App\Matricula;
use PDF;
use Mail;

class FacturaController extends Controller
{

     public function __construct()
    {
       date_default_timezone_set('America/Bogota');
    }

    public function index()
    {
        //
    }


    public function get_facturas_user($id_user){
        $facturas = DB::table('factura as f')
        ->join('detalles_factura as df','df.id_factura','=','f.id')
        ->where('f.id_user','=',$id_user)
        ->select('*','f.created_at as fecha_creacion','f.descuento as descuento_fac')->groupBy('f.id')->orderBy('f.fecha_acuerdo','ASC')->get();

        return $facturas;
    }


    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        $app = new AppController();
        $id_det_asig = $app->decode64($_REQUEST['id_det_asig']);

        //return $id_det_asig;

        $hora = date('H:i:s');

        $sql = Factura::get()->last();
        $numero_factura = $sql->numero_factura;
        $numero_factura = $numero_factura + 1;
        $referencia = '';
        $long = strlen($numero_factura);
        $end_for = 15 - $long;

        for ($i=1; $i<= $end_for ; $i++) { 
            $referencia = $referencia.'0'; 
        }

        $referencia = $referencia.$numero_factura;
 

        $factura = new Factura();
        $factura->id_user = $request->data[0]['id_user'];
        $factura->id_broker = Auth::user()->id;
        $factura->numero_factura = $referencia;
        $factura->estado = 'no pagada';
        $factura->fecha_acuerdo = $request->data[0]['fecha_acuerdo'];
        $factura->hora = $hora;
        //
        $factura->nombre_acudiente = $request->data[0]['acudiente']['nom'];
        $factura->documento_acudiente = $request->data[0]['acudiente']['doc'];
        $factura->correo_acudiente = $request->data[0]['acudiente']['email'];
        $factura->telefono_acudiente = $request->data[0]['acudiente']['tel'];
        $factura->save();
        $id_factura = $factura->id;
        //
        $total = 0;
        $descuento_t = 0;
        foreach ($request->data as $key => $value) { 
            $monto = $value['precio'];

            $detalles = new DetallesFactura();
            $detalles->id_factura = $id_factura;
            $detalles->cantidad = $value['cantidad'];
            $detalles->descripcion = $value['descripcion'];
            $detalles->precio = $value['precio'];
            $detalles->hora = $hora;
            $detalles->save();

            $total = $total + $monto;
        }

        $factura = Factura::find($id_factura);
        $factura->total = $total;
        $factura->save();
        
        //
        $detalles_asignacion = DetallesAsignacion::find($id_det_asig);
        $detalles_asignacion->estado = 2;
        $detalles_asignacion->save();

        return 'success';
    } 


    public function get_detalles_factura_id($id){
         $factura = DB::table('factura as f')
        ->join('detalles_factura as df','df.id_factura','=','f.id')
        ->join('users as u','u.id','=','f.id_user')
        ->where('f.id','=',$id)
        ->select('*','f.created_at as fecha_creacion','f.descuento as descuento_fac')->groupBy('f.id')->orderBy('f.fecha_acuerdo','ASC')->get();
        //
        $detalles = DB::table('detalles_factura as df')->where('df.id_factura','=',$id)->select('*')->get();
        //dd($detalles);


        $factura[0]->detalles = $detalles;
        //dd($factura);



        return $factura;
    }

    public function show($id)
    {
        $hora = date('H:i:s');
        $fecha = date('Y-m-d');

        $FacturaController = new FacturaController();
        $factura = $FacturaController->get_detalles_factura_id($id);
        //dd();
        $empresa = new EmpresaController();
        $empresa = $empresa->get_empresa();
       // dd($empresa);

        $page = $_REQUEST['page'];
        if($page=='generar_factura_pdf'){
            $pdf = PDF::loadView('pdf.factura', compact('factura','empresa'));  

            return $pdf->download('medium.pdf');
        }elseif ($page=='enviar_mail') {
            Mail::send('pdf.factura', compact('factura','empresa'), function ($message){
                $message->subject('Factura');
                $message->to('jhonnova19@gmail.com');
            });
        }else if($page=='confirmar_pago'){
           // dd('aca');
            $user = User::find($_REQUEST['id_user']);
            $user->id_estado = 6;
            $user->save();

            $detalles_f = new DetallesAsignacion();
            $detalles_f->id_estado = 6;
            $detalles_f->id_user = $_REQUEST['id_user'];
            $detalles_f->id_broker = $factura[0]->id_broker;
            $detalles_f->fecha = $_REQUEST['fecha'];
            $detalles_f->hora = $_REQUEST['hora'];
            $detalles_f->hora_registro = $hora;
            $detalles_f->observacion = $_REQUEST['observacion'];
            $detalles_f->save();

            //matricula usuario
            $factura = Factura::find($id);
            $factura->estado = 'pagada';
            $factura->save();

            //
            $matricula = new Matricula();
            $matricula->id_user = $factura->id_user;
            $matricula->id_broker = $factura->id_broker;
            $matricula->estado = 1;
            $matricula->hora_registro = $hora;
            $matricula->save();
        }

       return redirect()->back();
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
