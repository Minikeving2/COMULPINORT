<?php
	/*-------------------------
	Autor: 
	Web  : 
	Mail : 
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_facturas="";
	$active_productos="";
	$active_clientes="active";
	$active_usuarios="";
	$active_contratos="";	
	$title="Clientes | SistCoom V1.0";
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
		   <h4> <i class='glyphicon glyphicon-tint'></i> Datos de Terceros (Estaciones) </h4> 

			<!--<h4><i class='glyphicon glyphicon-search'></i> Buscar Tercero</h4>-->
		</div>
		<div class="panel-body" id="panel_body">
		
			<!-- incluye los modales usados -->
			<?php
				include("modal/registro_clientes.php");
				include("modal/editar_clientes.php");
			?>
			 <form class="form-horizontal" role="form" id="datos_cotizacion">
				<div class="form-group row" id="margin_btn_nuevo_tercero">
				  <label for="q" class="col-md-2 control-label">Filtro:</label>
					<div class="col-md-5">
						<input type="text" class="form-control" id="q" placeholder="Nombre del cliente" >
					</div>
					<div class="col-md-3">
						<button type="button" class="btn btn-default" onclick='load(1);'>
							<span class="glyphicon glyphicon-search" ></span> Buscar</button>
							<span id="loader"></span>
					</div>    
			      <div class="btn-group pull-right">
				  <button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> Nuevo Tercero</button>
			      </div>
				</div>
				<!--script  para evitar la funcion de enter en el formulario de busqueda-->
				<script> 
					document.addEventListener('DOMContentLoaded', () => {
						document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
							if(e.keyCode == 13) {
								e.preventDefault();
								
							}
						}))
					});
  				</script>			
			</form>
			<div id="resultados"></div><!-- Carga los datos ajax -->
			<div class='outer_div' id="contenido"></div><!-- Carga los datos ajax -->			
        </div>  <!-- body -->
    </div> 
	</div>
	<hr>
	  <?php
	    include("footer.php");
	  ?>
	  <script type="text/javascript" src="js/clientes.js"></script>
  </body>
</html>
