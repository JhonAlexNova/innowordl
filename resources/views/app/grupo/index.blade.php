
@extends('layouts.dash')
@section('title','Grupos')
@section('content')

<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Grupos</a></li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-header">
            	<a href="#modal-create-grupo" data-toggle="modal" class="btn btn-outline-success">Nuevo</a>
                <h4 class="card-title">Listado de productos </h4> 
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display min-w850">  
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Grupo</th>
                                <th>Nivel</th>
                                <th>Categoria</th>
                                <th>Precio</th>
                                <th>Imagen</th>
                                <th>Descripción</th>
                                <td>Variaciones</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

