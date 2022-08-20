$(document).ready(function(){
    console.log("umm");
});

$("#nuevo_cliente").submit(function(event) {
    $('#guardar_datos').attr("disabled", true);
     var parametros = $(this).serialize();
	 var aux = document.querySelector('#id').value;
	 
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_cliente.php",
			data: parametros+"&id_mun='"+aux+"'",
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#guardar_datos').attr("disabled", false);
		  }
	});
    event.preventDefault();
})
