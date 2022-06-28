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
	$title="Editar Contrato | SISTCOOM V1.0";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	if (isset($_GET['id_contrato']))
	{
		$id_contrato=intval($_GET['id_contrato']);
		$campos = "contrato.id_contrato, contrato.numcontrato, contrato.numpoliza, contrato.tipo_per, contrato.id_usuario, contrato.fecha_inicio, contrato.fecha_final, contrato.id_cliente, clientes.nit, clientes.nombre_cliente, clientes.status_cliente, clientes.nombre_rp, contrato.fecha_crea, contrato.clausulagal, contrato.clausulapenal, contrato.id_contrato_rel, contrato.duracion, contrato.descripcion, contrato.valor ";
		$sql_contrato=mysqli_query($con,"select $campos from contrato, clientes where contrato.id_cliente=clientes.id_cliente and id_contrato='".$id_contrato."'");
		$count=mysqli_num_rows($sql_contrato);
		if ($count==1)
		{		
			$rw_contrato=mysqli_fetch_array($sql_contrato);
			$numero_contrato=$rw_contrato['numcontrato'];
			$num_poliza=$rw_contrato["numpoliza"];
			$tipo_contrato=$rw_contrato["tipo_per"];
			$id_vendedor_db=$rw_contrato['id_usuario'];
			$fecha_inicio= str_replace('/','-',date("Y/m/d", strtotime($rw_contrato['fecha_inicio'])) );
			$fecha_final= str_replace('/','-',date("Y/m/d", strtotime($rw_contrato['fecha_final'])) );
			$id_cliente=$rw_contrato['id_cliente'];
			$nit_cliente=$rw_contrato["nit"];
			$nombre_cliente=$rw_contrato['nombre_cliente'];
			$estado_cliente=$rw_contrato["status_cliente"];
			$nombre_rp=$rw_contrato["nombre_rp"];
			$fecha_crea= str_replace('/','-',date("d/m/Y", strtotime($rw_contrato['fecha_crea'])));
			$clau_legal=$rw_contrato["clausulagal"];
			$clau_penal=$rw_contrato["clausulapenal"];
			$otrosi=$rw_contrato["id_contrato_rel"];
			$duracion=$rw_contrato["duracion"];
			$condiciones=$rw_contrato['descripcion'];
			$valor_contrato=$rw_contrato["valor"];
			$id_contrato=$rw_contrato["id_contrato"];
			$_SESSION['id_contrato']=$id_contrato;
			$_SESSION['numcontrato']=$numero_contrato;
			$_SESSION["venderdor"]=$id_vendedor;
		}	
		else
		{
			header("location: contratos.php");
			exit;	
		}
	} 
	else 
	{
		header("location: contratos.php");
		 exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
	<link rel="stylesheet" href="css/tabla.css">
	<link rel="stylesheet" href="css/fechas.css">
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-edit'></i> Editar contratos</h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");
			include("modal/buscar_cliente.php");
		?>
			<form class="form-horizontal" role="form" id="datos_contrato">
			<div class="form-group row">
				   <label for="comprobante" class="col-md-2 ">Nro. Contrato</label>	
				   <label for="factura" class="col-md-2 ">Nro. Póliza</label>
				   <label for="tipomov" class="col-md-2 ">Tipo Contrato</label>	
				   <label for="proveedor" class="col-md-2 ">Realizado por</label>
				   <label for="fechadoc" class="col-md-2 ">Fecha Inicio</label>
				   <label for="fecha" class="col-md-2 ">Fecha Finalizacion</label> 
				</div>
				<div class="form-group row">			
				    <div class="col-md-2">
					    <input type="text" class="form-control input-sm" id="num_contrato" name="num_contrato" placeholder="Número Contrato" value="<?php echo $numero_contrato;?>">
					    <input id="id" type='hidden'>	
				    </div>  
				    
				    <div class="col-md-2">
					    <input type="text" class="form-control input-sm" id="num_poliza" name="num_poliza" placeholder="Número Póliza" value="<?php echo $num_poliza;?>">	
				    </div>
				    <div class="col-md-2">
						<select class='form-control input-sm' id="tipo_per" name="tipo_per">
							<option value="1">Natural</option>
							<option value="2">Jurídico</option>
						</select>
						<script>
							    document.querySelector('#tipo_per').value=<?php echo $tipo_contrato; ?>;	
						</script>
					</div>		
				    <div class="col-md-2">
						<select class="form-control input-sm" id="id" name="vendedor">
						<?php
							$sql_vendedor=mysqli_query($con,"select * from users");
							while ($rw=mysqli_fetch_array($sql_vendedor)){
							    $id_vendedor=$rw["user_id"];
								$nombre_vendedor=$rw["firstname"]." ".$rw["lastname"];
								if ($id_vendedor==$_SESSION['user_id']){
								   $selected="selected";
									} else {
										$selected="";
									}
						?>
						<option value="<?php echo $id_vendedor;?>"<?php echo $selected;?>><?php echo $nombre_vendedor;?></option>
						<?php
								}
						?>
						</select>
					</div>	
					<div class="col-md-2">
						<input type="date" class="form-control input-sm" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fecha_inicio;?>">
					</div> 
					<div class="col-md-2">
						<input type="date" class="form-control input-sm" id="fecha_fin" name="fecha_fin" value="<?php echo $fecha_final;?>">
					</div>		
				</div>
				<div class="form-group row" >
				  <!--
				  <label for="id" class="col-md-1 text-sm-left">ID Mov.</label>  -->  
				  
				  <label for="nit" class="col-md-2 " style="text-align: left;" >Nit / C.C.</label>
				  <label for="nombre" class="col-md-4 ">Tercero</label>
				  <label for="nombre" class="col-md-1 "><!--avers--></label>
				  <label for="estado" class="col-md-1  ">Estado</label>
				  <label for="nombre_rl" class="col-md-3  ">Representante Legal</label>
				  <label for="estado" class="col-md-1 ">Fecha Crea.</label>
                </div>
				<div class="form-group row">
				    <!--    
				    <div class="col-md-1">
					    <input type="text" class="form-control input-sm" id="id" placeholder="Id Mov." required>
					    <input id="id" type='hidden'>	
				    </div> --> 
				   
				    
					<div class="col-md-2">
					  <input id="id_cliente" type='hidden' name="id_cliente" value="<?php echo $id_cliente;?>">
					  <input type="text" class="form-control input-sm" id="campo_nit" placeholder="Ident. Tercero" value="<?php echo $nit_cliente;?>" readonly required>
					 	
				    </div>  
				
				    <div class="col-md-4">
					  <input type="text" class="form-control input-sm" id="campo_nombre_cliente" placeholder="Selecciona un cliente" value="<?php echo $nombre_cliente;?>" readonly required>
					  	
				    </div>
					<div class="col-md-1">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buscarCliente">
							Buscar
						</button>
				    </div>
				    <div class="col-md-1">
						<input type="text" class="form-control input-sm" id="campo_estado" placeholder="Estado" readonly value="<?php 
						if ($estado_cliente==1){
							echo "Activo";
						} else {
							echo "Inactivo";
						}
						?>">
				    </div>
					  
				    <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_rl" placeholder="Nombre RL" readonly value="<?php echo $nombre_rp;?>">
				    </div>
					<div class="col-md-1">
						<input type="text" class="form-control input-sm" id="fecha_creacion" value="<?php echo date("d/m/Y");?>" readonly>
					</div>
				</div>
				<div class="form-group row" style="margin-top: 30px;">
						
						
						
						
						<div class="col-md-2">
							<label for="nombre">Clausula Legal</label>
							<input type="checkbox" class="form-check-input" id="clau_legal" name="clau_legal">
							<script>
								document.getElementById('clau_legal').checked = <?php if ($clau_legal==1){echo "1";}else{echo "0";}?>;
							</script>
				   		</div>
						
						<div class="col-md-2">
							<label for="estado" >Clausula Penal</label>
							<input type="checkbox" class="form-check-input" id="clau_penal" name="clau_penal">
							<script>
								document.getElementById('clau_penal').checked = <?php if ($clau_penal==1){echo "1";}else{echo "0";}?>;
							</script>
				    	</div>
						<div class="col-md-1">
							<label for="nit" style="text-align: left;" >Otrosi</label>
							<input type="checkbox" class="form-check-input" id="otrosi" onclick="cambio()">
							<script>
								document.getElementById('otrosi').checked = <?php if ($otrosi==""){echo "0";}else{echo "1";}?>;
							</script>
						</div>
						<div class="col-md-2">
					 		<input type="text" class="form-control input-sm" id="num_contrato_otrosi" name="otrosi" placeholder="Numero de contrato" value="<?php echo $otrosi;?>">
				   		</div>
						<div class="col-md-5">
							<div class="col-md-2">
								<label id="etiqueta_correccion" style="text-align: left;" >Duracion</label>
							</div>	
							<div class="col-md-3">
								<input type="number" class="form-control" id="duracion" name="duracion" min="0" value="<?php echo $duracion;?>">
							</div>
							<div class="col-md-7">
								<input type="file"  name="archivo" id="archivo" enctype="multipart/form-data">
							</div>
						</div>
						
				</div>
				<div class="form-group row">
					
					
					
					
				</div>
			     
				<div class="form-group row">
				   <label for="observacion" class="col-md-9 ">Observación</label>	
				   <label for="total" class="col-md-3 " readonly>Total </label>
				</div>
				<div class="form-group row">
				    <div class="col-md-9">
				      <textarea class="form-control" id="observacion" name="observaciones"   maxlength="100" ><?php echo $condiciones;?></textarea>	    
				    </div>
					<div class="col-md-3">
					    <input type="text" class="form-control input-sm" id="calculado" name="calculado" placeholder="Total" value="<?php echo  number_format ($valor_contrato,2);?>" >
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
						<button type="submit" class="btn btn-default" id="#guardarcontrato" >
							<span class="glyphicon glyphicon-refresh"></span> Actualizar datos
						</button>
					   </div>	
				    </div>
			</form>	
			<div class="clearfix"></div>
				<div class="editar_factura" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
			
		</div>
	</div>		
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/editar_contrato.js"></script>
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