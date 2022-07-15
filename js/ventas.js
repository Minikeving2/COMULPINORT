$(document).ready(function(){
    load(1);
    
});

function load(page){
    var q= $("#q").val();
    var date_start = document.getElementById("fecha_inicio").value;
    var date_end = document.getElementById("fecha_fin").value;
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'./ajax/buscar_ventas.php?action=ajax&page='+page+'&q='+q+'&fecha_start='+date_start+'&fecha_end='+date_end,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
      },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
            $('[data-toggle="tooltip"]').tooltip({html:true}); 
            
        }
    })
}
$( "#datos_ventas" ).submit(function( event ) {
    event.preventDefault();
    console.log("sube el archivo");
    var formulario = document.getElementById('datos_ventas');
	var datos = new FormData(formulario);
	
	fetch('./ajax/nuevo_ventas.php',{
		method: 'POST',
		body: datos
    })
	.then( res => res.json())
	.then( data => {
	    $("#resultados").html(data);
	})
});			
