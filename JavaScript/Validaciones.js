function vervalores(){
	var sAux="";
	var frm = document.getElementById("registro");
	for (i=0;i<frm.elements.length-1;i++){
		sAux += "NOMBRE: " + frm.elements[i].name + " ";
		sAux += "VALOR: " + frm.elements[i].value + "\n" ;
	}
	console.log(sAux);
}

function validateEmail(){
	var n = document.getElementById("email").value;
	var re = /^[a-zA-Z]{3,}\d{3}@ikasle\.ehu\.(es|eus)$/;
	return re.test(n);
}

function validateNombre(){
	var n = document.getElementById("nombre").value;
	var re = /^[A-Za-z]+(\s[A-Za-z]+)+$/;
	return re.test(n);
}

function validateTlf(){
	var n = document.getElementById("tlf").value;
	var re = /^[6-9][0-9]{8}$/;
	return re.test(n);
}

function validatePassword(){
	var n = document.getElementById("password").value;
	if(n.length<6)
		return false;
	return true;
}

function validar(){
	vervalores();
	var resto;
	var frm = document.getElementById("registro");
	var n = document.getElementById("especialidad").value;
	if(n == document.getElementById("especialidad").options[3].value)
		resto = 3;
	else
		resto = 4;
	for (i=0;i<frm.elements.length-resto;i++){
		if ((frm.elements[i].value.length == 0) || (/^\s*$/.test(frm.elements[i].value))){
			alert("Rellena los campos obligatorios");
			return false;
		}
	}
	if (validateEmail() == false){
		alert("El email debe ser de la forma aaaaa000@ikasle.ehu.es o aaaaa000@ikasle.ehu.es");
			return false;
	}
	if (validateNombre() == false){
		alert("Escribe un nombre y al menos un apellido");
			return false;
	}
	if (validatePassword() == false){
		alert("El password debe contener como minimo 6 caracteres");
			return false;
	}
	if (validateTlf() == false){
		alert("El telefono debe tener 9 digitos y comenzar por 6, 7, 8 y 9");
			return false;
	}
	return true;
}

function modificarcampo(){
	var n = document.getElementById("especialidad").value;
	var esp = document.getElementById("otraesp");
	var text = document.getElementById("textootro");
	if(n == document.getElementById("especialidad").options[3].value){
		esp.style.display = "inline";
		text.style.display = "inline";
	}
	else{
		esp.style.display = "none";
		text.style.display = "none";
	}
}

 function loadFile(event){
	var output = document.getElementById('output');
	var img = event.target.files[0];
	if(img != undefined){
		output.src = URL.createObjectURL(img);
		output.style.display = "inline";
	}
	else
		output.style.display = "none";
}
