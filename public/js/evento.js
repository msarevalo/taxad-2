function contarcaracteres(){

    var total=600;

    setTimeout(function(){
        var valor=document.getElementById('descripcion');
        var respuesta=document.getElementById('res');
        var cantidad=valor.value.length;
        document.getElementById('res').innerHTML = cantidad + ' / 190 ';
    },10);

}