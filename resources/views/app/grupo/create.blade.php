<form action="" id="form-create-grupo">
	<div class="modal fade" id="modal-create-grupo">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="id_nivel">Nivel</label>
							<select name="id_nivel" class="form-control" required>
								<option></option>
								@foreach($niveles as $nivel)
									<option value="{{ $nivel->id }}"> {{ $nivel->nombre }} </option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="fecha_inicio">Nombre del grupo</label>
							<input type="text" name="nombre" class="form-control" placeholder="Grupo 1" required>
						</div>
						<div class="form-group col-md-6">
							<label for="fecha_inicio">Fecha inicio</label>
							<input type="date" name="fecha_inicio" class="form-control">
						</div>
						<div class="form-group col-md-6">
							<label for="fecha_inicio">Fecha fin</label>
							<input type="date" name="fecha_fin" class="form-control">
						</div>
					</div>
				</div>	
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-primary" >Guardar</button>
				</div>
			</div>
		</div>
	</div>
</form>
	
<script src="{{ url('js/controller/GrupoController.js') }}"></script>