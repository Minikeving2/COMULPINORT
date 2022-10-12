<?php
	/*-------------------------
	Autor: 
	Web: 
	Mail: 
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_facturas = "";
	$active_productos= "";
	$active_clientes = "";
	$active_usuarios = "";
	$active_mapa = "";		
	$active_contratos = "active";
	$active_informes = "";
	$active_ventas = "";	
	
	$title           = "Contratos | SistCoom V1.0";
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
    <div class="container" id="container">
		<div class="panel panel-info" id="borde">
			<div class="panel-heading">
				<div class="btn-group pull-right">
					<a  href="nuevo_contrato.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nuevo Contrato</a>
				</div>
				<h4><i class='glyphicon glyphicon-search'></i> Buscar Contratos</h4>
			</div>
			<div class="panel-body" id="panel_body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
					<div class="form-group row">
						<label for="q" class="col-md-2 control-label">Tercero / Nro. Contrato.</label>
						<div class="col-md-5">
							<input type="text" class="form-control" id="q" placeholder="Nombre del cliente o Nro. Contrato" onkeyup='load(1);'>
						</div>
						<div class="col-md-3">
							<button type="button" class="btn btn-default" onclick='load(1);'>
								<span class="glyphicon glyphicon-search" ></span> Buscar</button>
							<span id="loader"></span>
						</div>		
					</div>
				</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div' id="contenido"></div><!-- Carga los datos ajax -->
			</div>
		</div>	
	</div>
	<hr>
	<?php include("footer.php"); ?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/contratos.js"></script>
  </body>
</html>