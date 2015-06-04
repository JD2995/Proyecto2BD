//Función que dirige hacia el perfil de una persona utilizando su id
function verPerfil(persona_id,tipo){
	var tipo_nombre;
	if(tipo == 1){
		tipo_nombre="Ornitólogo";
	}
	else{
		tipo_nombre="Aficionado";
	}
	window.location = 'perfilPersona.php?id='+persona_id+"&tipo="+tipo_nombre;
}

function abrirModal(fuente){
	var modalObj = $(modalFoto).modal(); // initialize
	$("#imagen").attr("src",fuente);
	modalObj.modal('show'); // show
}