function comparar(){
	var nueva = document.getElementById("npass").value;
	var repetir = document.getElementById("rpass").value;

	if(nueva != repetir){
		document.getElementById("falta").innerHTML = "Las contraseñas no coinciden";
		document.getElementById("enviar").disabled=true;
	}else{
		document.getElementById("enviar").disabled=false;
		document.getElementById("falta").innerHTML = "";
	}
}