@extends('layouts.dash')
@section('title','Recompra')

@section('content')
<div class="row">
	    <div class="page-titles">
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
	            <li class="breadcrumb-item active"><a href="javascript:void(0)">Recompra</a></li>
	        </ol>
	    </div>
	</div>

	<div class="acciones d-flex flex-wrap mb-4 align-items-center">
		<a href="{{url('app/usuarios')}}?page=entrevistas&type=list" class="mr-3 mb-2 icono list active" style="padding: 4px 10px 10px 10px;">
			<i class="fa fa-list"></i>
		</a>
		<a href="{{url('app/usuarios')}}?page=entrevistas&type=card" class="mb-2 icono card" style="padding: 10px 10px 10px 10px;">
			<i class="fa fa-th-large"></i>
		</a>
	</div>
	@if(!empty($_REQUEST['type']))
		<?php
			$hora = date('H:i');
			$fecha = date('Y-m-d');
		 ?>
		@if($_REQUEST['type']=='list')
			<section  class="row">
				<div class="col-12">
			        <div class="card">
			            <div class="card-header">
			                <h4 class="card-title">  <small class="text-danger"> <i class="fa fa-exclamation-triangle"></i>  Clientes activos en sus ultimos 5 dias antes de finalizar su proceso formativo</small></h4>
			            </div>
			            <div class="card-body">
			                <div class="table-responsive">
			                    <div id="example_wrapper" class="dataTables_wrapper">

			                    	<div id="example_filter" class="dataTables_filter">
			                    		
			                    	</div>

			                    <table id="example" class="display min-w850 dataTable" role="grid" aria-describedby="example_info">
			                        <thead>
			                            <tr role="row">
			                            	<th> N° </th>
			                            	<th>Nombres</th>
			                            	<th>Apellidos</th>
			                            	<th>Documento</th>
			                            	<th>Telefono</th>
			                            	<th>Dirección</th>
			                            	<th>Correo</th>
			                            	<th>Fecha inicio</th>
			                            	<th>Fecha fin</th>
			                            	<th></th>
			                            </tr>
			                        </thead>
			                        <tbody> 
			                        	@foreach($integrantes_grupos as $key => $value)
			                        		<tr>
			                        			<td> {{ $key }} </td>
				                        		<td> {{ $value->users->nombres }} </td>
				                        		<td> {{ $value->users->apellidos }} </td>
				                        		<td> {{ $value->users->documento }} </td>
				                        		<td> {{ $value->users->telefono }} </td>
				                        		<td> {{ $value->users->direccion }} </td>
				                        		<td> {{ $value->users->email }} </td>
				                        		<td> {{ $value->fecha_inicio }} </td>
				                        		<td> {{ $value->fecha_fin }} </td>
				                        		<td>
													<?php 
														$id = base64_encode($value->id_user);
														$id_det_asig = base64_encode($value->id_det_asig);
													 ?>
													 <a href="{{url('app/cartera',$id)}}?page=recompra" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
												</td>
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
			<section class="row">
				@foreach($users as $key => $value)
					<div class="col-xl-4 col-md-6">
						<div class="card shadow_1">
							<div class="card-body">	
								<div class="media mb-2">
									<div class="media-body">
										<p class="mb-1"><b>Nombres</b>: {{$value->nombres}} </p>
										<h4 class="fs-20 text-black">Apellidos <small>{{$value->apellidos}}</small> </h4>
									</div>
									<svg class="ml-3" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
										<i class="fa fa-user"></i>
									</svg>
								</div>
								<span class="text-primary font-w500 d-block mb-3"><b>Correo: </b>{{$value->email}} </span>
								<p class="fs-14">
									<b>Documento:</b>: {{$value->documento}} <br>
									<b>Telefono:</b>: {{$value->telefono}} <br>
									<b>Fecha matricula:</b>: {{$value->fecha_matricula}} - {{ $value->hora_registro }} <br>
								</p>
								<div class="d-flex align-items-center mt-4">
									<?php 
										$id = base64_encode($value->id_user);
										$id_det_asig = base64_encode($value->id_det_asig);
									 ?>
									<a href="{{url('app/usuarios',$id)}}/edit?page=entrevistas&id_det_asig={{ $id_det_asig }}" class="btn btn-primary light btn-rounded mr-auto">EDITAR</a>
									<span class="text-black font-w500">
										
	            					@if($value->fecha_matricula < $fecha )<!-- la actividad esta vencida-->
		                					<span class="badge light badge-danger">
												<i class="fa fa-circle text-danger mr-1"></i>
												{{$value->fecha_matricula}}
											</span>
										@else
											<span class="badge light badge-success">
												<i class="fa fa-circle text-success mr-1"></i>
												{{$value->fecha_matricula}}
											</span>
		                				@endif
	                    				
									</span>
								</div>
							</div>
						</div>
					</div>
				@endforeach
							
			</section>
			
		@endif
	@else
		<script>
			sessionStorage.removeItem('item');
		</script>
	@endif
@endsection

	