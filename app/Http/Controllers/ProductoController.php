<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Variaciones;
use App\Categoria;
use Session;
use Illuminate\Support\Str;
use DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = DB::table('productos as p')
        ->join('categorias as c','c.id','=','p.id_categoria')
        ->select('*','p.id as id_producto')->get();

        return view('app.producto.index', compact('productos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('app.producto.create',compact('categorias'));
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
            $img1 = $request->file("img_titulo");
            $img2 = $request->file("img_producto");

            if($img1){
                $nombrearchivo  = $img1->getClientOriginalName();
                $img1->move(public_path("productos/fotos/"),$cadena.'-'.$nombrearchivo);
                $img1 = $cadena.'-'.$nombrearchivo;
            }

            if($img2){
                $nombrearchivo  = $img2->getClientOriginalName();
                $img2->move(public_path("productos/fotos/"),$cadena.'-'.$nombrearchivo);
                $img2 = $cadena.'-'.$nombrearchivo;
            }



            $producto = new Producto();
            $producto->id_categoria = $request->id_categoria;
            $producto->titulo = $request->titulo;
            $producto->img_titulo = $img1;
            $producto->ingredientes = $request->ingredientes;
            $producto->imagen = $img2;
            $producto->precio = $request->precio;
            $producto->save();

            Session::flash('response','Producto añadido creado correctamente');
            return redirect('producto');

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

    //================================================== api ============================== */
    public function get_list($page){
        $sql = DB::table('categorias as c')
        ->join('productos as p','p.id_categoria','=','c.id')
        ->where('c.tipo','=',$page)
        ->select('*','c.imagen as foto','p.id as id_producto')->get();

        $productos = array();
        foreach ($sql as $key => $value) {
            //verificar si tiene variaciones del producto.
            $variaciones = Variaciones::where('id_producto','=',$value->id_producto)->select('*')->get();
            
            
            $variaciones_long = Variaciones::where('id_producto','=',$value->id_producto)->select('*')->count();
            if($variaciones_long==0){
                $variaciones_long = 1;
            }


            $cant_variaciones = 100 / $variaciones_long;
           // $cant_variaciones = 100 / $variaciones;

            $obj = array('titulo'=>$value->titulo, 'img_titulo'=>$value->img_titulo,'subtitulo'=>$value->subtitulo, 'ingredientes'=>$value->ingredientes, 'precio'=>$value->precio,'imagen'=>$value->imagen, 'foto_categoria'=>$value->foto,'id_categoria'=>$value->id_categoria, 'variaciones' => $variaciones, 'cant_variaciones' => $cant_variaciones );
                
                array_push($productos, $obj);
        }

        return $productos;
    }
}
