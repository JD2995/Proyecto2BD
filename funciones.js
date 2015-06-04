//Función para cambiar los ordenes dependiendo de la clase seleccionada
function cambioOrden(clase)
{
	$.ajax({
		type: "GET",
		url: "catalogoAves.php?clase="+clase,
		data: "clase =" + clase,
		success: function(result){
			var select= document.catalogos.orden;
			var arrayOrden= result.split(",");	//Crea array con los resultados de la BD
			var indOrden= 0;
			select.options.length=0;	//Limpia la lista
			document.catalogos.suborden.length=0;
			document.catalogos.familia.length=0;
			document.catalogos.genero.length=0;
			document.catalogos.especie.length=0;
			
			//Recorre el array y agrega los elementos en el select
			while(indOrden < arrayOrden.length){
				select.options[indOrden]= new Option(arrayOrden[indOrden],arrayOrden[indOrden],true,false);
				indOrden++;
			}
			//Selecciona el primer elemento del array
			if(arrayOrden.length>0){
				cambioSubOrden(arrayOrden[0]);
			}
		}
	});
};

//Función para cambiar los subordenes dependiendo del orden seleccionada
function cambioSubOrden(orden)
{
	
	$.ajax({
		type: "GET",
		url: "catalogoAves.php?orden="+orden,
		data: "clase =" + orden,
		success: function(result){
			
			var select= document.catalogos.suborden;
			var arraySubOrden= result.split(",");	//Crea array con los resultados de la BD
			var indSubOrden= 0;
			select.options.length=0;	//Limpia la lista
			document.catalogos.familia.length=0;
			document.catalogos.genero.length=0;
			document.catalogos.especie.length=0;
			
			//Recorre el array y agrega los elementos en el select
			while(indSubOrden < arraySubOrden.length){
				select.options[indSubOrden]= new Option(arraySubOrden[indSubOrden],arraySubOrden[indSubOrden],true,false);
				indSubOrden++;
			}
			//Selecciona el primer elemento del array
			if(arraySubOrden.length>0){
				cambioFamilia(arraySubOrden[0]);
			}
		}
	});
};

//Función para cambiar los subordenes dependiendo del orden seleccionada
function cambioFamilia(suborden)
{
	$.ajax({
		type: "GET",
		url: "catalogoAves.php?suborden="+suborden,
		data: "suborden =" + suborden,
		success: function(result){
			
			var select= document.catalogos.familia;
			var arrayFamilia= result.split(",");	//Crea array con los resultados de la BD
			var indFamilia= 0;
			select.options.length=0;	//Limpia la lista
			document.catalogos.genero.length=0;
			document.catalogos.especie.length=0;
			
			//Recorre el array y agrega los elementos en el select
			while(indFamilia < arrayFamilia.length){
				select.options[indFamilia]= new Option(arrayFamilia[indFamilia],arrayFamilia[indFamilia],true,false);
				indFamilia++;
			}
			//Selecciona el primer elemento del array
			if(arrayFamilia.length>0){
				cambioGenero(arrayFamilia[0]);
			}
		}
	});
};

//Función para cambiar los géneros dependiendo de la familia seleccionada
function cambioGenero(familia)
{
	$.ajax({
		type: "GET",
		url: "catalogoAves.php?familia="+familia,
		data: "familia =" + familia,
		success: function(result){
			var select= document.catalogos.genero;
			var arrayGenero= result.split(",");	//Crea array con los resultados de la BD
			var indGenero= 0;
			select.options.length=0;	//Limpia la lista
			document.catalogos.especie.length=0;
			
			//Recorre el array y agrega los elementos en el select
			while(indGenero < arrayGenero.length){
				select.options[indGenero]= new Option(arrayGenero[indGenero],arrayGenero[indGenero],true,false);
				indGenero++;
			}
			//Selecciona el primer elemento del array
			if(arrayGenero.length>0){
				cambioEspecie(arrayGenero[0]);
			}
		}
	});
};

//Función para cambiar los especies dependiendo del género seleccionada
function cambioEspecie(genero)
{
	$.ajax({
		type: "GET",
		url: "catalogoAves.php?genero="+genero,
		data: "genero =" + genero,
		success: function(result){
			
			var select= document.catalogos.especie;
			var arrayEspecie= result.split(",");	//Crea array con los resultados de la BD
			var indEspecie= 0;
			select.options.length=0;	//Limpia la lista
			
			//Recorre el array y agrega los elementos en el select
			while(indEspecie < arrayEspecie.length){
				select.options[indEspecie]= new Option(arrayEspecie[indEspecie],arrayEspecie[indEspecie],true,false);
				indEspecie++;
			}
		}
	});
};

//Función para mostrar preview de la imagen a subir
function mostrarPreview(input) {
	if (input.files && input.files[0]) {
		
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#imagenTemporal')
				.attr('src', e.target.result)
		};
		reader.readAsDataURL(input.files[0]);
		localStorage.setItem("imagen", $input.files[0]);
	}
}

//Función que obtiene el código Base64 de la imagen
function obtenerBase64(img) {
    // Crea un elemento canvas vacío
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;

    // Copia los contenidos de la imagen al canvas
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);

	// Obtiene el url data para la imagen
    var dataURL = canvas.toDataURL("image/png");

    return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
}

//Función que registrar la foto en la BD
function registrarFoto(){
	var especie= document.catalogos.especie.value;
	var favorito;
	//Obtener el id de la persona;
	var boxFavorito= document.catalogos.favorito.checked;
	//Analiza si la imagen fue calificada como favorito
	if(boxFavorito){
		favorito= 1;
	}
	else{
		favorito= 2;
	}
	//Llama a la función en php para registrar la foto
	$.ajax({
		type: "GET",
		url: "registrarFoto.php?estado="+favorito+"&especie="+especie+"&persona=1",
		data: "genero =" + genero,
		success: function(result){
		}
	});
}
