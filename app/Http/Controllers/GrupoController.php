<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;

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
        $grupo = new Grupo();
        $grupo->nombre = $request->nombre;
        $grupo->id_nivel = $request->id_nivel;
        $grupo->fecha_inicio = $request->fecha_inicio;
        $grupo->fecha_fin = $request->fecha_fin;
        $grupo->save();

        return response()->json(['response'=>'Grupo creado correctamente']);
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
