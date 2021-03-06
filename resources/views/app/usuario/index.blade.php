@extends('layouts.dash')
@section('title','usuarios')
@section('content')



@if(!empty($_REQUEST['page']))
	@if($_REQUEST['page']=='nuevos_clientes')
		@include('app.usuario.nuevos')
	@elseif($_REQUEST['page']=='all')
		@include('app.usuario.todos')
	@elseif($_REQUEST['page']=='tareas_dia')
		@include('app.tareas.tareas_dia')
	@elseif($_REQUEST['page']=='tareas_vencidas')
		@include('app.tareas.tareas_vencidas')
	@elseif($_REQUEST['page']=='facturar')
		@include('app.factura.facturar')
	@elseif($_REQUEST['page']=='facturacion_pendiente_pago')
		@include('app.factura.pendientes_pago')
	@elseif($_REQUEST['page']=='matriculados')
		@include('app.matricula.registrado')
	@elseif($_REQUEST['page']=='entrevistas')
		@include('app.entrevista.index')
	@elseif($_REQUEST['page']=='estudiantes_nuevos')
		@include('app.estudiante.nuevo')
	@elseif($_REQUEST['page']=='estudiantes_activos')
		@include('app.estudiante.activo')
	@elseif($_REQUEST['page']=='detalle_nivel')
		@include('app.nivel.index')
	@elseif($_REQUEST['page']=='grupos')
		@include('app.grupo.index')
	@endif
@endif

<script>
	var url = location;
	var query = url.search;
	var array = query.split('=');
	console.log(array);
	//iconos
	var iconos = document.querySelectorAll('.acciones a');
	for(var i=0;i<iconos.length; i++){
		$(iconos[i]).removeClass('active');
	}
	//
	if(array[2]=='list'){
		$('.acciones .list').addClass('active');
	}else if(array[2]=='card'){
		$('.acciones .card').addClass('active');
	}
</script>
	
@endsection