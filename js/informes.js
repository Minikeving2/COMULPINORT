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

function getValueAt(column, dataTable, row) {
        return dataTable.getFormattedValue(row, column);
      }
function generar() {
        google.charts.load('current', {'packages':['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawChart);
    }
    
     // Callback that creates and populates a data table,
     // instantiates the pie chart, passes in the data and
    

     // draws it.
function drawChart() {
    var mes= $("#mes").val();
	var año= "2022";
    const nombre_mes = ["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];
    if (mes<=12){
        $.ajax({
            type: "POST",
            url: "./ajax/grafico.php",
            data: "mes="+mes+"&año="+año,
            beforeSend: function(objeto){
            },
            success: function(datos){
                const split = datos.split(' ') // (1) [ 'bearer', 'token' ]
                const datos_query = [nombre_mes[parseInt(mes)-1], parseInt(split[0]), parseInt(split[1]), parseInt(split[0])+parseInt(split[1])];
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
                       sourceColumn: 2,
                       type: "string",
                       role: "annotation" },
                    3, {calc: "stringify",
                    sourceColumn: 3,
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
                    height: 600,
                    colors: ['#94D509', '#007936', '#F89C0E']
                };
                // Instantiate and draw our chart, passing in some options.
                
                var chart_divs = document.getElementById("cap_grafico");
                var charts = new google.visualization.ColumnChart(chart_divs);
                
                google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico").val(chart_divs.innerHTML);
                });
                charts.draw(view, options);
                
                
                // Create the data table.
            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: "./ajax/grafico_anual.php",
            data: "año="+año,
            beforeSend: function(objeto){
            },
            success: function(datos){
                const split = datos.split(' ') // (1) [ 'bearer', 'token' ]

                    
                

                const ENERO =[nombre_mes[0],parseInt(split[0]), parseInt(split[1]), parseInt(split[0])+parseInt(split[1])];
                const FEBRERO =[nombre_mes[1],parseInt(split[2]), parseInt(split[3]), parseInt(split[2])+parseInt(split[3])];
                const MARZO =[nombre_mes[2],parseInt(split[4]), parseInt(split[5]), parseInt(split[4])+parseInt(split[5])];
                const ABRIL =[nombre_mes[3],parseInt(split[6]), parseInt(split[7]), parseInt(split[6])+parseInt(split[7])];
                const MAYO =[nombre_mes[4],parseInt(split[8]), parseInt(split[9]), parseInt(split[8])+parseInt(split[9])];
                const JUNIO =[nombre_mes[5],parseInt(split[10]), parseInt(split[11]), parseInt(split[10])+parseInt(split[11])];
                const JULIO =[nombre_mes[6],parseInt(split[12]), parseInt(split[13]), parseInt(split[12])+parseInt(split[13])];
                const AGOSTO =[nombre_mes[7],parseInt(split[14]), parseInt(split[15]), parseInt(split[14])+parseInt(split[15])];
                const SEPTIEMBRE =[nombre_mes[8],parseInt(split[16]), parseInt(split[17]), parseInt(split[16])+parseInt(split[17])];
                const OCTUBRE =[nombre_mes[9],parseInt(split[18]), parseInt(split[19]), parseInt(split[18])+parseInt(split[19])];
                const NOVIEMBRE =[nombre_mes[10],parseInt(split[20]), parseInt(split[21]), parseInt(split[20])+parseInt(split[21])];
                const DICIEMBRE =[nombre_mes[11],parseInt(split[22]), parseInt(split[23]), parseInt(split[22])+parseInt(split[23])];

               
                var data = google.visualization.arrayToDataTable([
                    ['MES', 'B2', 'GASOLINA', 'TOTAL'],
                    ENERO,
                    FEBRERO,
                    MARZO
                ]);

                var view = new google.visualization.DataView(data);

                    view.setColumns([0, 
                    1, {calc: getValueAt.bind(undefined, 1),
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                    2, {calc: getValueAt.bind(undefined, 2),
                    sourceColumn: 2,
                    type: "string",
                    role: "annotation" },
                    3, {calc: getValueAt.bind(undefined, 3),
                    sourceColumn: 3,
                    type: "string",
                    role: "annotation" }]);
                // Set chart options
                var options = {
                    chart: {
                        title: '',
                        subtitle: '',
                    },
                    bars: 'VERTICAL',
                    vAxis: {format: 'decimal'},
                    height: 600,
                    bar: {groupWidth: "80%"},
                    colors: ['#94D509', '#007936', '#F89C0E']
                };
                // Instantiate and draw our chart, passing in some options.
                var chart_divs = document.getElementById("cap_grafico");
                var charts = new google.visualization.ColumnChart(chart_divs);
                
                google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico").val(chart_divs.innerHTML);
                });
                charts.draw(view, options);
                
                var data = google.visualization.arrayToDataTable([
                    ['MES', 'B2', 'GASOLINA', 'TOTAL'],
                    ABRIL,MAYO,JUNIO
                ]);

                var view = new google.visualization.DataView(data);

                    view.setColumns([0, 
                    1, {calc: getValueAt.bind(undefined, 1),
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                    2, {calc: getValueAt.bind(undefined, 2),
                    sourceColumn: 2,
                    type: "string",
                    role: "annotation" },
                    3, {calc: getValueAt.bind(undefined, 3),
                    sourceColumn: 3,
                    type: "string",
                    role: "annotation" }]);
                // Set chart options
                var options = {
                    chart: {
                        title: '',
                        subtitle: '',
                    },
                    bars: 'VERTICAL',
                    vAxis: {format: 'decimal'},
                    height: 600,
                    bar: {groupWidth: "80%"},
                    colors: ['#94D509', '#007936', '#F89C0E']
                };
                // Instantiate and draw our chart, passing in some options.
               

                var chart_divs = document.getElementById("cap_grafico2");
                var charts = new google.visualization.ColumnChart(chart_divs);
                
                google.visualization.events.addListener(charts, 'ready', function () {
                    chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico2").val(chart_divs.innerHTML);
                });
                charts.draw(view, options);
                
                var data = google.visualization.arrayToDataTable([
                    ['MES', 'B2', 'GASOLINA', 'TOTAL'],
                    JULIO,
                    AGOSTO,
                    SEPTIEMBRE
                ]);

                var view = new google.visualization.DataView(data);

                    view.setColumns([0, 
                    1, {calc: getValueAt.bind(undefined, 1),
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                    2, {calc: getValueAt.bind(undefined, 2),
                    sourceColumn: 2,
                    type: "string",
                    role: "annotation" },
                    3, {calc: getValueAt.bind(undefined, 3),
                    sourceColumn: 3,
                    type: "string",
                    role: "annotation" }]);
                // Set chart options
                var options = {
                    chart: {
                        title: '',
                        subtitle: '',
                    },
                    bars: 'VERTICAL',
                    vAxis: {format: 'decimal'},
                    height: 600,
                    bar: {groupWidth: "80%"},
                    colors: ['#94D509', '#007936', '#F89C0E']
                };
                // Instantiate and draw our chart, passing in some options.
                

                var chart_divs = document.getElementById("cap_grafico3");
                var charts = new google.visualization.ColumnChart(chart_divs);
                
                google.visualization.events.addListener(charts, 'ready', function () {
                    chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico3").val(chart_divs.innerHTML);
                });
                charts.draw(view, options);


                var data = google.visualization.arrayToDataTable([
                    ['MES', 'B2', 'GASOLINA', 'TOTAL'],
                    OCTUBRE,
                    NOVIEMBRE,
                    DICIEMBRE
                ]);

                var view = new google.visualization.DataView(data);

                    view.setColumns([0, 
                    1, {calc: getValueAt.bind(undefined, 1),
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                    2, {calc: getValueAt.bind(undefined, 2),
                    sourceColumn: 2,
                    type: "string",
                    role: "annotation" },
                    3, {calc: getValueAt.bind(undefined, 3),
                    sourceColumn: 3,
                    type: "string",
                    role: "annotation" }]);
                // Set chart options
                var options = {
                    chart: {
                        title: '',
                        subtitle: '',
                    },
                    bars: 'VERTICAL',
                    vAxis: {format: 'decimal'},
                    height: 600,
                    bar: {groupWidth: "80%"},
                    colors: ['#94D509', '#007936', '#F89C0E']
                };
                // Instantiate and draw our chart, passing in some options.
                

                var chart_divs = document.getElementById("cap_grafico4");
                var charts = new google.visualization.ColumnChart(chart_divs);
                
                google.visualization.events.addListener(charts, 'ready', function () {
                    chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico4").val(chart_divs.innerHTML);
                });
                charts.draw(view, options);
                
                // Create the data table.}
        
            }
        });
    
    }
}
    function imprimir(){
        var mes = $("#mes").val();
        if (mes<=12){
            var q= $("#grafico").val();
            if (q=="") {
            alert("Debe generar el grafico");
            } else {
                q = q.substring(10, q.length-2);
                openWindowWithPost("./pdf/documentos/grafico.php", {
                    imagen_1: q
                    //:
                });


            }
        } else {
            var a= $("#grafico").val();
            var b= $("#grafico2").val();
            var c= $("#grafico3").val();
            var d= $("#grafico4").val();
            if (a=="" && b=="" && c=="" && d=="") {
            alert("Debe generar el grafico");
            } else {
                a = a.substring(10, a.length-2);
                b = b.substring(10, b.length-2);
                c = c.substring(10, c.length-2);
                d = d.substring(10, d.length-2);
                openWindowWithPost("./pdf/documentos/grafico.php", {
                    imagen_1: a, imagen_2: b, imagen_3: c, imagen_4: d
                    //:
                });


            }


        }
    }

    
    function openWindowWithPost(url, data) {
        var form = document.createElement("form");
        form.target = "_blank";
        form.method = "POST";
        form.action = url;
        form.style.display = "none";
    
        for (var key in data) {
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = key;
            input.value = data[key];
            form.appendChild(input);
        }
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }