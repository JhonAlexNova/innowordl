<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Variaciones;
use Illuminate\Support\Str;
use App\Producto;
use Session;

class VariacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = DB::table('productos as p')
        ->join('variaciones as v','v.id','=','v.id_producto')
        ->select('*','p.id as id_producto','p.titulo as nombre_producto','v.titulo as variante')->get();

        //dd($productos);

        return view('app.variacion.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = Producto::find($_REQUEST['id_producto']);
        return view('app.variacion.create',compact('producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //imagen
            $cadena = Str::random(5);
            $file = $request->file("file");

            if($file){
                $nombrearchivo  = $file->getClientOriginalName();
                $file->move(public_path("productos/fotos/"),$cadena.'-'.$nombrearchivo);
                $file = $cadena.'-'.$nombrearchivo;
            }


            $producto = new Variaciones();
            $producto->id_producto = $request->id_producto;
            $producto->titulo = $request->titulo;
             $producto->img_titulo = $file;
             $producto->precio = $request->precio;
             $producto->descripcion = $request->descripcion;
             $producto->save();

            Session::flash('response','Producto añadido creado correctamente');
            return redirect('variacion');
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
