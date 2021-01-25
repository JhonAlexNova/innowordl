@extends('layouts.dash')
@section('title','Permisos')

@section('content')
	<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Permisos</a></li>
        </ol>
    </div>
</div>


	<?php 
		$fecha = date('Y-m-d');
	 ?>
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
		                            	@foreach($rols as $rol)
		                            		@if($rol->id!=6)
		                            			<th> {{ $rol->tipo }} </th>
		                            		@endif
		                            		
		                            	@endforeach
		                            	<th>Acceso</th>
		                            	
		                            </tr>
		                        </thead>
		                        <tbody>
		                        	@foreach($brokers as $key => $value)
		                        		@if($value->id_rol!=2)

			                        		<tr>
			                        			<td> {{$key}} </td>
			                        			<td> {{$value->nombres}} </td>
			                        			<td> {{$value->apellidos}} </td>
			                        			<td> {{$value->documento}} </td>
			                        			@foreach($rols as $index => $rol)
		                        					@if($rol->id!=6)
		                        						<td>
		                        							<input type="checkbox" value="{{ $value->id_user }}"  name="id_rol" class="{{ $value->id_user }}-{{ $index }}" rol="{{ $rol->id }}">
		                        							@foreach($users_rols as $type_user)
		                        								@if($type_user->id_rol == $rol->id && $value->id_user == $type_user->id_user)
		                        									<script>
		                        										$('input[class="{{ $value->id_user }}-{{ $index }}"]').prop('checked',true);
		                        									</script>
		                        								@endif

		                        							@endforeach
		                        						</td>	
		                        					@endif
			                            		@endforeach	
			                            		<td>
			                            			@if($value->estado=='activo')
			                            				<input type="checkbox" name="estado" checked value="{{ $value->id_user }}" estado="inactivo">
			                            			@else
			                            				<input type="checkbox" name="estado"  value="{{ $value->id_user }}" estado="activo">
			                            			@endif
			                            		</td>
												
			                        		</tr>

			                        		@endif
		                        	@endforeach                           

		                        </tbody>
		                    </table>

		                </div>
		            </div>
		        </div>
		    </div>
		</section>

		<script>
			$('input[name=id_rol]').change(function(e){
				var id_user = e.target.value;
				var rol = $(this).attr('rol');
				var data = {page:'permisos','id_user':id_user, estado:'', id_rol:rol};

				if(this.checked) {
		            data.estado = 1;
		        }else{
		        	data.estado = 2;
		        }
		       
		        update(data);
			});


			$('input[name=estado]').change(function(e){
				var id_user = e.target.value;
				var data = {page:'bloqueo','id_user':id_user, estado:''};
				if(this.checked) {
		            data.estado = 'activo';
		        }else{
		        	data.estado = 'inactivo';
		        }
		        update(data);
			});

			function update(data){
				 $.ajax({
		        	 headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    url:'{{ url('/app/usuarios') }}/'+data.id_user,
				    method:'PUT',
				    data:data,
				    success:function(r){
				    	console.log(r);
				    }
		        })
			}

		</script>
@endsection