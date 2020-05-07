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


function ingresado(cantidad, valor){
	var suma = 0;
	var contador = 0;
	for(var i=1; i<=cantidad;i++){
		var val = parseInt($('#input-range-box-' + i).val());
		if(val!==0){
			contador++;
		}
		suma += val;
	}
	var html = "";
	if (suma>valor) {
		html = "<p style='color: red'>" + suma + "</p>";
		document.getElementById('enviar').disabled=true;
	}else{
		if (suma<valor) {
			html = "<p style='color: blue'>" + suma + "</p>";
			document.getElementById('enviar').disabled=true;
		}else{
			html = "<p style='color: green'>" + suma + "</p>";
			if (contador==cantidad) {
				$('#enviar').removeAttr("disabled");
			}			
		}
	}
	$('#ingreso').html(html);
}

function sumarDias(fecha, dias){
  fecha.setDate(fecha.getDate() + dias);
  return fecha;
}

function ciclo(valor, inicio){
	var inicio1 = new Date(inicio + "T00:00:00");
    //alert(sumarDias(inicio1, 6));
    var fin = sumarDias(inicio1, 6);

    var dia = fin.getDate();
    if (dia<10) {
        dia = "0" + dia;
    }
    var mes = fin.getMonth()+1;
    if (mes<10) {
        mes = "0" + mes;
    }
    var año = fin.getFullYear();

    var fecha = año + "-" + mes + "-" + dia;

	var ingre = '<p>0</p>';
	$('#ingreso').html(ingre);
	document.getElementById('enviar').disabled=true;
	var cantidad = $("#cantidad").val();
	var html = "";
	for(var i=1; i<=cantidad;i++){
		html += 
			'<div id"gasto' + i + '" name="gasto' + i + '">' +
				'<div class="form-group row">' +
    				'<label for="fecha" class="col-md-4 col-form-label text-md-right">Fecha de Factura</label>' +
					'<div class="col-md-6">' + 
        				'<input id="fecha' + i + '" type="date" class="form-control" name="fecha' + i + '" required autofocus min="' + inicio + '" max="' + fecha + '">' +
    				'</div>' +
				'</div>' +
				'<div class="form-group row">' +
    				'<label for="pagoa" class="col-md-4 col-form-label text-md-right">Pagado a</label>' +
					'<div class="col-md-6">' + 
        				'<input id="pagoa' + i + '" type="text" class="form-control" name="pagoa' + i + '" required autofocus">' +
    				'</div>' +
				'</div>' +
				'<div class="form-group row">' +
					'<label for="categoria-'+i+'" class="col-md-4 col-form-label text-md-right">Valor del gasto</label>' +
					'<div class="col-md-6" style="display: inline-block; width: 100%">' +
						'<div class="input-group">' +
							'<input type="range" min="1" max="'+ valor +'" step="1" onchange="barra(this.id), ingresado('+cantidad+', '+valor+')" class="input-range-bar" id="input-range-bar-'+ i +'" value="0">' +
							'<div class="input-group-addon">' + 
								'<input type="number" min="1" max="'+ valor +'" step="1" onchange="caja(this.id), ingresado('+cantidad+', '+valor+')" class="input-range-box" id="input-range-box-'+ i +'" value="0" name="valor'+i+'">' +
							'</div>' +
						'</div>' +
					'</div>' +
				'</div>' +
				'<div class="form-group row">' +
					'<label for="categoria-'+i+'" class="col-md-4 col-form-label text-md-right">Categoria Gasto</label>' +
					'<div class="col-md-6" style="display: inline-block; width: 100%">' +
	    				'<select class="form-control mb-2 buscador" name="categoria'+i+'" id="categoria-'+i+'" required style="text-transform: capitalize" onchange="selectDescripcion(this.value, '+i+')">' +
							'<option selected value="" disabled>Seleccione una categoria</option>';
							html += selectCategoria('categoria-'+i);
						html += '</select>' +
					'</div>' +
				'</div>' +
				'<div class="form-group row">' +
					'<label for="descripcion-'+i+'" class="col-md-4 col-form-label text-md-right">Descripcion Gasto</label>' +
					'<div class="col-md-6" style="display: inline-block; width: 100%">' +
	    				'<select class="form-control mb-2 buscador" name="descripcion'+i+'" id="descripcion-'+i+'" required style="text-transform: capitalize"  onchange="otros('+i+')">' +
							'<option selected value="" disabled>Seleccione una descripcion</option>' +
						'</select>' +
					'</div>' +
				'</div>' +
				'<div id="otro-'+i+'"></div>' +
				'<div class="form-group row">' +
    				'<label for="factura-' +i+ '" class="col-md-4 col-form-label text-md-right">Factura</label>' +
					'<div class="col-md-6">' +
						'<input id="factura' +i+ '" type="file" class="" name="factura'+i+'" required autofocus accept="application/pdf">' +
    				'</div>' +
				'</div>' +
			'</div><hr>';
	}
	$('#respuesta').html(html);
}


