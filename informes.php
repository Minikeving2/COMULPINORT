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
	$active_mapa = "";	
	
	$title           = "Movimientos | SistCoom V1.0";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	
	<link rel="stylesheet" href="css/tabla.css">
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
    <div class="container" id="container">
		<div class="panel panel-info">
			<div class="panel-heading">
		    	<div class="btn-group pull-right">
					<a  href="" class="btn btn-info" onclick="imprimir_informe()"><!--<span class="glyphicon glyphicon-plus" ></span>-->Generar Informe</a>
				</div>
				<h4><i class='glyphicon glyphicon-search'></i> Buscar Informes</h4>
			</div>
			<div class="panel-body" >
				<form class="form-horizontal" role="form" id="informe_datos">
					<div class="form-group row">
						<label for="q" class="col-md-1 control-label">EDS./Tercero</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="q" placeholder="Nombre de la EDS o nombre del cliente">
						</div>
						<div class="col-md-1">
							
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
			</div>
		</div>

		<div class="panel panel-info" >
			<div class="panel-heading">
				<h4><i class='glyphicon glyphicon-stats'></i> Analisis Ventas</h4>
			</div>
			<div class="panel-body" >
				<form class="form-horizontal" role="form" >
					<div class="form-group row">
						<label for="q" class="col-md-1 control-label">Total Ventas</label>
						<div class="col-md-2">
							<select class="form-control" name="mes" id="mes">
								<option value="01">ENERO</option>
								<option value="02">FEBRERO</option>
								<option value="03">MARZO</option>
								<option value="04">ABRIL</option>
								<option value="05">MAYO</option>
								<option value="06">JUNIO</option>
								<option value="07">JULIO</option>
								<option value="08">AGOSTO</option>
								<option value="09">SEPTIEMBRE</option>
								<option value="10">OCTUBRE</option>
								<option value="11">NOVIEMBRE</option>
								<option value="12">DICIEMBRE</option>}
								<option value="13">TODOS LOS MESES</option>
							</select>
						</div>
						<div class="col-md-1">
							<?php $cont = date('Y'); ?>
							<select class="form-control" id="año" name="año">
								<?php while ($cont >= 2009) { ?>
									<option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
								<?php $cont = ($cont-1); } ?>
							</select>							
						</div>
						
						<button type="button" class="btn btn-info" onclick="generar()">Generar Grafico</button>
						<button type="button" class="btn btn-info" id="impresion" disabled="true" onclick="imprimir()">Imprimir</button>
					</div>
					<br><br>
					<input type="hidden" value="" id="grafico">
					<input type="hidden" value="" id="grafico2">
					<input type="hidden" value="" id="grafico3">
					<input type="hidden" value="" id="grafico4">
					
					
					
					<div class="form-group row" id="cap_grafico" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
					<div class="form-group row" id="cap_grafico2" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
					<div class="form-group row" id="cap_grafico3" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
					<div class="form-group row" id="cap_grafico4" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
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
			</div>
		</div>
	
	</div>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/informes.js"></script>
  </body>
</html>