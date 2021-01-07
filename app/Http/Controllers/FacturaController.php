<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\User;
use DB;
use Auth;
use App\DetallesFactura;

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

        $referencia=$referencia.$numero_factura;


        $factura = new Factura();
        $factura->id_user = $request->data[0]['id_user'];
        $factura->id_broker = Auth::user()->id;
        $factura->numero_factura = $referencia;
        $factura->estado = 'no pagada';
        $factura->fecha_acuerdo = $request->data[0]['fecha_acuerdo'];
        $factura->hora = $hora;
        $factura->save();
        $id_factura = $factura->id;
        //
        $total = 0;
        $descuento_t = 0;
        foreach ($request->data as $key => $value) { 
            $monto = $value['precio'];
            $descuento = $monto - ($monto*$value['descuento'])/100;
            $detalles = new DetallesFactura();
            $detalles->id_factura = $id_factura;
            $detalles->cantidad = $value['cantidad'];
            $detalles->descripcion = $value['descripcion'];
            $detalles->precio = $value['precio'];
            $detalles->descuento = $value['descuento'];
            $detalles->hora = $hora;
            $detalles->save();

            $total = $total + $monto;
            $descuento_t = $descuento_t + $descuento;
        }

        $factura = Factura::find($id_factura);
        $factura->total = $total;
        $factura->descuento = $descuento_t;
        $factura->save();
        
        // 

        return 'success';
    }




    public function show($id_user)
    {
        
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
