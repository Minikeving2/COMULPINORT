$(document).ready(function(){
    $("select[name=municipio_ventas_grafico]").change(function(){ 
        document.getElementById('impresion_venta_municipio').disabled = true;
    })
    $("select[name=año_ventas_grafico]").change(function(){ 
        document.getElementById('impresion_venta_municipio').disabled = true;
    })

    $("select[name=mes_ventas]").change(function(){ 
        document.getElementById('impresion_').disabled = true;
    })
    $("select[name=año_ventas]").change(function(){ 
        document.getElementById('impresion_').disabled = true;
    })
});

function getValueAt(column, dataTable, row) {
    return dataTable.getFormattedValue(row, column);
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

function generar() {
        google.charts.load('current', {'packages':['corechart', 'bar']});
        google.charts.setOnLoadCallback(dibujar);
        setTimeout(function(){
            document.getElementById('impresion_').disabled = false;
        },4000);
} // Callback that creates and populates a data table,
     // instantiates the pie chart, passes in the data and
    

     // draws it.
function dibujar() { 
    var mes= $("#mes_ventas").val();
	var año= $("#año_ventas").val();;
    const nombre_mes = ["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];
    if (mes<=12){
        $.ajax({
            type: "POST",
            url: "./ajax/grafico.php",
            data: "mes="+mes+"&YEAR="+año,
            beforeSend: function(objeto){
            },
            success: function(datos){
                console.log("aver: "+datos);
                const split = datos.split(' ');
                const datos_query = [nombre_mes[parseInt(mes)-1], parseInt(split[0]), parseInt(split[1]), parseInt(split[2]), parseInt(split[3]), parseInt(split[4]), parseInt(split[5]), parseInt(split[6]), parseInt(split[7])];
                var data = google.visualization.arrayToDataTable([
                    ['MES', 'C02', 'B5', 'C04', 'C07', 'C09', 'EX', 'EX4', 'EX2'],
                    datos_query
                ]);

                var view = new google.visualization.DataView(data);

                    view.setColumns([
                    0, 
                    1,
                        { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"},
                    2, 
                        {calc: "stringify",
                        sourceColumn: 2,
                        type: "string",
                        role: "annotation" },
                    3, 
                        {calc: "stringify",
                        sourceColumn: 3,
                        type: "string",
                        role: "annotation" },
                    4,
                        { calc: "stringify",
                        sourceColumn: 4,
                        type: "string",
                        role: "annotation"},
                    5,
                        { calc: "stringify",
                        sourceColumn: 5,
                        type: "string",
                        role: "annotation"},
                    6,
                        { calc: "stringify",
                        sourceColumn: 6,
                        type: "string",
                        role: "annotation"},
                    7,
                        { calc: "stringify",
                        sourceColumn: 7,
                        type: "string",
                        role: "annotation"},
                    8,
                        { calc: "stringify",
                        sourceColumn: 8,
                        type: "string",
                        role: "annotation"},
                    ]);
                // Set chart options
                var options = {
                    chart: {
                        title: '',
                        subtitle: '',
                    },
                    bars: 'vertical',
                    vAxis: {format: 'decimal'},
                    height: 600,
                    //linea de colores por orden toca agregar los demas campos
                    colors: ['#94D509', '#007936', '#F89C0E']
                };
                // Instantiate and draw our chart, passing in some options.
                
                var chart_divs = document.getElementById("cap_grafico_");
                var charts = new google.visualization.ColumnChart(chart_divs);
                
                google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico_").val(chart_divs.innerHTML);
                });
                charts.draw(view, options);
                
                
                // Create the data table.
            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: "./ajax/grafico_anual.php",
            data: "YEAR="+año,
            beforeSend: function(objeto){
            },
            success: function(datos){
                const split = datos.split(' ') // (1) [ 'bearer', 'token' ]

                const ENERO =[nombre_mes[0],parseInt(split[0]), parseInt(split[1]), parseInt(split[2]), parseInt(split[3]), parseInt(split[4]), parseInt(split[5]), parseInt(split[6]), parseInt(split[7])];
                const FEBRERO =[nombre_mes[1],parseInt(split[8]), parseInt(split[9]), parseInt(split[10]), parseInt(split[11]), parseInt(split[12]), parseInt(split[13]), parseInt(split[14]), parseInt(split[15])];
                const MARZO =[nombre_mes[2],parseInt(split[16]), parseInt(split[17]), parseInt(split[18]), parseInt(split[19]), parseInt(split[20]), parseInt(split[21]), parseInt(split[22]), parseInt(split[23])];
                const ABRIL =[nombre_mes[3],parseInt(split[24]), parseInt(split[25]), parseInt(split[26]), parseInt(split[27]), parseInt(split[28]), parseInt(split[29]), parseInt(split[30]), parseInt(split[31])];
                const MAYO =[nombre_mes[4],parseInt(split[32]), parseInt(split[33]), parseInt(split[34]), parseInt(split[35]), parseInt(split[36]), parseInt(split[37]), parseInt(split[38]), parseInt(split[39])];
                const JUNIO =[nombre_mes[5],parseInt(split[40]), parseInt(split[41]), parseInt(split[42]), parseInt(split[43]), parseInt(split[44]), parseInt(split[45]), parseInt(split[46]), parseInt(split[47])];
                const JULIO =[nombre_mes[6],parseInt(split[48]), parseInt(split[49]), parseInt(split[50]), parseInt(split[51]), parseInt(split[52]), parseInt(split[53]), parseInt(split[54]), parseInt(split[55])];
                const AGOSTO =[nombre_mes[7],parseInt(split[56]), parseInt(split[57]), parseInt(split[58]), parseInt(split[59]), parseInt(split[60]), parseInt(split[61]), parseInt(split[62]), parseInt(split[63])];
                const SEPTIEMBRE =[nombre_mes[8],parseInt(split[64]), parseInt(split[65]), parseInt(split[66]), parseInt(split[67]), parseInt(split[68]), parseInt(split[69]), parseInt(split[70]), parseInt(split[71])];
                const OCTUBRE =[nombre_mes[9],parseInt(split[72]), parseInt(split[73]), parseInt(split[74]), parseInt(split[75]), parseInt(split[76]), parseInt(split[77]), parseInt(split[78]), parseInt(split[79])];
                const NOVIEMBRE =[nombre_mes[10],parseInt(split[80]), parseInt(split[81]), parseInt(split[82]), parseInt(split[83]), parseInt(split[84]), parseInt(split[85]), parseInt(split[86]), parseInt(split[87])];
                const DICIEMBRE =[nombre_mes[11],parseInt(split[88]), parseInt(split[89]), parseInt(split[90]), parseInt(split[91]), parseInt(split[92]), parseInt(split[93]), parseInt(split[94]), parseInt(split[95])];

                
               
                var data = google.visualization.arrayToDataTable([
                    ['MES', 'C02', 'B5', 'C04', 'C07', 'C09', 'EX', 'EX4', 'EX2'],
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
                    role: "annotation" },
                    4, {calc: getValueAt.bind(undefined, 4),
                    sourceColumn: 4,
                    type: "string",
                    role: "annotation"},
                    5, {calc: getValueAt.bind(undefined, 5),
                    sourceColumn: 5,
                    type: "string",
                    role: "annotation" },
                    6, {calc: getValueAt.bind(undefined, 6),
                    sourceColumn: 6,
                    type: "string",
                    role: "annotation" },
                    7, {calc: getValueAt.bind(undefined, 7),
                    sourceColumn: 7,
                    type: "string",
                    role: "annotation"},
                    8, {calc: getValueAt.bind(undefined, 8),
                    sourceColumn: 8,
                    type: "string",
                    role: "annotation"}
                ]);
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
                    colors: ['#B2190B', '#89ACC0', '#CE8303', '#5C354B', '#99E0CE', '#FF4238', '#F3CF1E', '#D49F91']
                };
                // Instantiate and draw our chart, passing in some options.
                var chart_divs = document.getElementById("cap_grafico_");
                var charts = new google.visualization.ColumnChart(chart_divs);
                
                google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico_").val(chart_divs.innerHTML);
                });
                charts.draw(view, options);
                
                var data = google.visualization.arrayToDataTable([
                    ['MES', 'C02', 'B5', 'C04', 'C07', 'C09', 'EX', 'EX4', 'EX2'],
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
                    role: "annotation"},
                    3, {calc: getValueAt.bind(undefined, 3),
                    sourceColumn: 3,
                    type: "string",
                    role: "annotation"}, 
                    4, {calc: getValueAt.bind(undefined, 4),
                    sourceColumn: 4,
                    type: "string",
                    role: "annotation"},
                    5, {calc: getValueAt.bind(undefined, 5),
                    sourceColumn: 5,
                    type: "string",
                    role: "annotation"},
                    6, {calc: getValueAt.bind(undefined, 6),
                    sourceColumn: 6,
                    type: "string",
                    role: "annotation"}, 
                    7, {calc: getValueAt.bind(undefined, 7),
                    sourceColumn: 7,
                    type: "string",
                    role: "annotation"},
                    8, {calc: getValueAt.bind(undefined, 8),
                    sourceColumn: 8,
                    type: "string",
                    role: "annotation"}
                
                ]);
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
                    colors: ['#B2190B', '#89ACC0', '#CE8303', '#5C354B', '#99E0CE', '#FF4238', '#F3CF1E', '#D49F91']
                };
                // Instantiate and draw our chart, passing in some options.
               

                var chart_divs = document.getElementById("cap_grafico2_");
                var charts = new google.visualization.ColumnChart(chart_divs);
                
                google.visualization.events.addListener(charts, 'ready', function () {
                    chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico2_").val(chart_divs.innerHTML);
                });
                charts.draw(view, options);
                
                var data = google.visualization.arrayToDataTable([
                    ['MES', 'C02', 'B5', 'C04', 'C07', 'C09', 'EX', 'EX4', 'EX2'],
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
                    role: "annotation"},
                    3, {calc: getValueAt.bind(undefined, 3),
                    sourceColumn: 3,
                    type: "string",
                    role: "annotation"}, 
                    4, {calc: getValueAt.bind(undefined, 4),
                    sourceColumn: 4,
                    type: "string",
                    role: "annotation"},
                    5, {calc: getValueAt.bind(undefined, 5),
                    sourceColumn: 5,
                    type: "string",
                    role: "annotation"},
                    6, {calc: getValueAt.bind(undefined, 6),
                    sourceColumn: 6,
                    type: "string",
                    role: "annotation"}, 
                    7, {calc: getValueAt.bind(undefined, 7),
                    sourceColumn: 7,
                    type: "string",
                    role: "annotation"},
                    8, {calc: getValueAt.bind(undefined, 8),
                    sourceColumn: 8,
                    type: "string",
                    role: "annotation"}
                
                ]);
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
                    colors: ['#B2190B', '#89ACC0', '#CE8303', '#5C354B', '#99E0CE', '#FF4238', '#F3CF1E', '#D49F91']
                };
                // Instantiate and draw our chart, passing in some options.
                

                var chart_divs = document.getElementById("cap_grafico3_");
                var charts = new google.visualization.ColumnChart(chart_divs);
                
                google.visualization.events.addListener(charts, 'ready', function () {
                    chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico3_").val(chart_divs.innerHTML);
                });
                charts.draw(view, options);


                var data = google.visualization.arrayToDataTable([
                    ['MES', 'C02', 'B5', 'C04', 'C07', 'C09', 'EX', 'EX4', 'EX2'],
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
                    role: "annotation"},
                    3, {calc: getValueAt.bind(undefined, 3),
                    sourceColumn: 3,
                    type: "string",
                    role: "annotation"}, 
                    4, {calc: getValueAt.bind(undefined, 4),
                    sourceColumn: 4,
                    type: "string",
                    role: "annotation"},
                    5, {calc: getValueAt.bind(undefined, 5),
                    sourceColumn: 5,
                    type: "string",
                    role: "annotation"},
                    6, {calc: getValueAt.bind(undefined, 6),
                    sourceColumn: 6,
                    type: "string",
                    role: "annotation"}, 
                    7, {calc: getValueAt.bind(undefined, 7),
                    sourceColumn: 7,
                    type: "string",
                    role: "annotation"},
                    8, {calc: getValueAt.bind(undefined, 8),
                    sourceColumn: 8,
                    type: "string",
                    role: "annotation"}
                
                ]);
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
                    colors: ['#B2190B', '#89ACC0', '#CE8303', '#5C354B', '#99E0CE', '#FF4238', '#F3CF1E', '#D49F91']
                };
                // Instantiate and draw our chart, passing in some options.
                

                var chart_divs = document.getElementById("cap_grafico4_");
                var charts = new google.visualization.ColumnChart(chart_divs);
                
                google.visualization.events.addListener(charts, 'ready', function () {
                    chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico4_").val(chart_divs.innerHTML);
                });
                charts.draw(view, options);
                
                // Create the data table.}
            
            }
        });
    
    }
}

