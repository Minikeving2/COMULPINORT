	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar producto</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
			<div id="resultados_ajax2"></div>

			  	<div class="form-group">
					<label for="cod" class="col-sm-3 ">Codigo</label>   
					<label for="nombre_producto" class="col-sm-9 ">Nombre</label>
					<input type="hidden" class="form-control" id="mod_id" name="mod_id">
				</div>

				<div class="form-group">
					<div class="col-sm-3">
						<input type="text" class="form-control" id="mod_cod_producto" name="mod_cod_producto" placeholder="Cod">
					</div>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="mod_nombre_producto" name="mod_nombre_producto" placeholder="Nombre del producto">
					</div>	
				</div>

			  	<div class="form-group">
					<label for="precio_producto" class="col-sm-9 ">Descripcion</label>
					<label for="descripcion_producto" class="col-sm-3 ">Estado</label>
			 	</div>
				 
			 	<div class="form-group">
					<div class="col-sm-9">
						<input type="text" class="form-control" id="mod_descripcion" name="mod_descripcion_producto">
					</div>
					
					<div class="col-sm-3">
						<select class="form-control" id="mod_estado_producto" name="mod_estado" required>
							<option value="">-- Selecciona estado --</option>
							<option value="1" selected>Activo</option>
							<option value="0">Inactivo</option>
						</select>							
					</div>
				</div>

				<div class="form-group">
					<label for="descripcion_long" class="col-sm-9 ">Descripcion larga</label>
					<div class="col-sm-3"></div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
						<textarea class="form-control" id="mod_descripcion_long" name="mod_descripcion_long"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="tipo_producto" class="col-sm-3 ">Tipo</label>
					<label for="categoria_producto" class="col-sm-3 ">Categoria</label>
					<label for="categoria_producto" class="col-sm-3 ">Precio</label>
					<label for="fecha_act" class="col-sm-3 ">Fecha</label>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<select class="form-control" id="mod_tipo_producto" name="tipo" required>
							<option value="">-- Selecciona estado --</option>
							<option value="1" selected>Servicio</option>
							<option value="0">Producto</option>
						</select>	
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="mod_categoria" name="categoria" required>
							<option value="1">Equipos (Comodato)</option>
							<option value="2">Publicidad Canopy </option>
						    <option value="3">Letrero de precios</option>
							<option value="4">Apoyo arreglos locativos</option>
							<option value="5">Apoyo Económico/Transacción</option>
							<option value="6">Apoyo Económico/Efectivo</option>
							<option value="7">Apoyo Económico/Cruce Cart.</option>
							<option value="8">Cupo Crédito Estaciones</option>
							<option value="9">Préstamos</option>
							<option value="10">Pólizas SURA</option>
							<option value="11">Descuentos Gasolina Nacional</option>
							<!--
							<option value="4">Crédito Asociados/Aportes</option>
							<option value="4">Crédito Asociados/Lib. Inv.</option>
							<option value="4">Crédito Asociados/Proyectos</option>
							<option value="4">Bono Alimentario</option>
							<option value="4">Bono Estudiantil</option>
							<option value="4">Apoyo Estudiantil</option>
							<option value="4">Apoyo Solidaridad</option>
							<option value="4">Apoyo Bienestarsocial</option> -->
						
						</select>	
					</div>
					
					<div class="col-sm-3">
						<input type="text" class="form-control input-sm" id="mod_precio_producto" name="precio_producto">
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control input-sm" id="mod_fecha">
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