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
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";
    $active_contratos="active";	
	$title="Nuevo Contrato | SistCoom V1.0";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
	
    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-edit'></i> Nuevo Contrato</h4>
		</div>
		<div class="panel-body" >
		<?php 
			include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");
		?>
			<form class="form-horizontal" role="form" id="datos_contrato" >
				<div class="form-group row" >
				  <!--
				  <label for="id" class="col-md-1 text-sm-left">ID Mov.</label>  -->  
				  <label for="fecha" class="col-md-2 ">Fecha Crea.</label> 
				  <label for="nit" class="col-md-2 control-label " style="text-align: left;" >Nit / C.C.</label>
				  <label for="nombre" class="col-md-4 text-sm-left">Tercero</label>
				  <label for="estado" class="col-md-1  text-sm-left">Estado</label>
				  <label for="nombre_rl" class="col-md-3  text-sm-left">Representante Legal</label>
                </div>
				<div class="form-group row">
				    <!--    
				    <div class="col-md-1">
					    <input type="text" class="form-control input-sm" id="id" placeholder="Id Mov." required>
					    <input id="id" type='hidden'>	
				    </div> --> 
				    <div class="col-md-2">
						<input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
					</div>
				    
					<div class="col-md-2">
					  <input type="text" class="form-control input-sm" id="nit" placeholder="Ident. Tercero" required>
					  <input id="nit" type='hidden'>	
				    </div>  
				
				    <div class="col-md-4">
					  <input type="text" class="form-control input-sm" id="nombre" placeholder="Selecciona un cliente" required>
					  <input id="nombre" type='hidden'>	
				    </div>
				
				    <div class="col-md-1">
					  <input type="text" class="form-control input-sm" id="estado" placeholder="Estado" readonly>
				    </div>
				    <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_rl" placeholder="Nombre RL" readonly>
				    </div>
			    </div> 
				<div class="form-group row">
				   <label for="comprobante" class="col-md-2 ">Nro. Contrato</label>	
				   <label for="factura" class="col-md-2 ">Nro. Póliza</label>
				   <label for="fechadoc" class="col-md-2 ">Fecha Ejecución</label>
				   <label for="tipomov" class="col-md-3 ">Tipo Contrato</label>	
				   <label for="proveedor" class="col-md-3 ">Realizado por</label>
				</div>
				<div class="form-group row">			
				    <div class="col-md-2">
					    <input type="text" class="form-control input-sm" id="numcontrato" placeholder="Número Contrato" >
					    <input id="id" type='hidden'>	
				    </div>  
				    
				    <div class="col-md-2">
					    <input type="text" class="form-control input-sm" id="numpoliza" placeholder="Número Póliza" >
					    <input id="id" type='hidden'>	
				    </div>  
				    <div class="col-md-2">
						<input type="text" class="form-control input-sm" id="fecha_inicio" value="<?php echo date("d/m/Y");?>" readonly>
					</div>    
				    <div class="col-md-3">
						<select class='form-control input-sm' id="tipo_per">
							<option value="1">Natural</option>
							<option value="2">Jurídico</option>
						</select>
					</div>		
				    <div class="col-md-3">
						<select class="form-control input-sm" id="id">
						<?php
							$sql_vendedor=mysqli_query($con,"select * from users order by nombre");
							while ($rw=mysqli_fetch_array($sql_vendedor)){
							    $id_vendedor=$rw["id"];
								$nombre_vendedor=$rw["nombre"]." ".$rw["nit"];
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
				   <label for="total" class="col-md-3 " readonly>Total </label>
				</div>
				<div class="form-group row">
				    <div class="col-md-9">
				      <textarea class="form-control" id="observacion" name="Observaciones"   maxlength="100" ></textarea>	    
				    </div>
					<div class="col-md-3">
					    <input type="text" class="form-control input-sm" id="nit" placeholder="Total" >
					    <input id="total" type='hidden'>	
				    </div> 
					<div></br></div>				
				    <div class="col-md-12">
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
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#guardarcontra">
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
	<script type="text/javascript" src="js/nuevo_contrato.js"></script>
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
								$('#nombre_cliente').val(ui.item.nombre_cliente);
								$('#tel1').val(ui.item.telefono_cliente);
								$('#mail').val(ui.item.email_cliente);			
							 }
						});
					});
					
	$("#nombre_cliente" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_cliente" ).val("");
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
						}
			});	
	</script>

  </body>
</html>