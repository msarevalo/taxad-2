var html;

function mostar(usuario, nombre, fecha, mensaje){
	//console.log(mensaje);
	//var prueba = usuario + nombre + hora + mensaje;
	
	html = "<strong>Usuario: </strong>" + usuario + "<br/>" +
	"<strong>Nombre: </strong>" + nombre + "<br/>" +
	"<strong>Fecha y hora de envio: </strong>" + fecha + "<br/>" +
	"<strong>Mensaje:</strong><br/>" + mensaje;


	$('#myModal').on('shown.bs.modal', function (e) {
		$("#mensaje_modal").html(html); 
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
		url: '../leido',
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

function filtrar(actual, valor){
	if (valor==1) {
		if (actual!=1) {
			location.href ="../buzon";
		}
	}else{
		if (valor==2) {
			if (actual!=2) {
				location.href ="../buzon/leidas";
			}
		}else{
			if (actual!=3) {
				location.href ="../buzon/pendientes";
			}
		}
	}
}