$(document).ready(function(){
    cargar();
});


$("#nuevo_cliente").submit(function(event) {
	var formulario = document.getElementById('nuevo_cliente');
	var datos = new FormData(formulario);
	
	fetch('./ajax/nuevo_cliente.php',{
		method: 'POST',
		body: datos
    })
	.then( res => res.json())
	.then( data => {
	    $("#resultados_ajax2").html(data);
	})	     
    event.preventDefault();
})


$("#documento_cliente").submit(function(event) {
	console.log("si pudo");
	var formulario = document.getElementById('documento_cliente');
	var datos = new FormData(formulario);
	
	fetch('./ajax/agregar_documentacion.php',{
		method: 'POST',
		body: datos
    })
	.then( res => res.json())
	.then( data => {
	    $("#resultados_docs").html(data);
	})	     
    event.preventDefault();
})


function cargar (){
	datos="";
	fetch('./ajax/agregar_documentacion.php',{
		method: 'POST',
		body: datos
    })
	.then( res => res.json())
	.then( data => {
	    $("#resultados_docs").html(data);
	})	   
}

function eliminar (id){
	const formData = new FormData();
	formData.append('id', id);
	fetch('./ajax/agregar_documentacion.php',{
		method: 'POST',
		body: formData
    })
	.then( res => res.json())
	.then( data => {
	    $("#resultados_docs").html(data);
	})	
}

