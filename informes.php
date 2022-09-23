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
	$a = $_SESSION['user_level'];
	if ($a < 0) {
        header("location: login.php");
		exit;
    }
	$active_facturas = "";
	$active_productos= "";
	$active_clientes = "";
    $active_informes = "active";
	$active_ventas = "";
	$active_usuarios = "";	
	$active_contratos = "";	
	$active_mapa = "";	
	
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$title           = "Movimientos | SistCoom V1.0";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
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
				<h4><i class='glyphicon glyphicon-search'></i> Informe General</h4>
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
		<div class="form-group row">
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4><i class='glyphicon glyphicon-stats'></i> Informe de Entrega vs Excedente</h4>
					</div>
					<div class="panel-body" >
						
							<div class="form-group row">
								<label for="q" class="col-md-2 control-label">Municipio</label>
								<div class="col-md-4">
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
								<div class="col-md-6">
									<button href="" class="btn btn-info" onclick="informe_entrega1()"><!--<span class="glyphicon glyphicon-plus" ></span>-->Generar Informe T1</button>
									<button  href="" class="btn btn-info" onclick="informe_entrega2()"><!--<span class="glyphicon glyphicon-plus" ></span>-->Generar Informe T2</button>
								</div>
							</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4><i class='glyphicon glyphicon-stats'></i> Informe de Utilidad</h4>
					</div>
					<div class="panel-body" >
						<form class="form-horizontal" role="form" id="informe_datos">
							<div class="form-group row">
								<label for="q" class="col-md-1 control-label">Mes: </label>
								<div class="col-md-3">
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
        								<option value="12">DICIEMBRE</option>
        								<option value="13">TODOS LOS MESES</option>
        							</select>
								</div>
								<label for="q" class="col-md-1 control-label">Año: </label>
								<div class="col-md-3">
									<select class="form-control" name="mes" id="mes">
								        <option value="01">2018</option>
								        <option value="02">2019</option>
        								<option value="03">2020</option>
        								<option value="04">2021</option>
        								<option value="05">2022</option>
        							</select>
								</div>
								<div class="col-md-4">
									<a  href="" class="btn btn-info" onclick="informe_utilidad()"><!--<span class="glyphicon glyphicon-plus" ></span>-->Generar Informe</a>
								</div>
							</div>			
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-info">
					<div class="panel-heading">
						<h4><i class='glyphicon glyphicon-stats'></i> Informe General de Consumo</h4>
					</div>
					<div class="panel-body" >
						
							<div class="form-group row">
								<label for="q" class="col-md-1 control-label">Municipio: </label>
								<div class="col-md-2">
									<select class="form-control" name="mun_consumo" id="mun_consumo">
										<script>
											var select = document.getElementById('mun_consumo');
											select.addEventListener('change',
											function(){
												var selectedOption = this.options[select.selectedIndex];
												var a =(selectedOption.value);
												console.log(a);
												document.querySelector('#mun_consumo').value=a;
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
								<label for="q" class="col-md-1 control-label">Año: </label>
								<div class="col-md-2">
									<select class="form-control" name="year_consumo" id="year_consumo">
								        <option value="2018">2018</option>
								        <option value="2019">2019</option>
        								<option value="202">2020</option>
        								<option value="2021">2021</option>
        								<option value="2022">2022</option>
        							</select>
								</div>
								<div class="col-md-4">

									<button class="btn btn-info" onclick="informe_consumo_general()"><!--<span class="glyphicon glyphicon-plus" ></span>-->Generar Informe</button>
								</div>
							</div>			
						
					</div>
		</div>

				<div class="panel panel-info">
					<div class="panel-heading">
						<h4><i class='glyphicon glyphicon-stats'></i> CUPO VS CONSUMO E.D.S</h4>
					</div>
					<div class="panel-body" >
						<form class="form-horizontal" role="form" >
							<div class="form-group row">
								<label for="q" class="col-md-1 control-label">Municipio</label>
								<div class="col-md-3">
									<select class="form-control input-sm" id="municipio_ventas_grafico" name="municipio_ventas_grafico">
										<script>
											var select = document.getElementById('municipio_ventas_grafico');
											select.addEventListener('change',
											function(){
												var selectedOption = this.options[select.selectedIndex];
												var a =(selectedOption.value);
												console.log(a);
												document.querySelector('#municipio_ventas_grafico').value=a;
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
									<?php $cont = date('Y'); ?>
									<select class="form-control" id="año_ventas_grafico" name="año_ventas_grafico">
										<?php while ($cont >= 2009) { ?>
											<option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
										<?php $cont = ($cont-1); } ?>
									</select>							
								</div>
								
								<button type="button" class="btn btn-info" onclick="generar_venta_municipio()">Generar Grafico</button>
								<button type="button" class="btn btn-info" id="impresion_venta_municipio" disabled="true" onclick="imprimir_venta_municipio()">Imprimir</button>
							</div>
							<br><br>
							<input type="hidden" value="" id="grafico">
							<input type="hidden" value="" id="grafico2">
							<input type="hidden" value="" id="grafico3">
							<input type="hidden" value="" id="grafico4">
							<input type="hidden" value="" id="grafico5">
							<input type="hidden" value="" id="grafico6">
							<input type="hidden" value="" id="grafico7">
							<input type="hidden" value="" id="grafico8">
							<input type="hidden" value="" id="grafico9">
							<input type="hidden" value="" id="grafico10">
							<input type="hidden" value="" id="grafico11">
							<input type="hidden" value="" id="grafico12">
							
							
							
							<div class="form-group row" id="cap_grafico" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico2" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico3" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico4" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico5" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico6" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico7" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico8" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico9" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico10" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico11" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
							<div class="form-group row" id="cap_grafico12" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
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
			

		<div class="panel panel-info">
			<div class="panel-heading">
				<h4><i class='glyphicon glyphicon-stats'></i> Analisis Ventas</h4>
			</div>
			<div class="panel-body" >
				<form class="form-horizontal" role="form" >
					<div class="form-group row">
						<label for="q" class="col-md-1 control-label">Total Ventas</label>
						<div class="col-md-3">
							<select class="form-control" name="mes_ventas" id="mes_ventas">
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
							<select class="form-control" id="año_ventas" name="año_ventas">
								<?php while ($cont >= 2009) { ?>
									<option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
								<?php $cont = ($cont-1); } ?>
							</select>							
						</div>
						
						<button type="button" class="btn btn-info" onclick="generar()">Generar Grafico</button>
						<button type="button" class="btn btn-info" id="impresion_" disabled="true" onclick="imprimir()">Imprimir</button>
					</div>
					<br><br>
					<input type="hidden" value="" id="grafico_">
					<input type="hidden" value="" id="grafico2_">
					<input type="hidden" value="" id="grafico3_">
					<input type="hidden" value="" id="grafico4_">
					
					
					
					<div class="form-group row" id="cap_grafico_" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
					<div class="form-group row" id="cap_grafico2_" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
					<div class="form-group row" id="cap_grafico3_" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
					<div class="form-group row" id="cap_grafico4_" style="width: 1350px; padding: 0px 0px 0px 150px;"></div>
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