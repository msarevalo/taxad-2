var html;

function mostar(usuario, nombre, fecha, mensaje){
	//console.log(mensaje);
	//var prueba = usuario + nombre + hora + mensaje;
	
	html = "<strong>Usuario: </strong>" + usuario + "<br/>" +
	"<strong>Nombre: </strong>" + nombre + "<br/>" +
	"<strong>Fecha y hora de envio: </strong>" + fecha + "<br/>" +
	"<strong>Mensaje:</strong><br/>" + mensaje;


	$('#myModal').on('shown.bs.modal', function (e) {
		$("#video").html(html); 
	});

}

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function leido(mensaje,usuario){
	var prueba = mensaje;
	var u = usuario;
	
	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
	});

	$.ajax({
		url: '../../leido',
		type: 'post',
		data: {
			_token: CSRF_TOKEN,
			user: u,
			mensaje: prueba
		},
		dataType: 'json',
		success: function(response) {
        //Acciones si success
    	},

	});
	//alert(usuario);
}