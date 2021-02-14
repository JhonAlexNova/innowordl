<<<<<<< HEAD
<form action="" id="form-create-grupo">
	<div class="modal fade" id="modal-create-grupo">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="id_nivel">Nivel</label>
							<select name="id_nivel" class="form-control" required>
								<option></option>
								@foreach($niveles as $nivel)
									<option value="{{ $nivel->id }}"> {{ $nivel->nombre }} </option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="fecha_inicio">Nombre del grupo</label>
							<input type="text" name="nombre" class="form-control" placeholder="Grupo 1" required>
						</div>
						<div class="form-group col-md-6">
							<label for="fecha_inicio">Fecha inicio</label>
							<input type="date" name="fecha_inicio" class="form-control">
						</div>
						<div class="form-group col-md-6">
							<label for="fecha_inicio">Fecha fin</label>
							<input type="date" name="fecha_fin" class="form-control">
						</div>
					</div>
				</div>	
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-primary" >Guardar</button>
				</div>
			</div>
		</div>
	</div>
</form>
	
<script src="{{ url('js/controller/GrupoController.js') }}"></script>
=======
@extends('layouts.dash')
@section('title','grupos')
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
            	<a href="{{url('/app/usuarios?page=grupos&type=list')}}" class="btn btn-outline-success">Volver</a>
                <h4 class="card-title"> </h4> 
            </div>
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {!! Session::get('success') !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            <div class="card-body">
               <form action="{{route('grupo.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <span>Nivel</span>
                                <select name="id_nivel" class="form-control">
                                    @foreach($niveles as $nivel)
                                        <option value="{{$nivel->id}}"> {{$nivel->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <span>Nombre</span>
                                <input type="text"  name="nombre" class="form-control" required="on">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <span>Fecha inicio</span>
                            <?php 
                                date_default_timezone_set('America/Bogota');
                                $fecha_min = date('Y-m-d');
                                $hora_min = date('H');
            
                             ?>
                            <input type="date" name="fecha_inicio" class="form-control" min="<?php echo $fecha_min; ?>" required="on">
                            </div>
                        </div>

                         <div class="col-md-3">
                            <div class="form-group">
                                <span>Fecha fin</span>
                                <input type="date" name="fecha_fin" class="form-control" min="<?php echo $fecha_min; ?>" required="on">
                            </div>
                        </div>

                         <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary">Guardar</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
>>>>>>> ac2254a43eb1fa718df250db58511964beaa08ed
