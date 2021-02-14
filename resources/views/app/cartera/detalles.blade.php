@extends('layouts.dash')
@section('title','usuarios')
@section('content')
<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Detalles usuario </a></li>
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
                    <p><b>Nombres: </b>   {{$user->nombres}}  <br></p>
                    <p><b>Apellidos: </b>   {{$user->apellidos}} <br></p>
                    <p><b>Documento: </b>   {{$user->documento}} <br></p>
                    <p><b>Telefono: </b>   {{$user->telefono}} <br></p>
                    <p><b>Correo: </b>   {{$user->email}} <br></p>
                    <p><b>Fecha registro: </b>   {{$user->fecha_registro}} {{$user->hora_reg}} <br></p>
                    
                    @if($user->id_estado==0)
                        <p><b>Estado: </b>  REGISTRADO Y ASIGNADO <br></p>                           
                    @endif
                    <p><b>Edad</b>:
                         <?php 
                            if($user->fecha_nacimiento){  ?>
                                <span class="edad"> 
                                    <?php 
                                       echo calculaedad($user->fecha_nacimiento);?>
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
                        @if($_REQUEST['page']=='recompra')
                            @include('app.cartera.forms.recompra')
                        @elseif($_REQUEST['page']=='tareas_dia')
                            @include('app.cartera.forms.tareas_dia')
                        @endif
                    @endif
                         

                    <script>
                        $(document).on('click','.nav-tabs li a',function(e){
                            var el = e.target.hash;
                            location.href = el;
                            sessionStorage.setItem('item',el);
                        });

                        window.onload = function(){
                            var item = sessionStorage.getItem('item');
                            if(item){
                                $('.nav-tabs a, .tab-pane').removeClass('show active');
                                $(`.nav-tabs a[href='${item}'], ${item}`).addClass('show active');
                            }

                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/controller/CiudadController.js')}}"></script>

<script>
    var url_string = window.location.href; // www.test.com?filename=test
    var url = new URL(url_string);
    var paramValue = url.searchParams.get("page");
    var id_det_asig = url.searchParams.get("id_det_asig");
</script>
@if(Session::get('success'))
    <script>
            window.onload = function(){
            toastr.success('{!! Session::get('success') !!}','Mensaje!!!',{
                'progressBar':true
            });
        }
    </script>
@endif
@endsection