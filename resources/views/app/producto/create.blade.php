@extends('layouts.dash')
@section('title','usuarios')
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
            	<a href="{{url('producto')}}" class="btn btn-outline-success">Volver</a>
                <h4 class="card-title"> </h4> 
            </div>
            <div class="card-body">
               <form action="{{route('producto.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <span>Categoria</span>
                                <select name="id_categoria" class="form-control">
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id}}"> {{$categoria->tipo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <span>Titulo</span>
                                <input type="text"  name="titulo" class="form-control" required="on">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <span>Imagen titulo</span>
                                <input type="file"  name="img_titulo" class="form-control" required="on">
                            </div>
                        </div>

                         <div class="col-md-3">
                            <div class="form-group">
                                <span>Precio</span>
                                <input type="number"  name="precio" class="form-control" required="on">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <span>Imagen producto</span>
                                <input type="file"  name="img_producto" class="form-control" style="overflow: hidden;" required="on">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <span>Ingredientes <small>Separe la lista con una (,) y luego con un ENTER</small></span>
                                <textarea name="ingredientes" class="form-control" rows="10" ></textarea>
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