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
	$a = $_SESSION['user_level'];
	if ($a < 0) {
        header("location: login.php");
		exit;
    }
	$active_facturas="";
	$active_productos="";
	$active_clientes="active";
	$active_usuarios="";
    $active_contratos="";	
	$active_mapa = "";
	$active_informes = "";
	$active_ventas = "";	
	$title=" Clientes | SistCoom V1.0";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
    mysqli_query($con,"SET NAMES 'utf8'");
	if (isset($_GET['id_cliente'])){
		$id_cliente=intval($_GET['id_cliente']);
		$sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='".$id_cliente."'");
		$count=mysqli_num_rows($sql_cliente);
		if ($count==1){
				$rw_busqueda=mysqli_fetch_array($sql_cliente);
				$id_cliente=$rw_busqueda['id_cliente'];
				$nombre_cliente=$rw_busqueda['nombre_cliente'];
                $tel_cliente=$rw_busqueda['telefono_cliente'];
				$email_cliente=$rw_busqueda['email_cliente'];
				$dir_Cliente=$rw_busqueda['direccion_cliente'];
                $estado=$rw_busqueda['status_cliente'];
                $date_added=$rw_busqueda['date_added'];
                $codigo_sicom=$rw_busqueda['codigo_sicom'];
				$nit_cliente=$rw_busqueda['nit'];
                $cc_rp=$rw_busqueda['cc_rp'];
				$nombre_rp=$rw_busqueda['nombre_rp'];
                $tipo_tercero=$rw_busqueda['tipo_tercero'];
                $tel_rp=$rw_busqueda['tel_rp'];
                $cel_eds=$rw_busqueda['cel_eds'];
                $cel_rp=$rw_busqueda['cel_rp'];
                $email_rp=$rw_busqueda['email_rp'];
                $dir_rp=$rw_busqueda['dir_rp'];
				$id_municipio_db=$rw_busqueda['id_municipio'];
                $cupo=$rw_busqueda['cupo'];
                $fecha_act=$rw_busqueda['fecha_act'];
                $usuario=$rw_busqueda['usuario'];

				
		}	
		else
		{
			header("location: clientes.php");
			exit;	
		}
	} 
	else 
	{
		header("location: clientes.php");
		exit;
	}
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
			<h4><i class='glyphicon glyphicon-edit'></i> Datos Cliente</h4>
		</div>
		<div class="panel-body" >
		<?php 
			include("modal/doc_cliente.php");
			/*include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");
			include("modal/buscar_cliente.php");*/
		?>
			<form class="form-horizontal" method="POST" id="editar_cliente" name="editar_cliente">
				
				<div class="form-group row">
				   <label for="comprobante" class="col-md-1 ">NIT/C.C.</label>	
				   <label for="factura" class="col-md-4 ">Nombre</label>
				   <label for="tipomov" class="col-md-1 ">Cód. SICOM</label>	
				   <label for="proveedor" class="col-md-1 ">Estado</label>
				   <label for="fechadoc" class="col-md-2 ">Municipio</label>
				   <label for="fecha" class="col-md-1 ">Cupo</label> 
				   <label for="fecha" class="col-md-2 ">Tipo Tercero</label> 
				</div>
				<div class="form-group row">			
				    <div class="col-md-1">
					    <input type="text" class="form-control input-sm" id="nit" name="nit" value="<?php echo $nit_cliente;?>">	
				    </div>  
				    
				    <div class="col-md-4">
					    <input type="text" class="form-control input-sm" id="nombre_tercero" name="nombre_tercero" value="<?php echo $nombre_cliente;?>">	
				    </div>

				    <div class="col-md-1">
						<input type="text" class="form-control input-sm" id="sicom" name="sicom" value="<?php echo $codigo_sicom;?>">
					</div>

				    <div class="col-md-1">
						<select class="form-control" id="estado" name="estado" id="estado" required>
							<option value="">-- Selecciona Estado --</option>
							<option value="1">Activo</option>
							<option value="0">Inactivo</option>
							<option value="2">Retirado</option>
							<option value="3">En Proceso</option>
						</select>
						<script>
							document.querySelector('#estado').value=<?php echo $estado; ?>;	
						</script>
					</div>	

					<div class="col-md-2">
						<select class="form-control input-sm" id="mun" name="mun" value="<?php echo $id_municipio;?>">
							<script>
								var select = document.getElementById('mun');
								select.addEventListener('change',function(){
									var selectedOption = this.options[select.selectedIndex];
									console.log("aver");		
								});
							</script>
							<?php
							    mysqli_query($con,"SET NAMES 'utf8'");
								$sql_municipio=mysqli_query($con,"select * from municipios order by nombre");
								while ($rw=mysqli_fetch_array($sql_municipio)){
									$id_municipio=$rw["id"];
									$nombre_municipio=$rw["nombre"];
							?>
								<option value="<?php echo $id_municipio?>"><?php echo $nombre_municipio?></option>
							<?php
											}
							?>
							<script>
								document.querySelector('#mun').value=<?php echo $id_municipio_db; ?>;	
							</script>
						</select>
					</div> 

					<div class="col-md-1">
						<input type="text" class="form-control input-sm" id="cupo" name="cupo" value="<?php echo $cupo;?>">
					</div>	
					
					<div class="col-md-2">
						<select class="form-control" id="tipo_tercero" name="tipo_tercero" required>
							<option value="4">-- Selecciona Tipo Tercero --</option>
							<option value="2" selected>P - Proveedor</option>
							<option value="1" selected>E - EDS</option>
							<option value="0">A - Asociado</option>
						</select>
						<?php 
							if ($tipo_tercero=="E"){
								$tipo_tercero=1;
							} elseif ($tipo_tercero=="P") {
								$tipo_tercero=2;
							} elseif ($tipoper=="A") {
								$tipo_tercero=0;
							}
						?>
						<script>
							document.querySelector('#tipo_tercero').value=<?php echo $tipo_tercero; ?>;	
						</script>
				    </div>	
				</div>


				<div class="form-group row" >
				  <!--<label for="id" class="col-md-1 text-sm-left">ID Mov.</label>  --> 
				  <label for="nombre" class="col-md-1 ">Fecha Creac.</label>
				  <label for="nombre" class="col-md-1 ">Fecha Act.</label>
				  <label for="estado" class="col-md-2  ">Teléfono</label>
				  <label for="nombre_rl" class="col-md-3 ">Email</label>
				  <label for="estado" class="col-md-3 ">Dirección</label>
				  <label for="estado" class="col-md-2 ">C.C. RP</label>
                </div>
				<div class="form-group row">
				    <!--    
				    <div class="col-md-1">
					    <input type="text" class="form-control input-sm" id="id" placeholder="Id Mov." required>
					    <input id="id" type='hidden'>	
				    </div> --> 
				   
				    <div class="col-md-1">
						<input type="text" class="form-control input-sm" id="date_added" value="<?php  echo $date_added;?>" name="date_added" readonly>
				    </div>
					<div class="col-md-1">
						<input type="text" class="form-control input-sm" id="fecha_act" value="<?php echo date("d/m/Y");?>" name="fecha_act" readonly>
				    </div>
				    <div class="col-md-2">
						<input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" value="<?php echo $tel_cliente;?>">
				    </div> 
				    <div class="col-md-3">
						<input type="text" class="form-control" id="email_cliente" name="email_cliente"  value="<?php echo $email_cliente;?>">
				    </div>
					<div class="col-md-3">
						<input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente"  value="<?php echo $dir_Cliente;?>">
					</div>
					<div class="col-md-2">
						<input type="text" class="form-control" id="cedula_rp" name="cedula_rp" value="<?php echo $cc_rp;?>">
					</div>
				</div>


				
				<div class="form-group row">
					<!--<label for="id" class="col-md-1 text-sm-left">ID Mov.</label>  --> 
					<label for="nombre" class="col-md-3 ">Nombre RepLegal</label>
				  	<label for="nombre" class="col-md-2 ">Teléf. RepLegal</label>
				  	<label for="estado" class="col-md-3  ">Email RepLegal</label>
				  	<label for="nombre_rl" class="col-md-3 ">Dir. RepLegal</label>
				</div>
				<div class="form-group row">
				    <!--    
				    <div class="col-md-1">
					    <input type="text" class="form-control input-sm" id="id" placeholder="Id Mov." required>
					    <input id="id" type='hidden'>	
				    </div> --> 
				   
				    <div class="col-md-3">
						<input type="text" class="form-control input-sm" id="nombre_rp" name="nombre_rp" value="<?php echo $nombre_rp;?>">
				    </div>
					<div class="col-md-2">
						<input type="text" class="form-control input-sm" id="tel_rp" name="tel_rp" value="<?php echo $tel_rp;?>">
				    </div>
				    <div class="col-md-3">
						<input type="text" class="form-control" id="telefono_rp" name="email_rp" value="<?php echo $email_rp;?>">
				    </div> 
				    <div class="col-md-3">
						<input type="text" class="form-control" id="email_rp" name="direccion_rp" value="<?php echo $dir_rp;?>">
				    </div>
				</div>

				
				<div class="form-group row">
					<div class="col-md-12">
						<div class="pull-right">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#docCliente">
							<span class="glyphicon glyphicon-floppy-disk"></span> Añadir doc.
							</button>
							<button type="submit" class="btn btn-success" id="actualizar_datos">
								<span class="glyphicon glyphicon-floppy-disk"></span>Actualizar datos
							</button>
						</div>	
					</div>
				</div>
			</form>
			
			<div id="resultados_ajax2" class="col-md-12"></div>
			<div id="resultados_docs" class="col-md-12"></div>
			
		
	
	<?php
	include("footer.php");
	?>


	<script type="text/javascript" src="js/VentanaCentrada.js"></script>

	

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
	<script type="text/javascript" src="js/editar_clientes.js"></script>
  </body>
</html>