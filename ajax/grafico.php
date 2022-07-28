<?php 
$año=$_POST["año"];
$mes=$_POST["mes"];


require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos


$gasolina=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$año."-".$mes."%' AND CODMAT = 'C04'");        
$CO4= mysqli_fetch_array($gasolina);

$B2=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$año."-".$mes."%' AND CODMAT = 'C02'");        
$CO2= mysqli_fetch_array($B2);

echo $CO2[0]." ".$CO4[0];

?>