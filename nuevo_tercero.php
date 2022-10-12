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
			include("modal/sarlaft.php");
		?>
			<form class="form-horizontal" method="POST" id="nuevo_cliente" name="guardar_cliente">
				
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
					    <input type="text" class="form-control input-sm" id="nit" name="nit">	
				    </div>  
				    
				    <div class="col-md-4">
					    <input type="text" class="form-control input-sm" id="nombre_tercero" name="nombre_tercero">	
				    </div>

				    <div class="col-md-1">
						<input type="text" class="form-control input-sm" id="sicom" name="sicom">
					</div>

				    <div class="col-md-1">
						<select class="form-control" id="estado" name="estado" required>
							<option value="">-- Selecciona Estado --</option>
							<option value="1" selected>Activo</option>
							<option value="0">Inactivo</option>
							<option value="2">Retirado</option>
							<option value="3">En Proceso</option>
						</select> 
					</div>	

					<div class="col-md-2">
						<select class="form-control input-sm" id="mun" name="mun">
							<script>
								var select = document.getElementById('mun');
								select.addEventListener('change',
								function(){
									var selectedOption = this.options[select.selectedIndex];
									var a =(selectedOption.value);
									console.log(a);
									document.querySelector('#mun').value=a;
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
						</select>
					</div> 

					<div class="col-md-1">
						<input type="text" class="form-control input-sm" id="cupo" name="cupo">
					</div>	
					
					<div class="col-md-2">
						<select class="form-control" id="tipo_tercero" name="tipo_tercero" required>
							<option value="4">-- Selecciona Tipo Tercero --</option>
							<option value="2" selected>P - Proveedor</option>
							<option value="1" selected>E - EDS</option>
							<option value="0">A - Asociado</option>
						</select>
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
						<input type="text" class="form-control input-sm" id="date_added" value="<?php echo date("d/m/Y");?>" name="date_added" readonly>
				    </div>
					<div class="col-md-1">
						<input type="text" class="form-control input-sm" id="fecha_act" value="<?php echo date("d/m/Y");?>" name="fecha_act" readonly>
				    </div>
				    <div class="col-md-2">
						<input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" >
				    </div> 
				    <div class="col-md-3">
						<input type="text" class="form-control" id="email_cliente" name="email_cliente" >
				    </div>
					<div class="col-md-3">
						<input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" >
					</div>
					<div class="col-md-2">
						<input type="text" class="form-control" id="cedula_rp" name="cedula_rp" >
					</div>
				</div>


				
				<div class="form-group row">
					<!--<label for="id" class="col-md-1 text-sm-left">ID Mov.</label>  --> 
					<label for="nombre" class="col-md-3 ">Nombre RepLegal</label>
				  	<label for="nombre" class="col-md-2 ">Teléf. RepLegal</label>
				  	<label for="estado" class="col-md-3  ">Email RepLegal</label>
				  	<label for="nombre_rl" class="col-md-3 ">Dir. RepLegal</label>
					<label for="sarlaft" class="col-md-1 ">Sarlaft</label>
				</div>
				<div class="form-group row">
				    <!--    
				    <div class="col-md-1">
					    <input type="text" class="form-control input-sm" id="id" placeholder="Id Mov." required>
					    <input id="id" type='hidden'>	
				    </div> --> 
				   
				    <div class="col-md-3">
						<input type="text" class="form-control input-sm" id="nombre_rp" name="nombre_rp">
				    </div>
					<div class="col-md-2">
						<input type="text" class="form-control input-sm" id="tel_rp" name="tel_rp">
				    </div>
				    <div class="col-md-3">
						<input type="text" class="form-control" id="telefono_cliente" name="email_rp" >
				    </div> 
				    <div class="col-md-3">
						<input type="text" class="form-control" id="email_cliente" name="direccion_rp" >
				    </div>
					<div class="col-md-1">
						<input type="text" class="form-control" id="sarlaft" name="sarlaft" >
				    </div>
				</div>

				
				<div class="form-group row">
					<div class="col-md-12">
						<div class="pull-right">
						    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#SARLAFT">
								<span class="glyphicon glyphicon-list-alt"></span> SARLAFT
							</button>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#docCliente">
							    <span class="glyphicon glyphicon-floppy-disk"></span> Añadir doc.
							</button>
							<button type="submit" class="btn btn-success" id="guardar_datos">
								<span class="glyphicon glyphicon-floppy-disk"></span>Guardar datos
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
	
	<script type="text/javascript" src="js/nuevo_clientes.js"></script>
  </body>
</html>