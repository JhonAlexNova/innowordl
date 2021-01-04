<table class="table table-bordered">
	<thead>
		<tr>
			<td>N° </td>
			<td>Fecha</td>
			<td>Hora</td>
			<td>Fecha registro</td>
			<td>Actualización por</td>
			<td>Estado</td>
			<td>Observación</td>
		</tr>
	</thead>
	<tbody>
		@foreach($detalles as $key => $value)
			<tr>
				<td> {{$key}} </td>
				<td> {{$value->fecha}} </td>
				<td> {{$value->hora}}</td>
				<td> {{$value->created_at}} - {{$value->hora_registro}} </td>
				<td> {{$value->nombres}} {{$value->apellidos}} </td>
				<td>  {{$value->estado}}</td>
				<td> {{$value->observacion}} </td>
			</tr>
		@endforeach
	</tbody>
</table>