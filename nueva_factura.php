<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";
	$active_contratos="";
	$active_mapa = "";	
	$title="Nueva Factura | SistCoom V1.0";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
	<link rel="stylesheet" href="css/tabla.css">
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
	
    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-edit'></i> Nuevo Movimiento</h4>
		</div>
		<div class="panel-body" >
		<?php 
			include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");
			include("modal/buscar_cliente.php");
		?>
			<form class="form-horizontal" role="form" id="datos_factura" >
				<div class="form-group row" >
				  <!--
				  <label for="id" class="col-md-1 text-sm-left">ID Mov.</label>  -->  
				  <label for="fecha" class="col-md-1 ">Fecha</label> 
				  <label for="nit" class="col-md-2 control-label " style="text-align: left;" id="ca" >Nit / C.C.</label>
				  <label for="nombre" class="col-md-4 text-sm-left">Tercero</label>
				  <label for="nombre" class="col-md-1 text-sm-left"><!--avers--></label>
				  <label for="estado" class="col-md-1  text-sm-left">Estado</label>
				  <label for="nombre_rl" class="col-md-3  text-sm-left">Representante Legal</label>
                </div>
				<div class="form-group row">
				    <!-- id cliente -->
					<input id="id_cliente" type='hidden'>
					<input id="id_vendedor" type='hidden' value="<?php echo $_SESSION['user_id'];?>">
				    <div class="col-md-1">
						<input type="text" class="form-control input-sm" id="fecha_mov" value="<?php echo date("d/m/Y");?>" readonly>
					</div>
				    
					<div class="col-md-2">
					  <input type="text" class="form-control input-sm" id="campo_nit" placeholder="Ident. Tercero" readonly>
					  <input id="id_cliente" type='hidden'>	
				    </div>  
				
				    <div class="col-md-4">
					  <input type="text" class="form-control input-sm" id="campo_nombre_cliente" placeholder="Selecciona un cliente" readonly>
					  <input id="id_cliente" type='hidden'>

				    </div>

					<div class="col-md-1">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buscarCliente">
							Buscar
						</button>
				    </div>
				
				    <div class="col-md-1">
					  <input type="text" class="form-control input-sm" id="campo_estado" placeholder="Estado" readonly>
				    </div>
				    <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_rl" placeholder="Nombre RL" readonly>
				    </div>
			    </div> 
				<div class="form-group row">
				   <label for="comprobante" class="col-md-2 ">Nro. Comprobante</label>	
				   <label for="factura" class="col-md-1 ">Fecha Com.</label>
				   <label for="factura" class="col-md-2 ">Nro. Factura</label>
				   <label for="fechadoc" class="col-md-1 ">Fecha Fac.</label>
				   <label for="tipomov" class="col-md-3 ">Tipo Mov.</label>	
				   <label for="proveedor" class="col-md-3 ">Proveedor</label>
				</div>
				<div class="form-group row">			
				    <div class="col-md-2">
					    <input type="text" class="form-control input-sm" id="num_comprobante" placeholder="Número Comprobante" >
					    <input id="id" type='hidden'>	
				    </div>
					  
				    <div class="col-md-1">
						<input type="date" class="form-control input-sm" id="fecha_comprobante" value="">
					</div>
				    <div class="col-md-2">
					    <input type="text" class="form-control input-sm" id="num_factura" placeholder="Número Factura" >
					    <input id="id" type='hidden'>	
				    </div>  
				    <div class="col-md-1">
						<input type="date" class="form-control input-sm" id="fecha_factura" value="">
					</div>
				    <div class="col-md-3">
						<select class='form-control input-sm' id="tipomov">
							<option value="1">Equipos (Comodato)</option>
							<option value="2">Publicidad Canopy </option>
						    <option value="3">Letrero de precios</option>
							<option value="4">Apoyo arreglos locativos</option>
							<option value="5">Apoyo Económico/Transacción</option>
							<option value="6">Apoyo Económico/Efectivo</option>
							<option value="7">Apoyo Económico/Cruce Cart.</option>
                            <option value="8">Crédito/Transacción</option>
							<option value="9">Crédito/Cruce Cart.</option>
							<option value="10">Cupo Crédito Estaciones</option>
							<option value="11">Préstamos</option>
							<option value="12">Pólizas SURA</option>
							<option value="13">Descuentos Gasolina Nacional</option>
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
				    <div class="col-md-3">
						<select class="form-control input-sm" id="id_provedor">
						<?php
							$sql_vendedor=mysqli_query($con,"select * from clientes where tipo_tercero = 'P' order by nombre_cliente");
							while ($rw=mysqli_fetch_array($sql_vendedor)){
							    $id_vendedor=$rw["id_cliente"];
								$nombre_vendedor=$rw["nombre_cliente"]." ".$rw["nit"];
								if ($id_vendedor==$_SESSION['user_id']){
								   $selected="selected";
									} else {
												$selected="";
											}
						?>
						<option value="<?php echo $id_vendedor?>" <?php echo $selected;?>><?php echo $nombre_vendedor?></option>
						<?php
										}
						?>
						</select>
					</div>			
				</div>
				<div class="form-group row">
				   <label for="observacion" class="col-md-9 ">Observación</label>	
				   <label for="total" class="col-md-1 ">Contrapres.</label>
				   <label for="total" class="col-md-2 ">Total </label>
				</div>
				<div class="form-group row">
				    <div class="col-md-9">
				      <textarea class="form-control" id="observacion" name="Observaciones"   maxlength="100" ></textarea>	    
				    </div>
				    <div class="col-md-1">
					    <input type="number" class="form-control input-sm" id="contraprestacion" min="0" value="0">
				    </div> 
					<div class="col-md-2">
					    <input type="text" class="form-control input-sm" id="calculado" placeholder="Total">
					    <input id="total" type='hidden'>	
				    </div> 
				</div>				
				    <div class="col-md-12" id="separacion_btn">
					  <div class="pull-right">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProducto">
						 	<span class="glyphicon glyphicon-plus"></span> Nuevo producto
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoCliente">
						 	<span class="glyphicon glyphicon-user"></span> Nuevo cliente
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
						 	<span class="glyphicon glyphicon-search"></span> Agregar productos y servicios
						</button>
						<button type="button" class="btn btn-success" id="#guardarfact" onclick="guardar()">
						 	<span class="glyphicon glyphicon-floppy-disk"></span> Guardar
						</button>
						<button type="submit" class="btn btn-primary">
						  	<span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					   </div>	
				    </div>
			</form>	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
		</div>
	</div>		
		  <div class="row-fluid">
			<div class="col-md-12">
			
	

			
			</div>	
		 </div>
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/nueva_factura.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
	$(function() {
		$("#nombre_cliente").autocomplete({
		source: "./ajax/autocomplete/clientes.php",
		minLength: 2,
		select: function(event, ui) {
		event.preventDefault();
		   $('#id_cliente').val(ui.item.id_cliente);
		   $('#nit').val(ui.item.nit);
		   $('#nombre_cliente').val(ui.item.nombre_cliente);
		   $('#status_cliente').val(ui.item.status_cliente);
		   $('#nombre_rp').val(ui.item.nombre_rp);			
		   } 
		});
	});
					
	$("#nombre_cliente" ).on( "keydown", function( event ) {
		if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
		{
			$("#id_cliente" ).val("");
			$("#nit" ).val("");
			$("#nombre_cliente" ).val("");
			$("#status_cliente" ).val("");
			$("#nombre_rp" ).val("");
											
		}
		if (event.keyCode==$.ui.keyCode.DELETE){
			$("#niT" ).val("");
			$("#id_cliente" ).val("");
			$("#status_cliente" ).val("");
			$("#nombre_rp" ).val("");
		}
	});	
	
	$(function() {
		$("#nit").autocomplete({
		source: "./ajax/autocomplete/clientes.php",
		minLength: 2,
		select: function(event, ui) {
		event.preventDefault();
			$('#id_cliente').val(ui.item.id_cliente);
			$('#nombre_cliente').val(ui.item.nombre_cliente);
			$('#status_cliente').val(ui.item.telefono_cliente);
			$('#nombre_rp').val(ui.item.email_cliente);			
			}
		});
	});
					
	$("#nit" ).on( "keydown", function( event ) {
	    if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
		{
			$("#id_cliente" ).val("");
			$("#status_cliente" ).val("");
			$("#nombre_rp" ).val("");
										
		}
		if (event.keyCode==$.ui.keyCode.DELETE){
			$("#nombre_cliente" ).val("");
			$("#id_cliente" ).val("");
			$("#status_cliente" ).val("");
			$("#nombre_rp" ).val("");
						}
		});			
	</script>

  </body>
</html>