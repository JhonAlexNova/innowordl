<<<<<<< HEAD
@extends('layouts.dash')
@section('title','Grupos')
@section('content')
=======
>>>>>>> ac2254a43eb1fa718df250db58511964beaa08ed
<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Grupos</a></li>
        </ol>
    </div>
</div>

<<<<<<< HEAD
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

@include('app.grupo.create')
@endsection
=======
<div class="acciones d-flex flex-wrap mb-4 align-items-center">
	<a href="{{url('app/usuarios')}}?page=grupos&type=list" class="mr-3 mb-2 icono list active" style="padding: 4px 10px 10px 10px;">
		<i class="fa fa-list"></i>
	</a>
	<a href="{{url('app/usuarios')}}?page=grupos&type=card" class="mb-2 icono card" style="padding: 10px 10px 10px 10px;">
		<i class="fa fa-th-large"></i>
	</a>
</div>
@if(!empty($_REQUEST['type']))
	<?php
		$hora = date('H:i');
		$fecha = date('Y-m-d');
	 ?>

		<section  class="row">
			<div class="col-12">
		        <div class="card">
		            <div class="card-header">
		                <h4 class="card-title">Grupos por nivel</h4>
		            </div>
		            <div class="card-body">
                        <div class="card-header">
                            <a href="{{ url('app/grupo/create') }}" class="btn btn-outline-primary">AÑADIR</a>
                            </div>
		                <div class="table-responsive">
		                    <div id="example_wrapper" class="dataTables_wrapper">

		                    	<div id="example_filter" class="dataTables_filter">
		                    		
		                    	</div>

		                    <table id="example" class="display min-w850 dataTable" role="grid" aria-describedby="example_info">
		                        <thead>
		                            <tr role="row">
		                            	<th> N° </th>
		                            	<th>Niveles</th>
		                            	<th>Grupos</th>
                                        <th></th>
		                            </tr>
		                        </thead>
		                        <tbody> 
		                        	@foreach($users as $key => $value)
		                        		<tr>
		                        			<td> {{$key}} </td>
		                        			<td> {{$value->nombre}} </td>
											<td>
                                                <ul>
                                                    @foreach($value->grupos as $index => $grupo)
                                                    <li>
                                                         <b>{{ $index }}.  {{ $grupo->nombre }}</b><br>
                                                         Fecha inicio: {{ $grupo->fecha_inicio }}<br>
                                                         Fecha fin: {{ $grupo->fecha_fin }}
                                                    </li>
                                                    @endforeach
                                                </ul>
												<?php 
													//$id = base64_encode($value->id_user);
													//$id_det_asig = base64_encode($value->id_det_asig);
												 ?>
												 <!--<a href="{{url('app/usuarios')}}/edit?page=entrevistas&id_det_asig=" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>-->
											</td>
                                            <td></td>
											
		                        		</tr>
		                        	@endforeach                           

		                        </tbody>
		                    </table>

		                </div>
		            </div>
		        </div>
		    </div>
		</section>
@else
	<script>
		sessionStorage.removeItem('item');
	</script>
@endif
>>>>>>> ac2254a43eb1fa718df250db58511964beaa08ed
