 <div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Facturar</a></li>
        </ol>
    </div>
</div>

<div class="acciones d-flex flex-wrap mb-4 align-items-center">
	<a href="{{url('app/usuarios')}}?page=facturar&type=list" class="mr-3 mb-2 icono list active" style="padding: 4px 10px 10px 10px;">
		<i class="fa fa-list"></i>
	</a>
	<a href="{{url('app/usuarios')}}?page=facturar&type=card" class="mb-2 icono card" style="padding: 10px 10px 10px 10px;">
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
		                <h4 class="card-title">Listado de usuarios sin facturar</h4>
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
		                            	<th>Hora asignada</th>
		                            	<th>Estado</th>
		                            	<th>Observación</th>

		                            	<th></th>
		                            	
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
		                        			<td> {{$value->hora_evento}} </td>
		                        			<td>
 			                        				@if($value->fecha_registro != $fecha )<!-- la actividad esta vencida-->
			                        					<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger mr-1"></i>
															{{$value->tipo}}
														</span>
													@else
														<span class="badge light badge-success">
															<i class="fa fa-circle text-success mr-1"></i>
															{{$value->tipo}}
														</span>
			                        				@endif
											</td>
											<td> {{$value->observacion}} </td>
											<td>
												<?php 
													$id = base64_encode($value->id_user);
													$id_det_asig = base64_encode($value->id_det_asig);
												 ?>
												 <a href="{{url('app/usuarios',$id)}}/edit?page=facturar&id_det_asig={{ $id_det_asig }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
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
								<b>Fecha y Hora asignada: </b> {{$value->fecha_evento}} {{$value->hora_evento}}
							</p>
							<div class="d-flex align-items-center mt-4">
								<?php 
									$id = base64_encode($value->id_user);
								 ?>
								<a href="{{url('app/usuarios',$id)}}/edit?page=facturar" class="btn btn-primary light btn-rounded mr-auto">EDITAR</a>
								<span class="text-black font-w500">
									
            					@if($value->fecha_registro != $fecha )<!-- la actividad esta vencida-->
                					<span class="badge light badge-danger">
										<i class="fa fa-circle text-danger mr-1"></i>
										{{$value->tipo}}
									</span>
								@else
									<span class="badge light badge-success">
										<i class="fa fa-circle text-success mr-1"></i>
										{{$value->tipo}}
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