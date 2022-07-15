$(document).ready(function(){
    $("#num_contrato_otrosi").attr('disabled', true);
    
    load_Cliente(1);
    load(1);
    cambio();
    cargar();
    
});

$( "#subir_datos" ).submit(function( event ) {
    var formulario = document.getElementById('archivo');
	var datos = new FormData(formulario);
		
	fetch('./ajax/nuevo_ventas.php',{
		method: 'POST',
		body: datos
    })
	.then( res => res.json())
	.then( data => {
	    $("#resultados").html(data);
	})
			
})