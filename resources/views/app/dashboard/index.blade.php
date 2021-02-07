@extends('layouts.dash')
@section('title','usuarios')
@section('content')
<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
        </ol>
    </div>
</div>

<section class="row card" id="menu-admin">
    <div class="col-md-12">
            <h1>WELCOME</h1>
            <h4>No basta con querer: debes preguntarte a ti mismo qué vas a hacer para conseguir lo que quieres.
<br><small><b>Franklin D. Roosevelt</b></small>
</h4>
    </div>
    <div class="col-md-12">
        <ul class="menu">
            @foreach(Session::get('rols') as $rol)
                     <li >
                        <a href="{{ url('app/rol') }}?id_rol={{ $rol->id_rol }}"> {{$rol->tipo}} </a>
                    </li>
            @endforeach
        </ul>   
    </div>
</section>

@endsection