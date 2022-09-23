<?php 
if (!empty($_SERVER["HTTP_CLIENT_IP"])){
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif (!empty($_SERVER["HTTP_X_FORMARDED_FOR"])){
    $ip = $_SERVER["HTTP_X_FORMARDED_FOR"];
} else {
    $ip = $_SERVER["REMOTE_ADDR"];
}
date_default_timezone_set('America/Bogota');  
$fechaActual = date('m-d-Y h:i:s a', time());
$SQL_AUDITORIA = "INSERT INTO auditoria (fecha, tipo, descripcion, id_usuario, nombre_usuario, ip_usuario) VALUES ('$fechaActual','$proceso','$descripcion','$id_usuario','$nombre','$ip');";
mysqli_query($con,$SQL_AUDITORIA);
?>