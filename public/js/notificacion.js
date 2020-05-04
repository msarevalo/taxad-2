function notificaciones(id){	

	//var usuario = $(this).val();
	//ajax
	$.get('/api/notificaciones/'+id+'/alertas', function(data) {
		var largo= data[0].conteo;
		//console.log(largo);
		if (largo!=0) {
			$('#not').html(largo);
		}
	});
	//alert(id);
}