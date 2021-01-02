@extends('layouts.dash')
@section('title','usuarios')
@section('content')
<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Nuevos clientes</a></li>
        </ol>
    </div>
</div>

<div class="acciones d-flex flex-wrap mb-4 align-items-center">
		<a href="{{url('app/usuarios')}}?type=list" class="mr-3 mb-2 icono list active" style="padding: 4px 10px 10px 10px;">
			<i class="fa fa-list"></i>
		</a>
		<a href="{{url('app/usuarios')}}?type=card" class="mb-2 icono card" style="padding: 10px 10px 10px 10px;">
			<i class="fa fa-th-large"></i>
		</a>
	</div>

@if(!empty($_REQUEST['type']))
	@if($_REQUEST['type']=='list')
		<section  class="row">
			<div class="col-12">
		        <div class="card">
		            <div class="card-header">
		                <h4 class="card-title">Listado de usuarios</h4>
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
		                            	<th>Rol</th>
		                            	<th>Fecha registro</th>
		                            	<th>Estado</th>
		                            	
		                            </tr>
		                        </thead>
		                        <tbody> 
		                        	@foreach($users as $key => $value)
		                        		<tr>
		                        			<td> {{$key}} </td>
		                        			<td> {{$value->nombres}} </td>
		                        			<td> {{$value->apellidos}} </td>
		                        			<td> {{$value->documento}} </td>
		                        			<td> {{$value->telefono}} </td>
											<td> {{$value->direccion}} </td>
		                        			<td> {{$value->email}} </td>
		                        			<td> {{$value->rol}} </td>
		                        			<td> {{$value->fecha_registro}} - {{$value->hora_reg}} </td>
		                        			<td>
			                        				@if($value->id_estado == 0)
			                        					<span class="badge light badge-success">
															<i class="fa fa-circle text-success mr-1"></i>
															REGISTRADO
														</span>
			                        				@endif
												
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
								<b>Fecha registro:</b>: {{$value->fecha_registro}} - {{$value->hora_reg}} <br>
							</p>
							<div class="d-flex align-items-center mt-4">
								<a href="javascript:void(0);" class="btn btn-primary light btn-rounded mr-auto">EDITAR</a>
								<span class="text-black font-w500">
									@if($value->id_estado == 0)
		                        					<span class="badge light badge-success">
														<i class="fa fa-circle text-success mr-1"></i>
														REGISTRADO
													</span>
		                        				@endif
								</span>
							</div>
						</div>
					</div>
				</div>
			@endforeach
						
		</section>
		<script>
			var url = location;
			var query = url.search;
			var array = query.split('=');
			//iconos
			var iconos = document.querySelectorAll('.acciones a');
			for(var i=0;i<iconos.length; i++){
				$(iconos[i]).removeClass('active');
			}
			//
			if(array[1]=='list'){
				$('.acciones .list').addClass('active');
			}else if(array[1]=='card'){
				$('.acciones .card').addClass('active');
			}
		</script>
	@endif
@else
	<script>
		location.href = '{{url("app/usuarios")}}?type=list';
	</script>
@endif
		

		
@endsection