$(document).ready(function(){
    const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);
    var id_cliente = urlParams.get('id_cliente');
	$.ajax({
		type: "GET",
		url: "./ajax/editar_documentacion.php",
		data: "id_cliente="+id_cliente,
		beforeSend: function(objeto){
		 $("#resultados_docs").html("Mensaje: Cargando...");
	  },
	 success: function(datos){
		$("#resultados_docs").html(datos);
	 }
	 });
});


function eliminar (id){
	const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);
    var id_cliente = urlParams.get('id_cliente');
	var url = './ajax/editar_documentacion.php?id_cliente='+id_cliente;
	$.ajax({
		type: "POST",
		url: url,
		data: "id_del="+id,
		beforeSend: function(objeto){
		 $("#resultados_docs").html("Mensaje: Cargando...");
	  },
	 success: function(datos){
		$("#resultados_docs").html(datos);
	 }
	 });
}

$("#documento_cliente").submit(function(event) {

	const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);
    var id_cliente = urlParams.get('id_cliente');
	var url = './ajax/editar_documentacion.php?id_cliente='+id_cliente;

	var formulario = document.getElementById('documento_cliente');
	var datos = new FormData(formulario);
	
	fetch(url,{
		method: 'POST',
		body: datos
    })
	.then( data => {
		$.ajax({
			type: "GET",
			url: "./ajax/editar_documentacion.php",
			data: "id_cliente="+id_cliente,
			beforeSend: function(objeto){
			 	$("#resultados_docs").html("Mensaje: Cargando...");
		 	},
		 	success: function(datosss){
				$("#resultados_docs").html(datosss);
		 	}
		});
	})	  
	
    event.preventDefault();
})