function selectCategoria(id){
	var html_select='';
	//ajax
	$.get('/api/categoria', function(data) {
		var html_select='<option selected value="" disabled>Seleccione una categoria</option>';
		for (var i=0; i<data.length; i++)
			html_select += '<option value="'+data[i].id+'">'+data[i].category+'</option>';
		//console.log(html_select);
		//return html_select;
		$(document).ready(function(){
			$('.buscador').select2();
		});
		$('#'+id).html(html_select);
	});
}

function selectDescripcion(id, conteo){
	var html_select='';
	//ajax
	$.get('/api/categoria/'+id+'/descripciones', function(data) {
		var html_select='<option selected value="" disabled>Seleccione una descripcion</option>';
		for (var i=0; i<data.length; i++){
			if (id==32) {
				html_select += '<option value="'+data[i].id+'" selected>'+data[i].description+'</option>';
			}else{
				html_select += '<option value="'+data[i].id+'">'+data[i].description+'</option>';
			}
		}
		//console.log(html_select);
		//return html_select;
		$(document).ready(function(){
			$('.buscador').select2();
		});
		$('#descripcion-'+conteo).html(html_select);
		if (id==32) {
			var otro = 
			'<div class="form-group row">' +
    			'<label for="otros-'+conteo+'" class="col-md-4 col-form-label text-md-right">Otro</label>' +
    			'<div class="col-md-6">' +
        			'<input id="otros-'+conteo+'" placeholder="Escriba la descripcion del gasto" type="text" class="form-control" name="otros'+conteo+'" autofocus>' +
				'</div>' +
			'</div>';
			$('#otro-'+conteo).html(otro);
		}else{
			var otro = "<div></div>"
			$('#otro-'+conteo).html(otro);
		}
	});
}

function otros(conteo){
	var combo = document.getElementById("descripcion-"+conteo);
	var selected = combo.options[combo.selectedIndex].text;
	if (selected == "Otro Servicio") {
		var otro = 
			'<div class="form-group row">' +
    			'<label for="otros-'+conteo+'" class="col-md-4 col-form-label text-md-right">Otro</label>' +
    			'<div class="col-md-6">' +
        			'<input id="otros-'+conteo+'" placeholder="Escriba la descripcion del gasto" type="text" class="form-control" name="otros'+conteo+'" autofocus>' +
				'</div>' +
			'</div>';
		$('#otro-'+conteo).html(otro);
	}else{
		if(selected == "Cambio de Aceite"){
			var otro = 
			'<div class="form-group row">' +
    			'<label for="km-'+conteo+'" class="col-md-4 col-form-label text-md-right">Kilometraje</label>' +
    			'<div class="col-md-6">' +
        			'<input id="km-'+conteo+'" placeholder="Escriba el kilometraje del vehiculo" type="number" class="form-control" name="km'+conteo+'" autofocus>' +
				'</div>' +
			'</div>';
			$('#otro-'+conteo).html(otro);
		}else{
			var otro = "<div></div>"
			$('#otro-'+conteo).html(otro);
		}
	}
}

