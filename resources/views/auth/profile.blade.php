@extends('layouts.dash')
@section('title','usuarios')
@section('content')
<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Mis datos</a></li>
        </ol>
    </div>
</div>




<div class="row">
    <div class="col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="profile-blog mb-5">
                     <?php 
                        function calculaedad($fechanacimiento){
                          list($ano,$mes,$dia) = explode("-",$fechanacimiento);
                          $ano_diferencia  = date("Y") - $ano;
                          $mes_diferencia = date("m") - $mes;
                          $dia_diferencia   = date("d") - $dia;
                          if ($dia_diferencia < 0 || $mes_diferencia < 0)
                            $ano_diferencia--;
                          return $ano_diferencia;
                        }

                     ?>


                    <h5 class="text-primary d-inline">Información</h5>
                    <img src="images/profile/1.jpg" alt="" class="img-fluid mt-4 mb-4 w-100">
                    <p><b>Nombres: </b>   {{Auth::user()->nombres}}  <br></p>
                    <p><b>Apellidos: </b>   {{Auth::user()->apellidos}} <br></p>
                    <p><b>Documento: </b>   {{Auth::user()->documento}} <br></p>
                    <p><b>Telefono: </b>   {{Auth::user()->telefono}} <br></p>
                    <p><b>Correo: </b>   {{Auth::user()->email}} <br></p>
                    @if(Auth::user()->id_estado==0)
                        <p><b>Estado: </b>  REGISTRADO Y ASIGNADO <br></p>                           
                    @endif
                    <p><b>Edad</b>:
                         <?php 
                            if(Auth::user()->fecha_nacimiento){  ?>
                                <span class="edad"> 
                                    <?php 
                                       echo calculaedad(Auth::user()->fecha_nacimiento);?>
                                 </span>Años
                            <?php } else{
                                echo "Sin registro";
                            }
                         ?>
                     </p>

                </div>
            </div>
        </div>
    </div>





    <div class="col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="profile-tab">
                    @if(!empty($_REQUEST['page']))
                        <div class="custom-tab-1">
                            <div class="pt-3">
                                <div class="settings-form">
                                     @if(Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                          {!! Session::get('success') !!}
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                    @endif
                                    <h4 class="text-primary">Datos personales</h4>
                                    <form action="{{route('usuarios.update',Auth::user()->id)}}" method="post" class="register">
                                    @csrf 
                                    @method('put')
                                    <div class="form-row">
                                        
                                        <div class="form-group col-md-3 nombres">
                                            <label>Nombres</label>
                                            <input type="text" name="nombres" class="form-control" placeholder="Ingresar nombres" required="on" value="{{Auth::user()->nombres}}">
                                        </div>
                                        <div class="form-group col-md-3 apellidos">
                                            <label>Apellidos</label>
                                            <input type="text" name="apellidos" class="form-control" placeholder="Ingresar apellidos" required="on" value="{{Auth::user()->apellidos}}">
                                        </div>
                                        <div class="form-group col-md-3 telefono">
                                            <label>Numero de contacto</label>
                                            <input type="text" name="telefono" class="form-control" placeholder="Ingresar numero de contacto" value="{{Auth::user()->telefono}}">
                                        </div>
                                        <div class="form-group col-md-3 email">
                                            <label>Correo</label>
                                            <input type="text" name="email" class="form-control" placeholder="Correo electronico" autocomplete="Correo electronico" value="{{Auth::user()->email}}">
                                        </div>
                                       
                                        <div class="form-group col-md-3 id_ciudad">
                                            <label>Dirección</label>
                                            <input type="text" name="direccion" class="form-control" value="{{Auth::user()->direccion}}">
                                        </div>
                                        <div class="form-group col-md-3 id_tipo_doc">
                                            <label>Tipo documento</label>
                                            <select name="id_tipo_documento" class="form-control">
                                                <option></option>
                                                @foreach($tipos_documentos as $key => $value)
                                                     @if(Auth::user()->id_tipo_documento == $value->id)
                                                        <option value="{{$value->id}}" selected="on"> {{$value->tipo}} </option>
                                                     @else
                                                        <option value="{{$value->id}}"> {{$value->tipo}} </option>
                                                     @endif
                                                    
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3 documento">
                                            <label>Documento</label>
                                            <input type="text" name="documento" class="form-control" placeholder="Ingresar numero documento" value="{{Auth::user()->documento}}">
                                        </div>

                                        <div class="form-group col-md-3 documento">
                                            <label>Fecha de nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" class="form-control"  value="{{Auth::user()->fecha_nacimiento}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer"></div>
                                    <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection