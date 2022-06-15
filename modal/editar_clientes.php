<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>Editar Tercero</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_cliente" name="editar_cliente">
			<div id="resultados_ajax"></div>
			<div class="panel panel-default">
               <div class="panel-body p-3 mb-2 bg-primary text-white">
			    <span> Datos del Tercero </span>
               </div>
            </div> 
			
			   <div class="form-group">
			   <!-- 
			   <label for="id" class="col-sm-2 ">ID</label>-->	
			    <label for="nit" class="col-sm-2 ">NIT/C.C.</label>   
				<label for="nombre_cliente" class="col-sm-6 ">Nombre</label>
				<label for="codigo_sicom" class="col-sm-2 ">Cód. SICOM</label>
				<label for="estado" class="col-sm-2 ">Estado</label>
			  </div>
			  <div class="form-group">			
			    
				  
				<div class="col-sm-2">
					<input type="hidden" class="form-control" id="mod_id_cliente" name="id_cliente">
					<input type="text" class="form-control" id="mod_nit" name="nit" > </div>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="mod_nombre_cliente" name="nombre_cliente" ></div>
				<div class="col-sm-2">
					<input type="text" class="form-control" id="mod_codigo_sicom" name="codigo_sicom" > </div>
				<div class="col-sm-2">
				 <select class="form-control" id="estado" name="estado" required>
					<option value="">-- Selecciona Estado --</option>
					<option value="1" selected>Activo</option>
					<option value="0">Inactivo</option>
				  </select> 
				</div>		
			  </div>
	
			  <div class="form-group">
			    <label for="municipio" class="col-sm-3 ">Municipio</label>
				<label for="cupo" class="col-sm-2 ">Cupo</label>   
			    <label for="tipo_tercero" class="col-sm-3 ">Tipo Tercero</label>
				<label for="fecha_crea" class="col-sm-2 ">Fecha Creac.</label>
				<label for="date_added" class="col-sm-2">Fecha Act.</label>
			  </div>
			  
			  <div class="form-group">	
			    <div class="col-md-3">
						<select class="form-control input-sm" id="id">
							<script>
								var select = document.getElementById('id');
								select.addEventListener('change',
								function(){
									var selectedOption = this.options[select.selectedIndex];
									console.log(selectedOption.value);
								});
  							</script>
							<?php
								$sql_municipio=mysqli_query($con,"select * from municipios order by nombre");
								while ($rw=mysqli_fetch_array($sql_municipio)){
									$id_municipio=$rw["id"];
									$nombre_municipio=$rw["nombre"];
							?>
								<option value="<?php echo $id_municipio?>" <?php echo $selected;?>><?php echo $nombre_municipio?></option>
							<?php
											}
							?>
						</select>
					</div>			 
			 
			    <div class="col-sm-2">
					<input type="text" class="form-control" id="mod_cupo" name="cupo" > </div>
			    <div class="col-sm-3">
				 <select class="form-control" id="tipo_tercero" name="tipo_tercero" required>
					<option value="">-- Selecciona Tipo Tercero --</option>
					<option value="1" selected>E - EDS</option>
					<option value="0">A - Asociado</option>
				  </select></div>
				<div class="col-sm-2">
					<input type="text" class="form-control input-sm" id="mod_date_added" value="" readonly></div>
				<div class="col-sm-2">
				<input type="text" class="form-control input-sm" id="date_act" value="<?php echo date("d/m/Y");?>" readonly></div>
			  </div>
			  
			  <div class="form-group">
			   
			    <label for="telefono_cliente" class="col-sm-3 ">Teléfono</label>
				<label for="email_cliente" class="col-sm-4 ">Email</label>
				<label for="direccion_cliente" class="col-sm-5 ">Dirección</label>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-3">
					<input type="text" class="form-control" id="mod_telefono_cliente" name="telefono_cliente" > </div>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="mod_email_cliente" name="email_cliente" > </div>
				<div class="col-md-5">
				      <textarea class="form-control" id="mod_direccion_cliente" name="direccion_cliente"   maxlength="100" ></textarea>	    
				    </div>
				</div>  

				<div class="panel panel-default">
               <div class="panel-body p-3 mb-2 bg-primary text-white">
			   <span class="d-block  text-white"> Datos del Representante legal</span>
               </div>
            </div> 
			  <div class="form-group">
			   
			  
			  	<label for="cc_rp" class="col-sm-2 ">C.C. RP</label>
				<label for="nombre_rp" class="col-sm-7 ">Nombre RepLegal</label>
				<label for="tel_rp" class="col-sm-3 ">Teléf. RepLegal</label>
			  </div>
			  <div class="form-group">
		    	<div class="col-sm-2">
					<input type="text" class="form-control" id="mod_cc_rp" name="cc_rp" > </div>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="mod_nombre_rp" name="nombre_rp" ></div>    
				<div class="col-sm-3">
					<input type="text" class="form-control" id="mod_telefono_rp" name="tel_rp" > </div>
			  </div>
				
			  <div class="form-group">
			  
				<label for="email_rp" class="col-sm-6 ">Email RepLegal</label>
				<label for="dir_rp" class="col-sm-6 ">Dir. RepLegal</label>
			  </div>
			  
			  <div class="form-group">
			
			  <div class="col-sm-6">
					<input type="text" class="form-control" id="mod_email_rp" name="email_rp" > </div>
				<div class="col-md-6">
				      <textarea class="form-control" id="mod_direccion_rp" name="direccion_rp"   maxlength="100" ></textarea>	    
				    </div>
		      </div>
			

			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>