<div class="modal-footer" style="padding-right: 0">
	<a class="btn btn-outline-primary" onclick="init_pdf()" style="padding: 3px">Generar</a>
</div>
<div class="table-resonsive">
	<table  class="table table-bordered" role="grid" aria-describedby="example_info" style="width: 100%">
		<thead>
			<tr>
				<td>Estado</td>
				<td>Referencia</td>
				<td>Creación</td>
				<td>Monto</td>
				<td>Descuento</td>
				<td>Total</td>
				<td>vencimiento</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			@foreach($facturas as $key => $value)
			@php
				$fecha = date('Y-m-d');
				if($value->fecha_acuerdo>$fecha && $value->estado=='no pagada'){
					$color = 'bg-success';
				}else if($value->fecha_acuerdo>=$fecha && $value->estado=='no pagada'){
					$color = 'bg-warning';
				}else if($value->fecha_acuerdo<$fecha && $value->estado=='no pagada'){
					$color = 'bg-danger';
				}else{
					$color = 'bg-success';
				}
				
			@endphp

				<tr class="<?php echo $color; ?>">
					<td> {{ $value->estado }} </td>
					<td> {{ $value->numero_factura }} </td>
					<td> {{ $value->fecha_creacion }} </td>
					<td> 
						@php
							echo number_format($value->total);
						@endphp
					 </td>
					<td> 
						@php
							$descuento = $value->total - $value->descuento_fac;
							echo number_format($descuento);
						@endphp
					 </td>
					 <td> 
					 	@php
					 		$total = $value->total - $descuento;
					 		echo number_format($total);
					 	@endphp
					  </td>
					  <td> {{ $value->fecha_acuerdo }} </td>
					  <td>
							<div class="dropdown ml-auto text-right ">
								<div class="btn-link" data-toggle="dropdown" aria-expanded="true">
									<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
								</div>
								<div class="dropdown-menu dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-106px, -115px, 0px);">
									<a class="dropdown-item" href="{{ url('app/factura',$value->id_factura) }}?page=generar_factura_pdf">Descargar</a>
									<a class="dropdown-item" href="{{ url('app/factura',$value->id_factura) }}?page=enviar_mail">Enviar correo</a>
									<a class="dropdown-item confirmar_pago" href="javascript:void(0);" id_factura="{{ $value->id_factura }}" page="confirmar_pago" id_user="{{ $value->id_user }}" >Confirmar pago</a>
								</div>
							</div> 
						</td>

				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="modal fade" id="modal-id">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<input type="hidden" name="id_user" value="{{ $user->id_user }}">
				<label>1. Datos</label>
				<div class="row">
					<div class="form-group col-md-3">
						<label>Fecha acuerdo</label>
						<input type="date" name="fecha_acuerdo" class="form-control">
						<p class="text-danger error-fecha error"></p>
					</div>
					<div class="form-group col-md-3">
						<label>Nombres</label>
						<input type="text" name="nombres" disabled="on" value="{{ $user->nombres }}" class="form-control"> 
					</div>
					<div class="form-group col-md-3">
						<label>Apellidos</label>
						<input type="text" name="nombres" disabled="on" value="{{ $user->apellidos }}" class="form-control"> 
					</div>
					<div class="form-group col-md-3">
						<label>Documento</label>
						<input type="text" name="documento" disabled="on" value="{{ $user->documento }}" class="form-control"> 
					</div>
				</div>
				
				<div class="row" id="acudiente" style="display: none">
					<div class="col-md-12">
						<label>2. Acudiente</label>
					</div>
					
					<div class="form-group col-md-3">
						<label>Nombres</label>
						<input type="text" name="nombres_acud"  placeholder="Nombres" class="form-control"> 
					</div>
					<div class="form-group col-md-3">
						<label>Documento</label>
						<input type="text" name="documento_acud"  placeholder="Documento" class="form-control"> 
					</div>
					<div class="form-group col-md-3">
						<label>Correo</label>
						<input type="text" name="correo_acud"  placeholder="Correo" class="form-control"> 
					</div>
					<div class="form-group col-md-3">
						<label>Telefono</label>
						<input type="text" name="telefono_acud"  placeholder="Telefono" class="form-control"> 
					</div>
				</div>
				<br><br>
				2. Detalles factura
				<div class="modal-footer" style="padding-right: 0">
					<a href="javascript:void(0);" onclick="nuevo()">Añadir</a>
				</div>
				<div class="row">
					<table id="factura" class="table table-bordered">
						<thead>
							<tr>
								<td>N°</td>
								<td>Cantidad</td>
								<td>Descripcion</td>
								<td>Precio</td>
								<td>Acciones</td>
							</tr>
						</thead>
						<tbody class="items-factura">
							<tr>
								<td><input type="number"   value="0" class="form-control" disabled="on"></td>
								<td><input type="number" name="cantidad-0"  class="form-control"></td>
								<td><input type="text"  name="descripcion-0" class="form-control"></td>
								<td><input type="number" name="precio-0"  class="form-control"></td>
								<td><a href="">Eliminar</a></td>
							</tr>
						</tbody>
						<form name="factura" action="{{ route('factura.store') }}" method="POST">
							@csrf
							<input type="hidden" name="id_user" value="{{ $user->id_user }}">
						</form>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-outline-primary btn-submit"  onclick="generar()">Generar</button>
			</div>
		</div>
	</div>
