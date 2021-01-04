@extends('layouts.dash')
@section('title','usuarios')
@section('content')
<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Usuarios</a></li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-xl-12 col-md-12 col-lg-12"> 
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ Session::get('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
            
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Formulario de registro </h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if(!empty($_REQUEST['page']))
                        @include('app.usuario.import')
                    @else
                        <form action="{{route('usuarios.store')}}" method="post" class="register">
                            @csrf 
                            <div class="form-row">
                                <div class="form-group col-md-3 id_rol">
                                    <label>Tipo de usuario</label>
                                    <select name="id_rol" class="form-control" required="on">
                                        <option></option>
                                        @if(Session::get('id_rol')==1)
                                            <option value="2"> ADMINISTRATIVO </option>
                                        @endif

                                        @foreach($rols as $key => $value)
                                            @if($value->id == 6)
                                                <option value="{{$value->id}}" selected="selected"> {{$value->tipo}} </option>
                                            @else
                                                @if(Session::get('id_rol')==1 || Session::get('id_rol')==2)
                                                    <option value="{{$value->id}}"> {{$value->tipo}} </option>
                                                @endif
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                </div> 

                                <div class="form-group col-md-3 nombres">
                                    <label>Nombres</label>
                                    <input type="text" name="nombres" class="form-control" placeholder="Ingresar nombres" required="on">
                                </div>
                                <div class="form-group col-md-3 apellidos">
                                    <label>Apellidos</label>
                                    <input type="text" name="apellidos" class="form-control" placeholder="Ingresar apellidos" required="on">
                                </div>
                                <div class="form-group col-md-3 telefono">
                                    <label>Numero de contacto</label>
                                    <input type="text" name="telefono" class="form-control" placeholder="Ingresar numero de contacto">
                                </div>
                                <div class="form-group col-md-3 email">
                                    <label>Correo</label>
                                    <input type="text" name="email" class="form-control" placeholder="Correo electronico" autocomplete="Correo electronico">
                                </div>
                                <div class="form-group col-md-3 id_dep">
                                    <label>Departamento</label>
                                    <select name="id_departamento"  class="form-control">
                                        <option></option>
                                        @foreach($departamentos as $key => $value)
                                            <option value="{{$value->id}}"> {{$value->nombre}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 id_ciudad">
                                    <label>Ciudad</label>
                                    <select name="id_ciudad" class="form-control">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 id_tipo_doc">
                                    <label>Tipo documento</label>
                                    <select name="id_tipo_documento" class="form-control">
                                        <option></option>
                                        @foreach($tipos_documentos as $key => $value)
                                            <option value="{{$value->id}}"> {{$value->tipo}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3 documento">
                                    <label>Documento</label>
                                    <input type="text" name="documento" class="form-control" placeholder="Ingresar numero documento">
                                </div>

                                <div class="form-group col-md-3 fuente">
                                    <label>Fuente de ingreso</label>
                                    <select name="id_fuente" class="form-control">
                                        <option></option>
                                        @foreach($fuentes as $key => $value)
                                            <option value="{{$value->id}}"> {{$value->tipo}} </option>
                                        @endforeach
                                    </select>
                                </div>  

                                 <div class="form-group col-md-3 asignacion">
                                    <label>Broker asignado</label>
                                    <select name="id_broker" class="form-control">
                                        <option></option>
                                        @foreach($users as $key => $value)
                                            <option value="{{$value->id_}}"> {{$value->nombres}} {{$value->apellidos}} </option>
                                        @endforeach
                                    </select>
                                </div> 


                            </div>
                            <div class="modal-footer"></div>
                            <button type="submit" class="btn btn-outline-primary">REGISTRAR</button>
                        </form>
                    @endif

                        
                </div>
            </div>
        </div>
	</div>
</div>
<script src="{{asset('js/controller/CiudadController.js')}}"></script>
<script src="{{asset('js/controller/UsuarioController.js')}}"></script>
@endsection