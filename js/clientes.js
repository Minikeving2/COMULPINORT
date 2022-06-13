		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_clientes.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
	
       function eliminar (id)
		{
			var q= $("#q").val();
		    if (confirm("Realmente deseas eliminar el cliente")){	
		       $.ajax({
               type: "GET",
               url: "./ajax/buscar_clientes.php",
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

$( "#editar_cliente" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_cliente.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

	function obtener_datos(id){
			var nombre_cliente = $("#nombre_cliente"+id).val();
			var telefono_cliente = $("#telefono_cliente"+id).val();
			var email_cliente = $("#email_cliente"+id).val();
			var direccion_cliente = $("#direccion_cliente"+id).val();
			var status_cliente = $("#status_cliente"+id).val();

			var codigo_sicom = $("#codigo_sicom"+id).val();
			var nit = $("#nit"+id).val();
			var cupo = $("#cupo"+id).val();
			var tipo_tercero = $("#tipo_tercero"+id).val();
			var fecha_act = $("#fecha_act"+id).val();

			var nombre_rp = $("#nombre_rp"+id).val();
			var tel_rp = $("#tel_rp"+id).val();
			var email_rp = $("#email_rp"+id).val();
			var dir_rp = $("#dir_rp"+id).val();
	
			$("#mod_nombre").val(nombre_cliente);
			$("#mod_telefono").val(telefono_cliente);
			$("#mod_email").val(email_cliente);
			$("#mod_direccion").val(direccion_cliente);
			$("#mod_estado").val(status_cliente);
			$("#mod_id").val(id);

			$("#mod_codsicom").val(codigo_sicom);
			$("#mod_nit").val(nit);
			$("#mod_cupo").val(cupo);
			$("#mod_tipoter").val(tipo_tercero);
			$("#mod_fecact").val(fecha_act);
			
		    $("#mod_nombrerp").val(nombre_rp);
			$("#mod_telefonorp").val(tel_rp);
			$("#mod_emailrp").val(email_rp);
			$("#mod_direccionrp").val(dir_rp);
		}
	
		
		

