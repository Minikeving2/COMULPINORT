<?php 
$year=$_POST["YEAR"];


require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

$mes=["01","02","03","04","05","06","07","08","09","10","11","12"];

$datos = "";

for ($i=0; $i <= 11; $i++) { 
    $B2=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$year."-".$mes[$i]."%' AND CODMAT = 'C02'");        
    $C02= mysqli_fetch_array($B2);

    $B5=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$year."-".$mes[$i]."%' AND CODMAT = 'B5'");        
    $B5= mysqli_fetch_array($B5);

    $C04=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$year."-".$mes[$i]."%' AND CODMAT = 'C04'");        
    $C04= mysqli_fetch_array($C04);

    $C07=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$year."-".$mes[$i]."%' AND CODMAT = 'C07'");        
    $C07= mysqli_fetch_array($C07);

    $C09=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$year."-".$mes[$i]."%' AND CODMAT = 'C09'");        
    $C09= mysqli_fetch_array($C09);

    $EX=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$year."-".$mes[$i]."%' AND CODMAT = 'EX'");        
    $EX= mysqli_fetch_array($EX);

    $EX4=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$year."-".$mes[$i]."%' AND CODMAT = 'EX4'");        
    $EX4= mysqli_fetch_array($EX4);

    $EX2=mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE FECHA LIKE '%".$year."-".$mes[$i]."%' AND CODMAT = 'EX2'");        
    $EX2= mysqli_fetch_array($EX2); 
    
    if($C02[0]==""){
        $C02[0]="0";
    }
    if($C04[0]==""){
        $C04[0]="0";
    }
    if($EX[0]==""){
        $EX[0]="0";
    }
    if($B5[0]==""){
        $B5[0]="0";
    }
    if($C07[0]==""){
        $C07[0]="0";
    }
    if($EX4[0]==""){
        $EX4[0]="0";
    }
    if($C09[0]==""){
        $C09[0]="0";
    }
    if($EX2[0]==""){
        $EX2[0]="0";
    }

    $A=$C02[0];
    $B=$C04[0];
    $C=$EX[0];
    $D=$B5[0];
    $E=$C07[0];
    $F=$EX4[0];
    $G=$C09[0];
    $H=$EX2[0];

    $datos .= $A." ".$D." ".$B." ".$E." ".$G." ".$C." ".$F." ".$H." ";
}
$datos = substr($datos, 0, -1);
echo $datos;

?>