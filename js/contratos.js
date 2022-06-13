		$(document).ready(function(){
			load(1);
			
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_contratos.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					$('[data-toggle="tooltip"]').tooltip({html:true}); 
					
				}
			})
		}
		
		function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Realmente deseas eliminar el contrato")){	
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_contratos.php",
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
		
		function imprimir_contrato(id_contrato){
			VentanaCentrada('./pdf/documentos/ver_contrato.php?id_contrato='+id_contrato,'Contrato','','1024','768','true');
		}
