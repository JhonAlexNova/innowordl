<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Estudiantes activos</a></li>
        </ol>
    </div>
</div>
<div class="card-deck">
	@foreach($users as $key => $value)
		<div class="card">
			<a href="{{url('app/usuarios')}}?page=detalle_nivel&nivel={{ $value->id}}">
			<img src="{{url('/')}}/img/niveles/{{$value->imagen}}" class="card-img-top" alt="...">
			<div class="card-body">
			<h5 class="card-title text-center">{{$value->nombre}}</h5>
			</div>
			</a>
		</div>
	@endforeach
</div>