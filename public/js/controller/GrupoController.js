$(document).on('submit','#form-create-grupo',function(e){
	var data = $(this).serialize();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN':$('meta[name=csrf-token]').attr('content')
		},
		url:'./grupo',
		method:'post',
		data:data,
		success:function(r){
			toastr.success(r['response'],'Mensaje!!!');
			$('#form-create-grupo').trigger('reset');
			$('#form-create-grupo .modal').modal('hide');
		},error:function(e){

		}
	})
	return false;
});
