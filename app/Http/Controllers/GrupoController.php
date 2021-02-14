<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Nivel;
use App\Grupo;
use Session;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveles = new NivelController();
        $niveles = $niveles->get_niveles();

        $grupos = Grupo::with('niveles')->get();
        
       // dd($grupos);
        
        return view('app.grupo.index',compact('niveles','grupos'));
    }



    public function get_niveles(){
        $list_niveles = Nivel::all();
        return $list_niveles;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveles = new GrupoController();
        $niveles = $niveles->get_niveles();
        return view('app.grupo.create',compact('niveles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupo = new Grupo();
        $grupo->nombre = $request->nombre;
        $grupo->id_nivel = $request->id_nivel;
        $grupo->fecha_inicio = $request->fecha_inicio;
        $grupo->fecha_fin = $request->fecha_fin;
        $grupo->save();

        return response()->json(['response'=>'Grupo creado correctamente']);

        $grupo->id_nivel = $request->input('id_nivel');
        $grupo->nombre = $request->input('nombre');
        $grupo->fecha_inicio = $request->input('fecha_inicio');
        $grupo->fecha_fin = $request->input('fecha_fin');
        $grupo->save();
        Session::flash('success','<b>Mensaje! </b>Registro creado correctamente.');
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
