@extends('layouts.dash')
@section('title','usuarios')
@section('content')
<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Nivel</a></li>
        </ol>
    </div>
</div>




<div class="row">
    <div class="col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="profile-blog mb-5">
                     
                    <h5 class="text-primary d-inline">Nivel</h5>
                    <div class="card-deck">
                        <div class="card">
                            <a href="{{url('app/usuarios')}}?page=detalle_nivel&nivel={{ $nivel->id}}">
                            <img src="{{url('/')}}/img/niveles/{{$nivel->imagen}}" class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title text-center">{{$nivel->nombre}}</h5>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="profile-tab">
                  
                    <div class="custom-tab-1">

                        <div class="card-deck">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="card-header">
                                        <h4 class="card-title">Grupos</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <div id="example_wrapper" class="dataTables_wrapper">
        
                                            <div id="example_filter" class="dataTables_filter">
                                                
                                            </div>
        
                                            <table id="example" class="display min-w550 dataTable" role="grid" aria-describedby="example_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th> N° </th>
                                                        <th>Nombre</th>
                                                        <th>Fecha inicio</th>
                                                        <th>Fecha fin </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                    @foreach($list_grupos as $key => $value)
                                                        <tr>
                                                            <td> {{$key}} </td>
                                                            <td> {{$value->nombre}} </td>
                                                            <td> {{$value->fecha_inicio}} </td>
                                                            <td> {{$value->fecha_fin}} </td>
                                                            <td> <a href="{{url('app/usuarios')}}?page=detalle_grupo&grupo={{ $value->id}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a></td>
                                                            
                                                        </tr>
                                                    @endforeach                           
            
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>       
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
