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
	$active_contratos="";
	$active_mapa = "active";	
	$title="Nueva Factura | SistCoom V1.0";
	
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
	
    <div class="container" style="height: 78%;">
        <div class="panel panel-info" style="height: 100%;">
            <div class="panel-heading">
                <h4><i class='glyphicon glyphicon-edit'></i> Mapa de las estaciones</h4>
            </div>
            <div class="panel-body" style="height: 87%;">
            <iframe src="https://www.google.com/maps/d/embed?mid=1hErK5mK62dF9PmfJxHK5FdWRV5xjNEc&ehbc=2E312F"style="height: 100%;  width: 100%;"></iframe>
            </div> 
        </div> 
    </div> 
        <?php
	include("footer.php");
	?>

  </body>
</html>