</div>

<!---modal-->
<form method="post" name="form-confirm-pay">
	<div class="modal fade" id="modal-confirm-pay">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					
						<div class="row">
							<input type="hidden" name="id_factura">
							<input type="hidden" name="page">
							<input type="hidden" name="id_user">
							<div class="form-group col-md-6">
								<label for="">Fecha</label>
								<input type="date" name="fecha" class="form-control" required>
							</div>
							<div class="form-group col-md-6">
								<label for="">Hora</label>
								<input type="time" name="hora" class="form-control" required>
							</div>
							<div class="form-group col-md-12">
								<label for="">Observación</label>
								<textarea name="observacion" rows="6" class="form-control"></textarea>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-outline-primary">Aceptar</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	var cont = 0;
	var data = [];
	var acudiente = {nom:'',doc:'',email:'',tel:''};
	var link_confirm_pay = '';



	function nuevo(send=null){
		var cantidad = $(`input[name=cantidad-${cont}]`).val();
		var descripcion = $(`input[name=descripcion-${cont}]`).val();
		var precio = $(`input[name=precio-${cont}]`).val();
		var descuento = $(`input[name=descuento-${cont}]`).val();
		var id_user = $('input[name=id_user]').val();
		var fecha_acuerdo = $('input[name=fecha_acuerdo]').val();

		acudiente['nom'] = $('input[name=nombres_acud]').val();
		acudiente['doc'] = $('input[name=documento_acud]').val();
		acudiente['email'] = $('input[name=correo_acud]').val();
		acudiente['tel'] = $('input[name=telefono_acud]').val();
		//
		if(!fecha_acuerdo){
			$('.error-fecha').html('El campo es requerido.');
			setTimeout(()=>{
				$('.error').html('');
			},1500);
		}else{
			if(cantidad!='' && descripcion!='' && precio!='' && descuento!=''){
				cont = cont + 1;
				var form = ` 
					<tr>
						<td><input type="number"   value="${cont}" class="form-control" disabled="on"></td>
						<td><input type="number" name="cantidad-${cont}"  class="form-control"></td>
						<td><input type="text"  name="descripcion-${cont}" class="form-control"></td>
						<td><input type="number" name="precio-${cont}"  class="form-control"></td>
						<td><a href="">Eliminar</a></td>
					</tr>
				 `;
				 var obj = {id_user:id_user, fecha_acuerdo:fecha_acuerdo, cantidad:cantidad, descripcion:descripcion, precio:precio, descuento:descuento, acudiente:acudiente};
			 	 data.push(obj);
			 	 if(!send){
			 	 	$('.items-factura').append(form);
			 	 }
				 
			}
		}

			
	}

	function generar(){
		nuevo(true);
		if(data.length>0){
			 var url_string = window.location.href; // www.test.com?filename=test
		    var url = new URL(url_string);
		    var id_det_asig = url.searchParams.get("id_det_asig");

			$('.btn-submit').attr('disabled',true);
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				url:'{{ route('factura.store') }}?id_det_asig='+id_det_asig,
				method:'post',
				data:{data:data},
				success:function(r){
					//console.log(r);
					location.reload();
				},error:function(e){
					console.log(e);
				}
			})
		}
	}


	function init_pdf(){
		
		var edad = document.getElementsByClassName('edad');
		
		if(edad.length>0){
			edad = parseInt(edad[0].innerText);
			if(!isNaN(edad)){				
				if(edad<18){
					$('#acudiente').show();
				}
				$('#modal-id').modal('show');
			}
		}else{
			toastr.success('Asigne una edad al usuario para poder generar la factura.','Mensaje',{ timeOut: 5000 });
		}

		

	}


	$(document).on('click','.confirmar_pago',function(e){
		$('input[name=id_factura]').val(e.target.attributes.id_factura.value);
		$('input[name=id_user]').val(e.target.attributes.id_user.value);
		$('input[name=page]').val(e.target.attributes.page.value);
		$('#modal-confirm-pay').modal('show');	
	});

	$(document).on('submit','form[name=form-confirm-pay]',function(e){
		e.preventDefault();
		var form = $(this).serialize();
		var id_factura = $('input[name=id_factura]').val();
		var path = "{{ url('app/factura') }}/"+id_factura+'?'+form;
		location.href = path;
	});

</script>