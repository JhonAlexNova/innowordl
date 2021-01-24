<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	
	<title>Factura</title>
	<style>
		body{
			font-family: 'Roboto', sans-serif;
		}
		.contenido{
			background: #dedede !important;
			padding: 0px;
			height: auto;
			position:absolute;
			width: 100%;
		}
		.factura{
			background: #fff;
			display: block;
			max-width: 900px;
			margin: auto;
			padding: 10px;
			height: 100%;
			position: relative;
			bottom: 0;
			left: 0;
			right: 0;
			top: 0;
			padding: 30px 40px 40px 40px;
			  border: 1px #0000002e dashed;
		}
		small{
			font-weight: normal;
		}
		.logo{
			width: 100%
		}
		table{
			width: 100%;
			border-collapse: collapse;
		}
		.cabecera tr{
			padding: 0px 0
		}
		.cabecera{
			background: #f3f3f3;
			border: 1px #0000000a solid; 
			padding: 0 10px
		}
		.title{
			margin: 25px 0 0 0;
			border: 1px #0000000a solid;
			background: #efefef;
		}
		.body tr td{
			margin: 0;
		    border-bottom: 1px #00000029 solid;
		    padding: 10px 0;
		}

		p.estado {
		    font-weight: bold;
		    font-size: 40px;
		}
		.text-success{
			color: #3ae83a;
		}

		ul{
			list-style: none;
			padding: 0;
		}
		ul.empresa li{
			font-size: 10px;
			font-weight: bold;
		}

	</style>

</head>
<body> 
	@if($_REQUEST['page']=='enviar_mail')
		<style>
			.factura{
				margin: 40px 0
			}
		</style>
	@endif
	<div class="top">
		<img src="https://www.innovationlanguageschool.com/wp-content/uploads/2021/01/cabecera1.png">
	</div>
	<div class="contenido">
		<div class="factura">
			<div class="cabecera">
				<table>
					<thead>
						<tr>
							<td style="width: 50%;">
								<img src="https://www.innovationlanguageschool.com/wp-content/uploads/2021/01/logo_color.png" style="width: 100%">
							</td>
							<td style="max-width: 10%"></td>

							<td style="padding: 0; float: right; max-width: 40%">
								<ul class="empresa">
									<li>{{ $empresa->razon_social }}</li>
									<li>{{ $empresa->nit }}</li>
									<li>{{ $empresa->celular }}</li>
								</ul>
							</td> 
						</tr>
					</thead>
				</table>
				<table>
					<thead>
						<tr>
							<td class="div1" style="width: 40%">
								<ul class="data-factura">
									<li><b>Datos de la factura</b></li>
									<li><b>Factura N°:</b> <small> {{ $factura[0]->numero_factura }} </small></li>
									<li><b>Fecha factura:</b> <small> {{ $factura[0]->fecha_creacion }} </small></li>
									<li><b>Fecha vencimiento:</b> <small>{{ $factura[0]->fecha_acuerdo }}</small></li>
								</ul>
								
							</td>

							<td class="info-cliente">
								<ul class="data-client">
									<li><b>Datos del cliente</b></li>
									<li><b>Nombres:</b> <small> {{ $factura[0]->nombres }}  {{ $factura[0]->apellidos }} </small></li>
									<li><b>Documento:</b> <small> {{ $factura[0]->documento }} </small></li>
								</ul>
									
							</td>
							<td>
								@php
									$color = "text-success";
								@endphp
								<p class="estado text-success"></p>
							</td>
						</tr>		
					</thead>
				</table>
			</div>

			@if ($factura[0]->nombre_acudiente!='')
				<div class="title">
					<table>
						<tr>
							<td style="text-align: center;"> DATOS DEL ACUDIENTE </td>
						</tr>
					</table>
				</div>

				<div class="body" >
					<table>
						<thead>
							<tr>
								<td>Nombres</td>
								<td>Documento</td>
								<td>Telefono</td>
								<td>Correo</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td> {{ $factura[0]->nombre_acudiente }} </td>
								<td>{{ $factura[0]->documento_acudiente }}</td>
								<td>{{ $factura[0]->documento_acudiente }}</td>
								<td>{{ $factura[0]->documento_acudiente }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			@endif

				

			<!----->
			<div class="title">
				<table>
					<tr>
						<td style="text-align: center;"> DETALLES DEL LA FACTURA </td>
					</tr>
				</table>
			</div>

			<div class="body">
				<table style="width: 100%">
					<thead>
						<tr>
							<td>N°</td>
							<td>Descripción</td>
							<td>Cantidad</td>
							<td>Valor</td>
							<td>Total</td>
						</tr>
					</thead>
					<tbody>
						@php
							$total_pay = 0;
						@endphp
						@foreach($factura[0]->detalles as $key => $value)
							<tr>
								<td> {{ $key }} </td>
								<td> {{ $value->descripcion }} </td>
								<td> {{ $value->cantidad }} </td>
								<td>  
									@php
										echo number_format($value->precio);
									@endphp
								 </td>
								<td>
									@php
										$total =  $value->cantidad * $value->precio;
										$total_pay = $total_pay + $total;
										echo number_format($total);
									@endphp
								</td>
							</tr>
						@endforeach
						<tr>
							<td>Total</td>
							<td colspan="3"></td>
							<td>
								@php
									echo number_format($total_pay);
								@endphp
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
		
</body>
</html>