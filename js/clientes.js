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
	 var aux = document.querySelector('#id').value;
	 
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_cliente.php",
			data: parametros+"&id_mun='"+aux+"'",
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
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
			$('#myModal2').modal('hide');
			$("#resultados").html(datos);
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
			var date_added = $("#date_added"+id).val();
			
			var id_municipio = $('#id_municipio'+id).val();
			var cc_rp = $("#cc_rp"+id).val();
			var nombre_rp = $("#nombre_rp"+id).val();
			var tel_rp = $("#tel_rp"+id).val();
			var email_rp = $("#email_rp"+id).val();
			var dir_rp = $("#dir_rp"+id).val();

			$("#mod_id_cliente").val(id);
			$("#mod_nombre_cliente").val(nombre_cliente);
			$("#mod_telefono_cliente").val(telefono_cliente);
			$("#mod_email_cliente").val(email_cliente);
			$("#mod_direccion_cliente").val(direccion_cliente);
			$("#mod_estado").val(status_cliente);
			$("#mod_id").val(id);

			$("#mod_codigo_sicom").val(codigo_sicom);
			$("#mod_nit").val(nit);
			$("#mod_cupo").val(cupo);
			$("#mod_tipoter").val(tipo_tercero);
			$("#mod_date_added").val(date_added);
			document.querySelector('#mod_id_municipio').value=id_municipio;	
			$("#mod_cc_rp").val(cc_rp);
		    $("#mod_nombre_rp").val(nombre_rp);
			$("#mod_telefono_rp").val(tel_rp);
			$("#mod_email_rp").val(email_rp);
			$("#mod_direccion_rp").val(dir_rp);
		}
	
		
		

