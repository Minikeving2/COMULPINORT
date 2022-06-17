$(document).ready(function(){
    load(1);
    
});

function load(page){
    var q= $("#q").val();

    var fechainicial = document.getElementById("fecha_inicio").value;
    var fechafinal = document.getElementById("fecha_fin").value;
    if(Date.parse(fechafinal) >= Date.parse(fechainicial)) {
         //$("#loader").fadeIn('slow');
        $.ajax({
            url:'./ajax/buscar_informes.php?action=ajax&q='+q+'&fecha_start='+fechainicial+'&fecha_end='+fechafinal,
            beforeSend: function(objeto){
            //$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            //$('#loader').html('');
            $('[data-toggle="tooltip"]').tooltip({html:true}); 
        }
    })

    } else {
        alert("La fecha final debe ser mayor a la fecha inicial");
    }
}

function eliminar (id)
{
    var q= $("#q").val();
if (confirm("Realmente deseas eliminar la factura")){	
$.ajax({
type: "GET",
url: "./ajax/buscar_facturas.php",
data: "id="+id,"q":q,
 beforeSend: function(objeto){
    $("#resultados").html("Mensaje: Cargando...");
  },
success: function(datos){
$("#resultados").html(datos);
load(1);
}
    });
}
}



function imprimir_factura(id_factura){
    VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');
}
