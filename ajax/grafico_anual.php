<?php 
$año=$_POST["año"];


require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

$mes=["01","02","03","04","05","06","07","08"];

$datos = "";

for ($i=0; $i <= 11; $i++) { 
    $gasolina=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$año."-".$mes[$i]."%' AND CODMAT = 'C04'");        
    $CO4= mysqli_fetch_array($gasolina);
    

    $B2=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$año."-".$mes[$i]."%' AND CODMAT = 'C02'");        
    $CO2= mysqli_fetch_array($B2);
    
    $datos .= $CO2[0]." ".$CO4[0]." ";
}

echo $datos;

?>