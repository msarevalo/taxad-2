$(function(){
	$('#submenu').on('change', selectOption);
});

function selectOption(){
	var submenu = $('#submenu').val();
	if (submenu==1) {
		$('#padres').css('display', 'block');
		$('#logoMenu').css('display', 'none');
	}else{
		$('#padres').css('display', 'none');
		$('#logoMenu').css('display', 'block');
	}
}

$(function(){
	$('#iconos').on('change', icono);
});

function icono(){
	var icono = $('#iconos').val();

	$('#inicial').css('display', 'none');
	$('#seleccionado').css('display', 'block');
	$('#icon').attr('class', icono);
}

$(document).ready(function(){
	$('#iconos').select2();
});