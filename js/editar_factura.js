
		$(document).ready(function(){
			load(1);
			load_Cliente();
			$( "#resultados" ).load( "ajax/editar_facturacion.php" );
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
	function agregarProducto (id)
		{
			var id_factura = getParameterByName('id_factura');
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
             url: "./ajax/editar_facturacion.php",
             data: "id="+id+"&id_factura="+id_factura+"&precio_venta="+precio_venta+"&cantidad="+cantidad,
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
             url: "./ajax/editar_facturacion.php",
             data: "id="+id,
		     beforeSend: function(objeto){
			 $("#resultados").html("Mensaje: Cargando...");
		    },
            success: function(datos){
		     $("#resultados").html(datos);
		     }
			});

	}
	
	function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	$("#datos_factura").submit(function(event){
		var id_cliente = $("#id_cliente").val();
		var num_fact=$("#num_factura").val();
		var fecha_factura=$("#fecha_factura").val();
		var num_comp=$("#num_comprobante").val();
		var fecha_comp=$("#fecha_comprobante").val();
		var tipo_mov=document.getElementById("tipomov").value;
		var proveedor=document.getElementById("id_proveedor").value;
		var observacion=$("#observacion").val();
		var total=$("#calculado").val();
		var id_vendedor=$("#id_vendedor").val();

		var parametros = "id_cliente="+id_cliente+"&num_fact="+num_fact+"&fecha_fact="+fecha_factura+"&num_comp="+num_comp+"&fecha_comp="+fecha_comp+"&tipo_mov="+tipo_mov+"&proveedor="+proveedor+"&observacion="+observacion+"&total="+total+"&id_vendedor="+id_vendedor;
		if (id_cliente==""){
		  alert("Debes seleccionar un cliente");
		  $("#nombre_cliente").focus();
		  return false;
		}
		  console.log(parametros); 
			 $.ajax({
					type: "POST",
					url: "ajax/editar_factura.php",
					data: parametros,
					 beforeSend: function(objeto){
						$(".editar_factura").html("Mensaje: Cargando...");
					  },
					success: function(datos){
						$(".editar_factura").html(datos);
					}
			});
			
			 event.preventDefault();
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

		function imprimir_factura(id_factura){
			VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}