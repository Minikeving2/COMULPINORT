
		$(document).ready(function(){
			$("#num_contrato_otrosi").attr('disabled', true);
			load(1);
			load_Cliente(1);
			cambio();
			
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
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
		function cambio() {
			console.log("detecto el boton");
				if( $('#otrosi').is(':checked') ) {
					console.log("activo");
					$("#num_contrato_otrosi").attr('disabled', false);
				} else {
					console.log("no activo");
					$("#num_contrato_otrosi").attr('disabled', true);
				}
				
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
		function guardar() {
			
			//funcion del boton guardar
			
			//id_factura automatico
			var num_contrato = $("#num_contrato").val();
			var num_poliza = $('#num_poliza').val();
			var tipo_per = $("#tipo_per").val();
			var id = $("#id").val();

			var fecha_inicio = $('#fecha_inicio').val();
			var fecha_fin = $("#fecha_fin").val();
			var id_cliente = $('#id_cliente').val();

			var fecha_creacion = $("#fecha_creacion").val();
			
			if( $('#clau_legal').is(':checked') ) {
				alert('Seleccionado');
			}
			if( $('#otrosi').is(':checked') ) {
				alert('Seleccionado');
			}
			if( $('#clau_penal').is(':checked') ) {
				alert('Seleccionado');
			}
			
			
			if (id_cliente==""){
				alert("Debes seleccionar un cliente");
				$("#nombre_cliente").focus();
				return false;
			}
			

			$.ajax({
				type: "POST",
				url: "./ajax/agregar_nueva_factura.php",
				data: "id_vendedor="+id_vendedor+"&fecha_mov="+fecha+"&id_cliente="+id_cliente+"&num_com="+num_comprobante+"&fecha_com="+fecha_com+"&num_fact="+num_factura+"&fecha_fact="+fecha_fact+"&tipo_mov="+tipo_mov+"&condiciones="+condiciones+"&total_venta="+total_venta+"&estado="+estado+"&id_proveedor="+id_proveedor,
				beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");
				},
				success: function(datos){
					$("#resultados").html(datos);
				}
			})
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
		
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/agregar_contratacion.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		
		$("#datos_contrato").submit(function(){
		  var id_cliente = $("#id_cliente").val();
		  var id_vendedor = $("#id_vendedor").val();
		  var condiciones = $("#condiciones").val();
		  
		  if (id_cliente==""){
			  alert("Debes seleccionar un cliente");
			  $("#nombre_cliente").focus();
			  return false;
		  }
		 VentanaCentrada('./pdf/documentos/contrato_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&condiciones='+condiciones,'Factura','','1024','768','true');
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
		});
		
		
