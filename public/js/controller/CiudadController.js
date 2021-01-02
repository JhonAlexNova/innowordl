var id_departamento = '';

$(document).on('change','select[name=id_departamento]',function(e){
	id_departamento = e.target.value;
	get_ciudades();
});

function get_ciudades(){
	$.ajax({
		'url':'/app/ciudad?id_departamento='+id_departamento,
		'method':'get',
		success:function(e){
			var ciudades = '<option></option>';
			$.each(e,function(el){
				ciudades += `<option value="${this.id}">${this.nombre}</option>`;
			});

			$('select[name=id_ciudad]').html(ciudades);
			$('select[name=id_ciudad]').selectpicker("refresh");
		}
	})
}