function generar_venta_municipio() {
    google.charts.load('current', {'packages':['corechart', 'bar']});
    google.charts.setOnLoadCallback(dibujar_venta_municipio);
    setTimeout(function(){
        document.getElementById('impresion_venta_municipio').disabled = false;
    },4000);
}
function dibujar_venta_municipio() { 
var mun= $("#municipio_ventas_grafico").val();
var año= $("#año_ventas_grafico").val();
    $.ajax({
        type: "POST",
        url: "./ajax/grafico_municipio.php",
        data: "mun="+mun+"&year="+año,
        beforeSend: function(objeto){
        },
        success: function(cadenas){
            const cadena = cadenas.split(',');
            //agregar funcion para la imagen segun los datos que me traigo de la base de datos el primer valor es la cantidad de municipios
            //lo que significa que por cada x municipos exiten 3 valores todo eso seria un mes 
            //ejemplo si son 4 municipios y se sabe que cada municpios tiene 3 valores los cuales son c_mes c_zf y c_nal
            //en todo el mes se manejarian 12 valores 4 municipios con 3 columnas
            var umm = (cadena[0]*3);
            for (let i = 0; i < umm; i++) {
                  cadena.push(0);  
            }
            var aux = 0;
            var aux1 = 0;
            var aux2=0;
            var datos = [];
            var datos1 = [];
            var datos2 = [];
            cadena.forEach(element => {
              if (aux==0) {
                cant_mun = element;
              }
              else{
                if (aux1<=(cant_mun*4)-1) {

                    
                  if (aux2<=3) {
                    if (isNaN(element)){
                    } else {
                        element = parseInt(element);
                    }
                    datos2[aux2]=element;
                    aux2=aux2+1;
                  }
                  else {
                    if (isNaN(element)){
                    } else {
                        element = parseInt(element);
                    }
                    datos1.push(datos2);
                    aux2=0;
                    datos2=[];
                    datos2[aux2]=element;
                    aux2=aux2+1;
                  }
                  aux1=aux1+1;
                }
                else{
                  if (aux2<=3) {
                    if (isNaN(element)){
                    } else {
                        element = parseInt(element);
                    }
                    datos2[aux2]=element;
                    aux2=aux2+1;
                  }
                  else {
                    if (isNaN(element)){
                    } else {
                        element = parseInt(element);
                    }
                    datos1.push(datos2);
                    datos.push(datos1);
                    datos1=[];
                    datos2=[];
                    aux2=0;
                    aux1=3;
                    datos2[aux2]=element;
                    aux2=aux2+1;
                  }
                }
              }
              aux=aux+1;
            });
            const titulos = [['ESTACIONES','CUPO ASIGNADO', 'CUPO CONSUMIDO', 'CUPO EXTRA CONSUMIDO']];


            const nuevo = datos[0];
            var a = titulos.concat(nuevo);
            var data = google.visualization.arrayToDataTable(a);
            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'ENERO',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);


            const nuevo1 = datos[1];
            var a = titulos.concat(nuevo1);
            var data = google.visualization.arrayToDataTable(a);
    
            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'FEBRERO',
                        subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico2");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico2").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);


            const nuevo2 = datos[2];
            var a = titulos.concat(nuevo2);
            var data = google.visualization.arrayToDataTable(a);
        
            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'MARZO',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico3");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico3").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);
                
                        
            
            const nuevo3 = datos[3];
            var a = titulos.concat(nuevo3);
            var data = google.visualization.arrayToDataTable(a);
            
            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'ABRIL',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico4");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico4").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);
                        

            const nuevo4 = datos[4];
            var a = titulos.concat(nuevo4);
            var data = google.visualization.arrayToDataTable(a);
                
            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'MAYO',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico5");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico5").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);

            const nuevo5 = datos[5];
            var a = titulos.concat(nuevo5);
            var data = google.visualization.arrayToDataTable(a);

            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'MAYO',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico6");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico6").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);
                                

            const nuevo6 = datos[6];
            var a = titulos.concat(nuevo6);
            var data = google.visualization.arrayToDataTable(a);

            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'MAYO',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico7");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico7").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);                                    

                                        
            const nuevo7 = datos[7];
            var a = titulos.concat(nuevo7);
            var data = google.visualization.arrayToDataTable(a);

            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'MAYO',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico8");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico8").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);
        
            
            const nuevo8 = datos[8];
            var a = titulos.concat(nuevo8);
            var data = google.visualization.arrayToDataTable(a);

            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'MAYO',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico9");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico9").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);


            const nuevo9 = datos[9];
            var a = titulos.concat(nuevo9);
            var data = google.visualization.arrayToDataTable(a);

            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'MAYO',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico10");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico10").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);


            const nuevo10 = datos[10];
            var a = titulos.concat(nuevo10);
            var data = google.visualization.arrayToDataTable(a);

            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'MAYO',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico11");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico11").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);


            const nuevo11 = datos[11];
            var a = titulos.concat(nuevo11);
            var data = google.visualization.arrayToDataTable(a);

            var view = new google.visualization.DataView(data);
            var options = {
                chart: {
                    title: 'MAYO',
                    subtitle: '',
                },
                bars: 'VERTICAL',
                vAxis: {format: 'decimal'},
                height: 600,
                bar: {groupWidth: "80%"},
                colors: ['#94D509', '#007936', '#F89C0E']
            };
            var chart_divs = document.getElementById("cap_grafico12");
            var charts = new google.visualization.ColumnChart(chart_divs);
            google.visualization.events.addListener(charts, 'ready', function () {
                chart_divs.innerHTML = '<img src="' + charts.getImageURI() + '">';
                //insertar el codigo de la imagen en un input para asi poderlo mandar al boton que genere el pdf 
                $("#grafico12").val(chart_divs.innerHTML);
            });
            charts.draw(view, options);
        }
    })
}


