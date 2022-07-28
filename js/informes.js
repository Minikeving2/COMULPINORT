$(document).ready(function(){
});

function load(page){
    var q= $("#q").val();
    var tipo = $("input[name=tipo_informe]:checked").val();
    var fechainicial = document.getElementById("fecha_inicio").value;
    var fechafinal = document.getElementById("fecha_fin").value;
    if(Date.parse(fechafinal) >= Date.parse(fechainicial)) {
         //$("#loader").fadeIn('slow');
        $.ajax({
            url:'./ajax/buscar_informes.php?action=ajax&q='+q+'&fecha_start='+fechainicial+'&fecha_end='+fechafinal+"&tipo_informe="+tipo,
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



function imprimir_informe(){
    var q= $("#q").val();
    if (q=="") {
       alert("Debe ingresar un cliente");
    } else {
        console.log("aver");
        var tipo = $("input[name=tipo_informe]:checked").val();
        var date_start = document.getElementById("fecha_inicio").value;
        var date_end = document.getElementById("fecha_fin").value;
        VentanaCentrada('./pdf/documentos/ver_informe.php?q='+q+'&date_s='+date_start+'&date_e='+date_end+'&tipo='+tipo,'Factura','','1024','768','true');
    }
    event.preventDefault();
    }


    function generar() {
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
    }
    
     // Callback that creates and populates a data table,
     // instantiates the pie chart, passes in the data and
    

     // draws it.
    function drawChart() {
    var mes= $("#mes").val();
	var año= "2022";
    const nombre_mes = ["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];
        $.ajax({
            type: "POST",
            url: "./ajax/grafico.php",
            data: "mes="+mes+"&año="+año,
            beforeSend: function(objeto){
                $("#grafico").html("Mensaje: Cargando...");
            },
            success: function(datos){
                $("#aver").html("");
                const split = datos.split(' ') // (1) [ 'bearer', 'token' ]
                const datos_query = [nombre_mes[parseInt(mes)-1], parseInt(split[0]),parseInt(split[1]), parseInt(split[0])+parseInt(split[1])];
                var data = google.visualization.arrayToDataTable([
                    ['MES', 'B2', 'GASOLINA', 'TOTAL'],
                    datos_query
                ]);

                var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation"},
                       2, {calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation" },
                    3, { calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation" }]);
                // Set chart options
                var options = {
                    chart: {
                        title: '',
                        subtitle: '',
                    },
                    bars: 'vertical',
                    vAxis: {format: 'decimal'},
                    height: 400
                };
                // Instantiate and draw our chart, passing in some options.
                var chart_div = document.getElementById("columnchart_material")
                var chart = new google.visualization.ColumnChart(chart_div);

                google.visualization.events.addListener(chart, 'ready', function () {
                chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
                    console.log(chart_div.innerHTML);
                });
                chart.draw(view, options);
                
                // Create the data table.
            }
        });
    }
