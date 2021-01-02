@extends('layouts.dash')
@section('title','Productos')
@section('content')
<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Productos</a></li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-header">
            	<a href="{{url('producto/create')}}" class="btn btn-outline-success">Nuevo</a>
                <h4 class="card-title">Listado de productos </h4> 
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display min-w850">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Titulo</th>
                                <th>Subtitulo</th>
                                <th>Categoria</th>
                                <th>Precio</th>
                                <th>Imagen</th>
                                <th>Descripción</th>
                                <td>Variaciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            foreach
                            @foreach($productos as $key => $producto)
                                <tr>
                                    <td> {{$key}} </td>
                                    <td> {{$producto->titulo}} </td>
                                    <td> {{$producto->subtitulo}} </td>
                                    <td> {{$producto->tipo}} </td>
                                    <td> {{$producto->precio}} </td>
                                    <td> <img src="{{url('productos/fotos',$producto->imagen)}}" alt=""> </td>
                                    <td> {{$producto->ingredientes}} </td>
                                     <td> <a href="{{url('variacion/create')}}?id_producto={{$producto->id_producto}}">Añadir</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection