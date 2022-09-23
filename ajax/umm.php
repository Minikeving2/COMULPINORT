<?php 
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

session_start();
$proceso = "INSERTAR";
$descripcion = "ESTACION";
$id_usuario = $_SESSION['user_id'];
$nombre = $_SESSION['user_name'];
include ("nueva_auditoria.php");
?>