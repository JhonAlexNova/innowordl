$(document).on('change','.register select[name=id_rol]',(e)=>{
	if(e.target.value!=6){
		$('.asignacion, .fuente, .id_dep, .id_ciudad, .telefono').hide();
	}else{
		$('.asignacion, .fuente, .id_dep, .id_ciudad, .telefono').show();
	}
});