function imprimir(){//informe con grafico

    var mes = $("#mes_ventas").val();
    console.log(mes);
    var year = $("#año_ventas").val();
    if (mes<=12){
        var q= $("#grafico_").val();
        if (q=="") {
        alert("Debe generar el grafico");
        } else {
            q = q.substring(10, q.length-2);
            openWindowWithPost("./pdf/documentos/grafico.php", {
                imagen_1: q, year: year
                //:
            });


        }
    } else {
        var year = $("#año_Ventas").val();
        var a= $("#grafico_").val();
        var b= $("#grafico2_").val();
        var c= $("#grafico3_").val();
        var d= $("#grafico4_").val();
        if (a=="" && b=="" && c=="" && d=="") {
        alert("Debe generar el grafico");
        } else {
            a = a.substring(10, a.length-2);
            b = b.substring(10, b.length-2);
            c = c.substring(10, c.length-2);
            d = d.substring(10, d.length-2);
            openWindowWithPost("./pdf/documentos/grafico.php", {
                imagen_1: a, imagen_2: b, imagen_3: c, imagen_4: d, year:year
                //:
            });


        }


    }
}
function imprimir_informe(){
    var q= $("#q").val();
    if (q=="") {
       alert("Debe ingresar un cliente");
    } else {
        var tipo = $("input[name=tipo_informe]:checked").val();
        var date_start = document.getElementById("fecha_inicio").value;
        var date_end = document.getElementById("fecha_fin").value;
        VentanaCentrada('./pdf/documentos/ver_informe.php?q='+q+'&date_s='+date_start+'&date_e='+date_end+'&tipo='+tipo,'Factura','','1024','768','true');
    }
    event.preventDefault();
}    
function informe_utilidad(){
    
    var mes_utilidad = document.getElementById("mes_utilidad").value;
    var year_utilidad = document.getElementById("year_utilidad").value;
    openWindowWithPost("./pdf/documentos/utilidad.php", {
        mes: mes_utilidad, year: year_utilidad
    });
}
function informe_entrega1(){
    var mun = document.getElementById('mun').value;
    openWindowWithPost("./pdf/documentos/entrega_excedente_t1.php", {
        mun: mun
    });
}

