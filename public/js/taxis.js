function filtrar(id){
	var inicio = $('#inicio').val();
	var fin = $('#fin').val();

	//window.location.replace('../../../taxis/detalle/' + id + '/' + inicio + '/' + fin);
	
}

function minimo(id){
	var inicio = $('#inicio').val();
	var fin = $('#fin').val();
	if (fin.length==0) {fin="null";}
	document.getElementById('fin').setAttribute('min', inicio);
	document.getElementById('redireccion').setAttribute('href', "../../../../../taxis/detalle/" + id + "/" + inicio + "/" + fin);
}

function maximo(id){
	var fin = $('#fin').val();
	var inicio = $('#inicio').val();
	if (inicio.length==0) {inicio="null";}
	document.getElementById('inicio').setAttribute('max', fin);
	document.getElementById('redireccion').setAttribute('href', "../../../../../taxis/detalle/" + id + "/" + inicio + "/" + fin);
}

function imprimir(id, inicio, fin){
	var tabla_cantidades='';

		$.get('/api/cantidades/'+id+'/'+inicio+'/'+fin, function(data) {
			tabla_cantidades+='<table border="1">';
			tabla_cantidades+='	<td>Categoria</td><td>Cantidad</td><td>Valor en gasto</td>';
			for (var i=0; i<data.length; i++)
				tabla_cantidades += '<tr><td>'+data[i].nombre+'</td><td>'+data[i].conteo+'</td><td>' + data[i].suma + '</td></tr>';
				//console.log(html_select);
				//return html_select;
				tabla_cantidades+='</table>';
			//console.log(tabla_cantidades);

			var cabecera = document.getElementById("cabecera").innerHTML; 
			var divContents = document.getElementById("impresion").innerHTML;
			var histograma = document.getElementById("chart_div_histograma").innerHTML;
			var histograma1 = document.getElementById("chart_div_histograma_gasto").innerHTML;
    		var a = window.open('', '', 'height=700, width=700'); 
        	a.document.write('<html>'); 
        	a.document.write("<center>" + cabecera + "</center>"); 
        	a.document.write("<div style='width:30%'>" + divContents + "</div>");
        	a.document.write("<div style='width:30%'>" + histograma + tabla_cantidades +"</div>");
        	a.document.write("<div style='width:30%'>" + histograma1 + tabla_gastos +"</div>");
        	a.document.write('</body></html>'); 
        	a.document.close(); 
        	a.print();
		});
	/*
	var cabecera = document.getElementById("cabecera").innerHTML; 
	var divContents = document.getElementById("impresion").innerHTML;
	var histograma = document.getElementById("chart_div_histograma").innerHTML;
	var histograma1 = document.getElementById("chart_div_histograma_gasto").innerHTML;
    var a = window.open('', '', 'height=700, width=700'); 
        a.document.write('<html>'); 
        a.document.write("<center>" + cabecera + "</center>"); 
        a.document.write("<div style='width:30%'>" + divContents + "</div>");
        a.document.write("<div style='width:30%'>" + histograma + prueba +"</div>");
        a.document.write("<div style='width:30%'>" + histograma1 + "</div>");
        a.document.write('</body></html>'); 
        a.document.close(); 
        a.print(); */
}