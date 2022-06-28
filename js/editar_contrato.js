
		$(document).ready(function(){
			load(1);
			load_Cliente(1);
			cambio();
			$( "#resultados" ).load( "ajax/editar_contratacion.php" );
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/productos_contrato.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

		function load_Cliente(page){
			var a= $("#a").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/clientes_factura.php?action=ajax&page='+page+'&q='+a,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$("#clientes").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
		function agregarCliente (id)
		{
			
			var nombre_cliente=document.getElementById('nombre_cliente'+id).value;
			var nombre_rp=document.getElementById('nombre_rp'+id).value;
			var nit=document.getElementById('nit_'+id).value;
			var status_cliente = document.getElementById('status_cliente'+id).value;

			//Inicia validacion
			
			//Fin validacion
			document.getElementById("id_cliente").value=id;
			document.getElementById("campo_nit").value=nit;
			document.getElementById("campo_nombre_cliente").value=nombre_cliente;
			document.getElementById("nombre_rl").value=nombre_rp;
			if (status_cliente==1){
				document.getElementById("campo_estado").value="Activo";
			} else {
				document.getElementById("campo_estado").value="No activo";
			}
			
		}
	function agregar (id)
		{
			var precio_venta=document.getElementById('precio_venta_'+id).value;
			var cantidad=document.getElementById('cantidad_'+id).value;
			//Inicia validacion
			if (isNaN(cantidad))
			{
			alert('Esto no es un numero');
			document.getElementById('cantidad_'+id).focus();
			return false;
			}
			if (isNaN(precio_venta))
			{
			alert('Esto no es un numero');
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			//Fin validacion
			
			$.ajax({
             type: "POST",
             url: "./ajax/editar_contratacion.php",
             data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad,
		     beforeSend: function(objeto){
			  $("#resultados").html("Mensaje: Cargando...");
		      },
             success: function(datos){
		     $("#resultados").html(datos);
		     }
			});
		}
		
	function eliminar (id)
	{
			
			$.ajax({
             type: "GET",
             url: "./ajax/editar_contratacion.php",
             data: "id="+id,
		     beforeSend: function(objeto){
			 $("#resultados").html("Mensaje: Cargando...");
		    },
            success: function(datos){
		     $("#resultados").html(datos);
		     }
			});

	}
		
	$("#datos_contrato").submit(function(event){
		event.preventDefault();
		var fecha_inicio = $('#fecha_inicio').val();
		var fecha_fin = $("#fecha_fin").val();
		var id_cliente = $('#id_cliente').val();
		if (id_cliente==""){
			alert("Debes seleccionar un cliente");
			$("#id_clientee").focus();
			return false;
		}
		if (fecha_inicio==""){
			alert("Debes seleccionar una fecha inicial");
			$("#fecha_inicio").focus();
			return false;
		}
		if (fecha_fin==""){
			alert("Debes seleccionar una fecha final");
			$("#fecha_fin").focus();
			return false;
		}
			
		var formulario = document.getElementById('datos_contrato');
		var datos = new FormData(formulario);
		
		fetch('./ajax/editar_contrato.php',{
			method: 'POST',
			body: datos
		})
		.then( res => res.json())
		.then( data => {
			$("#resultados").html(data);
		})
	});
	
	function cambio() {
		if( $('#otrosi').is(':checked') ) {
			$("#num_contrato_otrosi").attr('disabled', false);
		} else {
			$("#num_contrato_otrosi").attr('disabled', true);
		}
	}
	$( "#guardar_cliente" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_cliente.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})
		
		$( "#guardar_producto" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax_productos").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax_productos").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})