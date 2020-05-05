function barra(id){
	var valor = parseInt($('#' + id).val());
	var numero = id.split('-');
	
	document.getElementById("input-range-box-" + numero[3]).value=valor;
}

function caja(id){
	var valor = parseInt($('#' + id).val());
	var numero = id.split('-');
	
	document.getElementById("input-range-bar-" + numero[3]).value=valor;
}

function ingresado(cantidad){
	var suma = 0;
	var contador = 0;
	for(var i=0; i<=cantidad;i++){
			var val = parseInt($('#input-range-box-' + i).val());
			if(!isNaN(val)){
			suma += val;
		}
	}
	console.log(suma);
	var html = "";
	if (suma>100) {
		html = "<p style='color: red'>" + suma + "%</p>";
		document.getElementById('enviar').disabled=true;
	}else{
		html = "<p style='color: green'>" + suma + "%</p>";
		$('#enviar').removeAttr("disabled");			
	}
	$('#ingreso').html(html);
}