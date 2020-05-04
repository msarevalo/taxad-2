$(function(){
	//$('#semana').on('change', fechas);
});

var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
var dias = ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];

function fechas(){
	var semana = $(this).val();
	

   var year = 2020;
  var week = 3;
  
  var sem = parseInt((semana[semana.length-2] + semana[semana.length-1]), 10);
  var año = semana[0] + semana[1] + semana[2] + semana[3];
  var añof = semana[0] + semana[1] + semana[2] + semana[3];
  // añadimos validación a la semana
  //if (week < 1 || week > 53) { alert("Error: la semana debe ser un número entre 1 y 53"); return false; }
  
  // obtenemos el primer y último día de la semana del año indicado
  var primer = new Date(año, 0, (sem - 1) * 7 + 1);
  var ultimo = new Date(añof, 0, (sem - 1) * 7 + 7);
  
  // mostramos el resultado
  document.getElementById("resultado").innerHTML = primer.getFullYear() + "<br>" +
    "El primer día de la " + sem + "<sup>a</sup> semana de " + año + " es " + primer.getDate() + " de " + meses[primer.getMonth()] + " (" + dias[primer.getDay()] + ")<br/>" +
    "El último día de la " + sem + "<sup>a</sup> semana de " + añof + " es " + ultimo.getDate() + " de " + meses[ultimo.getMonth()] + " (" + dias[ultimo.getDay()] + ")"; 
    document.getElementById("inicio").value = primer.getFullYear() + '-' + primer.getMonth() + '-' + primer.getDay();
}

