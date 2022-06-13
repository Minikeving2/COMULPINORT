
		$(document).ready(function(){
			cargar();
			load(1);
			load_Cliente(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/productos_factura.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$("#productos").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
		//ejecuta la consulta para visualizar los cliente en el moodal correspondiente
		function load_Cliente(page){
			var q= $("#a").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/clientes_factura.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$("#clientes").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

		function cargar ()
		{
			
			$.ajax({
				type: "POST",
				url: "./ajax/agregar_facturacion.php",
				data: "id=''&precio_venta=''&cantidad=''",
				beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");
				},
				success: function(datos){
					$("#resultados").html(datos);
					
				}
				
			});
					
		}
	function agregarProducto (id)
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
				url: "./ajax/agregar_facturacion.php",
				data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad,
				beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");
				},
				success: function(datos){
					$("#resultados").html(datos);
					
				}
				
			});
					
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
		
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/agregar_facturacion.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
			$("#resultados").html(datos);
		}
			});

		}


		function guardar() {
			//funcion del boton guardar
			
			//id_factura automatico
			var num_factura = $("#num_factura").val();
			var fecha = $('#fecha').val();
			var id_cliente = $("#id_cliente").val();
			var id_vendedor = 1;
			var condiciones = $("#observacion").val();
			var total_venta = $("#calculado").val();
			var estado = 1;
			var fecha_mov = $('#fecha').val();
			var num_comprobante = $("#num_comprobante").val();
			var fecha_com = $('#fecha').val();
		  	var id_proveedor = $("#id_provedor").val();
			var tipo_mov = document.getElementById("tipomov").value;
		 	
			
			$.ajax({
				type: "POST",
				url: "./ajax/agregar_nueva_factura.php",
				data: "num_factura="+num_factura+"&fecha="+fecha+"&id_cliente="+id_cliente+"&id_vendedor="+id_vendedor+"&condiciones="+condiciones+"&total_venta="+total_venta+"&estado="+estado+"&fecha_mov="+fecha_mov+"&num_comp="+num_comprobante+"&fecha_com"+fecha_com+"&id_proveedor="+id_proveedor+"&tipo_mov="+tipo_mov,
				beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");
				},
				success: function(datos){
					$("#resultados").html(datos);
					
				}
				
			});
		}
		


		$("#datos_factura").submit(function(){
		  var id_cliente = $("#campo_nit").val();
		  var id_vendedor = $("#id_vendedor").val();
		  var condiciones = $("#condiciones").val();
		  
		  if (id_cliente==""){
			  alert("Debes seleccionar un cliente");
			  $("#nombre_cliente").focus();
			  return false;
		  }
		 VentanaCentrada('./pdf/documentos/factura_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&condiciones='+condiciones,'Factura','','1024','768','true');
	 	});
		
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
