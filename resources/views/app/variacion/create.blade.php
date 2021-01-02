@extends('layouts.dash')
@section('title','usuarios')
@section('content')
<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">variacion producto</a></li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-header">
            	<a href="{{url('producto')}}" class="btn btn-outline-success">Volver</a>
                <h4 class="card-title"> </h4> 
            </div>
            <div class="card-body">
               <form action="{{route('variacion.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
						<div class="col-md-4">
							<select name="id_producto" class="form-control" required="on">
								<option value="{{$producto->id}}">{{$producto->titulo}}</option>
							</select>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="number" placeholder="precio" name="precio" class="form-control" required="on">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="titulo" placeholder="Titulo" class="form-control" required="on">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<span>imagen titulo</span>
								<input type="file" name="file" class="form-control" required="on">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<textarea name="descripcion" class="form-control" class="form-control" required="on"></textarea>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<button class="btn btn-outline-primary btn-block">Crear</button>
							</div>
						</div>

					</div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