var d = 1;
var l = 0;
var m = 0;
var mi = 0;
var j = 0;
var v = 0;
var s = 0;
var ss = 0;
var dia = "";
$(document).ready(function(){
    $('#ppL').click(function(){
        dia = "lun";
    	if (l == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', true);
            //$('#producidoL').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', false);
            d=0;
            l++;
            m=0;
            mi=0;
            j=0;
            v=0;
            s=0;
            ss=0;
        }else{
        	if (l == 1) {
        		$('#producidoL').prop('disabled', true);
        	}else{
        		$('#producidoL').prop('disabled', false);
        		sumaL();
        		l--;
        	}
        }
    });

    $('#lunes').click(function(){
        dia = "lun";
        if (l == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', true);
            //$('#producidoL').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
            $('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', true);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', false);
            d=0;
            l++;
            m=0;
            mi=0;
            j=0;
            v=0;
            s=0;
            ss=0;
        }else{
            if (l == 1) {
                $('#producidoL').prop('disabled', true);
            }else{
                $('#producidoL').prop('disabled', false);
                sumaL();
                l--;
            }
        }
    });

    $('#ppM').click(function(){
        dia = "mar";
    	if (m == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', true);
            //$('#producidoM').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', false);
            document.getElementById("ppL").required = false;
            d=0;
            l=0;
            m++;
            mi=0;
            j=0;
            v=0;
            s=0;
            ss=0;
        }else{
        	if (m == 1) {
        		$('#producidoM').prop('disabled', true);
        	}else{
        		$('#producidoM').prop('disabled', false);
        		sumaM();
        		m--;
        	}
        }
    });

    $('#martes').click(function(){
        dia = "mar";
        if (m == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', true);
            //$('#producidoM').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
            $('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', true);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', false);
            document.getElementById("ppL").required = false;
            d=0;
            l=0;
            m++;
            mi=0;
            j=0;
            v=0;
            s=0;
            ss=0;
        }else{
            if (m == 1) {
                $('#producidoM').prop('disabled', true);
            }else{
                $('#producidoM').prop('disabled', false);
                sumaM();
                m--;
            }
        }
    });

    $('#ppMi').click(function(){
        dia = "mie";
    	if (mi == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', true);
            //$('#producidoMi').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', false);
            document.getElementById("ppL").required = false;
            d=0;
            l=0;
            m=0;
            mi++;
            j=0;
            v=0;
            s=0;
            ss=0;
        }else{
        	if (mi == 1) {
        		$('#producidoMi').prop('disabled', true);
        	}else{
        		$('#producidoMi').prop('disabled', false);
        		sumaMi();
        		mi--;
        	}
        }
    });

    $('#miercoles').click(function(){
        dia = "mie";
        if (mi == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', true);
            //$('#producidoMi').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
            $('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', true);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', false);
            document.getElementById("ppL").required = false;
            d=0;
            l=0;
            m=0;
            mi++;
            j=0;
            v=0;
            s=0;
            ss=0;
        }else{
            if (mi == 1) {
                $('#producidoMi').prop('disabled', true);
            }else{
                $('#producidoMi').prop('disabled', false);
                sumaMi();
                mi--;
            }
        }
    });

    $('#ppJ').click(function(){
        dia = "jue";
    	if (j == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', true);
            //$('#producidoJ').prop('value', '0');
            document.getElementById("ppL").required = false;
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi=0;
            j++;
            v=0;
            s=0;
            ss=0;
        }else{
        	if (j == 1) {
        		$('#producidoJ').prop('disabled', true);
        	}else{
        		$('#producidoJ').prop('disabled', false);
        		sumaJ();
        		j--;
        	}
        }
    });

    $('#jueves').click(function(){
        dia = "jue";
        if (j == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', true);
            //$('#producidoJ').prop('value', '0');
            document.getElementById("ppL").required = false;
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#producidoV').prop('disabled', false);
            $('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', true);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi=0;
            j++;
            v=0;
            s=0;
            ss=0;
        }else{
            if (j == 1) {
                $('#producidoJ').prop('disabled', true);
            }else{
                $('#producidoJ').prop('disabled', false);
                sumaJ();
                j--;
            }
        }
    });

    $('#ppV').click(function(){
        dia = "vie";
    	if (v == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', true);
            document.getElementById("ppL").required = false;
            //$('#producidoV').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
			$('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi=0;
            j=0;
            v++;
            s=0;
            ss=0;
        }else{
        	if (v == 1) {
        		$('#producidoV').prop('disabled', true);
        	}else{
        		$('#producidoV').prop('disabled', false);
        		sumaV();
        		v--;
        	}
        }
    });

    $('#viernes').click(function(){
        dia = "vie";
        if (v == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', true);
            document.getElementById("ppL").required = false;
            //$('#producidoV').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', true);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi=0;
            j=0;
            v++;
            s=0;
            ss=0;
        }else{
            if (v == 1) {
                $('#producidoV').prop('disabled', true);
            }else{
                $('#producidoV').prop('disabled', false);
                sumaV();
                v--;
            }
        }
    });

    $('#ppS').click(function(){
        dia = "sab";
    	if (s == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', true);
            document.getElementById("ppL").required = false;
			//$('#producidoS').prop('value', '0');
			sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#spp').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi=0;
            j=0;
            v=0;
            s++;
            ss=0;
        }else{
        	if (s == 1) {
        		$('#producidoS').prop('disabled', true);
        	}else{
        		$('#producidoS').prop('disabled', false);
        		sumaS();
        		s--;
        	}
        }
    });

    $('#sabado').click(function(){
        dia = "sab";
        if (s == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
            $('#producidoS').prop('disabled', true);
            document.getElementById("ppL").required = false;
            //$('#producidoS').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', true);
            $('#spp').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi=0;
            j=0;
            v=0;
            s++;
            ss=0;
        }else{
            if (s == 1) {
                $('#producidoS').prop('disabled', true);
            }else{
                $('#producidoS').prop('disabled', false);
                sumaS();
                s--;
            }
        }
    });

    $('#spp').click(function(){
        dia = "sin";
        if (ss == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
            $('#producidoS').prop('disabled', false);
            document.getElementById("ppL").required = false;
            //$('#producidoS').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi=0;
            j=0;
            v=0;
            s=0;
            ss++;
        }
    });

    $('#sinpp').click(function(){
        dia = "sin";
        if (ss == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
            $('#producidoS').prop('disabled', false);
            document.getElementById("ppL").required = false;
            //$('#producidoS').prop('value', '0');
            sumaL();
            sumaM();
            sumaMi();
            sumaJ();
            sumaV();
            sumaS();
            sumaD();
            semanaProd();
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            $('#spp').prop('checked', true);
            d=0;
            l=0;
            m=0;
            mi=0;
            j=0;
            v=0;
            s=0;
            ss++;
        }
    });
});

//domingo

$(function(){
	$('#producidoD').on('change', sumaD);
	$('#gastosD').on('change', sumaD);
	$('#otrosD').on('change', sumaD);
});

//lunes

$(function(){
	$('#producidoL').on('change', sumaL);
	$('#gastosL').on('change', sumaL);
	$('#otrosL').on('change', sumaL);
});

//martes

$(function(){
	$('#producidoM').on('change', sumaM);
	$('#gastosM').on('change', sumaM);
	$('#otrosM').on('change', sumaM);
});

//miercoles

$(function(){
	$('#producidoMi').on('change', sumaMi);
	$('#gastosMi').on('change', sumaMi);
	$('#otrosMi').on('change', sumaMi);
});

//jueves

$(function(){
	$('#producidoJ').on('change', sumaJ);
	$('#gastosJ').on('change', sumaJ);
	$('#otrosJ').on('change', sumaJ);
});

//viernes

$(function(){
	$('#producidoV').on('change', sumaV);
	$('#gastosV').on('change', sumaV);
	$('#otrosV').on('change', sumaV);
});

//sabado

$(function(){
	$('#producidoS').on('change', sumaS);
	$('#gastosS').on('change', sumaS);
	$('#otrosS').on('change', sumaS);
});

function sumaD(){
	var pro = parseInt($('#producidoD').val());
	var gas = parseInt($('#gastosD').val());
	var otro = parseInt($('#otrosD').val());
	var total = parseInt($('#totalD').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalD").value = total;

	semanaProd();
	semanaGas();
}

function sumaL(){
    var omi = dia;
    if (omi!=="lun") {
        var pro = parseInt($('#producidoL').val());   
    }else{
        var pro = 0;
    }
	
	var gas = parseInt($('#gastosL').val());
	var otro = parseInt($('#otrosL').val());
	var total = parseInt($('#totalL').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalL").value = total;

	semanaProd(dia);
	semanaGas();
}

function sumaM(){
    var omi = dia;
    if (omi!=="mar") {
        var pro = parseInt($('#producidoM').val());
    }else{
        var pro = 0;
    }


	var gas = parseInt($('#gastosM').val());
	var otro = parseInt($('#otrosM').val());
	var total = parseInt($('#totalM').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalM").value = total;

	semanaProd();
	semanaGas();
}

function sumaMi(){
    var omi = dia;
    if (omi!=="mie") {
        var pro = parseInt($('#producidoMi').val());
    }else{
        var pro = 0;
    }
	
	var gas = parseInt($('#gastosMi').val());
	var otro = parseInt($('#otrosMi').val());
	var total = parseInt($('#totalMi').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalMi").value = total;

	semanaProd();
	semanaGas();
}

function sumaJ(){
    var omi = dia;
    if (omi!=="jue") {
        var pro = parseInt($('#producidoJ').val());
    }else{
        var pro = 0;
    }
	var gas = parseInt($('#gastosJ').val());
	var otro = parseInt($('#otrosJ').val());
	var total = parseInt($('#totalJ').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalJ").value = total;

	semanaProd();
	semanaGas();
}

function sumaV(){
    var omi = dia;
    if (omi!=="vie") {
        var pro = parseInt($('#producidoV').val());
    }else{
        var pro = 0;
    }
	
	var gas = parseInt($('#gastosV').val());
	var otro = parseInt($('#otrosV').val());
	var total = parseInt($('#totalV').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalV").value = total;

	semanaProd();
	semanaGas();
}

function sumaS(){
    var omi = dia;
    if (omi!=="sab") {
        var pro = parseInt($('#producidoS').val());
    }else{
        var pro = 0;
    }
	
	var gas = parseInt($('#gastosS').val());
	var otro = parseInt($('#otrosS').val());
	var total = parseInt($('#totalS').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalS").value = total;

	semanaProd();
	semanaGas();
}

function semanaProd(){
    //alert(dia);
    var omi = dia;
	var prod = parseInt($('#producidoD').val());
    if(omi=="lun"){
        var prol = 0;
    }else{
        var prol = parseInt($('#producidoL').val());
    }

    if(omi=="mar"){
        var prom = 0;
    }else{
        var prom = parseInt($('#producidoM').val());
    }

    if(omi=="mie"){
        var promi = 0;
    }else{
        var promi = parseInt($('#producidoMi').val());
    }

    if(omi=="jue"){
        var proj = 0;
    }else{
        var proj = parseInt($('#producidoJ').val());
    }

    if(omi=="vie"){
        var prov = 0;
    }else{
        var prov = parseInt($('#producidoV').val());
    }

    if(omi=="sab"){
        var pros = 0;
    }else{
        var pros = parseInt($('#producidoS').val());
    }
	
	var total = prod + prol + prom + promi + proj + prov + pros;

	document.getElementById("producidoSem").value = total;
	pago();

}

function semanaGas(){
	var gasd = parseInt($('#gastosD').val());
	var otrod = parseInt($('#otrosD').val());
	var gasl = parseInt($('#gastosL').val());
	var otrol = parseInt($('#otrosL').val());
	var gasm = parseInt($('#gastosM').val());
	var otrom = parseInt($('#otrosM').val());
	var gasmi = parseInt($('#gastosMi').val());
	var otromi = parseInt($('#otrosMi').val());
	var gasj = parseInt($('#gastosJ').val());
	var otroj = parseInt($('#otrosJ').val());
	var gasv = parseInt($('#gastosV').val());
	var otrov = parseInt($('#otrosV').val());
	var gass = parseInt($('#gastosS').val());
	var otros = parseInt($('#otrosS').val());
	
	var total = gasd + otrod+ gasl + otrol + gasm + otrom + gasmi + otromi + gasj + 
	otroj + gasv + otrov + gass + otros;

	document.getElementById("gastosSem").value = total;
	pago();

}

function pago(){
	var producidos = parseInt($('#producidoSem').val());
	var gastos = parseInt($('#gastosSem').val());

	var total = producidos - gastos;

	document.getElementById("pagar").value = total;
}

$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 0,
 isRTL: false,
 showMonthAfterYear: false,
 };

$.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
    $("#inicio").datepicker({
        beforeShowDay: function(date){ return[(date.getDay() == 0),""];},
        maxDate: '-8D'
    });
});


function fechaFin(){
    var inicio = $('#inicio').val();
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
    document.getElementById("fin").value = fecha;
}

function sumarDias(fecha, dias){
  fecha.setDate(fecha.getDate() + dias);
  return fecha;
}