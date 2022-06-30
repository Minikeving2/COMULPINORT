<?php
	/*-------------------------
	Autor: INNOVAWEBSV
	Web: www.innovawebsv.com
	Mail: info@innovawebsv.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_facturas = "";
	$active_productos= "";
	$active_clientes = "";
    $active_informes = "active";
	$active_usuarios = "";	
	$active_contratos = "";	
	
	$title           = "Movimientos | SistCoom V1.0";
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
				<a  href="" class="btn btn-info" onclick="imprimir_informe()"><!--<span class="glyphicon glyphicon-plus" ></span>-->Generar Informe</a>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Informes</h4>
		</div>
			<div class="panel-body" id="panel_body">
				<form class="form-horizontal" role="form" id="informe_datos">
				
						<div class="form-group row">
							<label for="q" class="col-md-1 control-label">EDS./Tercero</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="q" placeholder="Nombre de la EDS o nombre del cliente">
							</div>

							<div class="col-md-1">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<!--<span id="loader"></span>-->
							</div>
                            <label class="col-md-1 control-label">Desde:</label>
                            <div class="col-md-1" id="fecha_inf">
                                <input type="date" class="form-control input" id="fecha_inicio" max="<?php echo str_replace('/','-',date("Y/m/d"));?>" value="<?php echo str_replace('/','-',date("Y/m/d"));?>">
                            </div>
                            <label class="col-md-1 control-label">Hasta:</label>
                            <div class="col-md-1" id="fecha_inf">
                                <input type="date" class="form-control input" id="fecha_fin" max="<?php echo str_replace('/','-',date("Y/m/d"));?>" value="<?php echo str_replace('/','-',date("Y/m/d"));?>">
                            </div>
							<div class="col-md-1" id="facturas" style="display: flex;">
								<label class="radio-inline"><input type="radio" value="1" name="tipo_informe">Factura</label>
                            </div>
							<div class="col-md-1" id="contratos" style="display: flex;">
								<label class="radio-inline"><input type="radio" value="2" name="tipo_informe">Contrato</label>
                            </div>
						</div>
						<script> 
							document.addEventListener('DOMContentLoaded', () => {
								document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
									if(e.keyCode == 13) {
										e.preventDefault();
										e.load(1);
									}
								}))
							});
  						</script>				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div' id="contenido"></div><!-- Carga los datos ajax -->
			</div>
		</div>	
		
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/informes.js"></script>
  </body>
</html>