function informe_entrega2(){
    var mun = document.getElementById('mun').value;
    openWindowWithPost("./pdf/documentos/entrega_excedente_t2.php", {
        mun: mun
    });
}
function informe_consumo_general(){
    var mun = document.getElementById('mun_consumo').value;
    var year = document.getElementById('year_consumo').value;
    openWindowWithPost("./pdf/documentos/resumen_cupo.php", {
        id_mun: mun, year: year
    });
}

function imprimir_venta_municipio(){//informe con grafico

    var mun = $("#municipio_ventas_grafico").val();
    var year = $("#año_ventas_grafico").val();

    var a = $("#grafico").val();
    if (a=="") {
    alert("Debe generar el grafico");
    } else {
        var a= $("#grafico").val();
        var b= $("#grafico2").val();
        var c= $("#grafico3").val();
        var d= $("#grafico4").val();
        var e= $("#grafico5").val();
        var f= $("#grafico6").val();
        var g= $("#grafico7").val();
        var h= $("#grafico8").val(); 
        var i= $("#grafico9").val();
        var j= $("#grafico10").val();
        var k= $("#grafico11").val();
        var m= $("#grafico12").val();

        a = a.substring(10, a.length-2);
        b = b.substring(10, b.length-2);
        c = c.substring(10, c.length-2);
        d = d.substring(10, d.length-2);
        e = e.substring(10, e.length-2);
        f = f.substring(10, f.length-2);
        g = g.substring(10, g.length-2);
        h = h.substring(10, h.length-2);
        i = i.substring(10, i.length-2);
        j = j.substring(10, j.length-2);
        k = k.substring(10, k.length-2);
        m = m.substring(10, m.length-2);

        openWindowWithPost("./pdf/documentos/grafico_municipio.php", {
        imagen_1: a,
        imagen_2: b,
        imagen_3: c,
        imagen_4: d,
        imagen_5: e,
        imagen_6: f,
        imagen_7: g,
        imagen_8: h,
        imagen_9: i,
        imagen_10: j,
        imagen_11: k,
        imagen_12: m,
        year: year,
        mun: mun
        });
    }
}
