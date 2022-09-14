<?php 
$year=$_POST["year"];
$mun=$_POST["mun"];

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
mysqli_query($con,"SET NAMES 'utf8'");
$numero = mysqli_fetch_array(mysqli_query($con,"SELECT count(*) AS numrows FROM clientes WHERE id_municipio = $mun"));
$cantidad_estaciones = $numero['numrows'];
$datos_totales="";
for ($i=1; $i < 13; $i++) {
    $sql_estaciones = mysqli_query($con, "SELECT nombre_cliente, id_cliente FROM clientes WHERE id_municipio = $mun AND tipo_tercero = 'E' ORDER BY nombre_cliente");
    
    while ($row=mysqli_fetch_array($sql_estaciones)){
        $mostrar = "";
        $id_cliente = $row["id_cliente"];
        $nombre = $row["nombre_cliente"];
        

        $sql_datos = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM cupo WHERE ID_TERCERO = '$id_cliente' AND MES = '$i' AND YEAR = '$year'"));
        if($sql_datos){
            $datos = "'".$nombre."',".$sql_datos[5].",".$sql_datos[6].",".$sql_datos[7];
            $mostrar = ",".$datos;
        } else {
            $mostrar = ",'".$nombre."',0,0,0";
        }
        
        $datos_totales .= $mostrar;
       
    }
}
echo $cantidad_estaciones."".$datos_totales;
?>