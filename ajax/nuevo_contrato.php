<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();

/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

$sql_count=mysqli_query($con,"select * from tmp");
$count=mysqli_num_rows($sql_count);
if ($count==0){
	echo "<script>alert('No hay productos agregados a la factura')</script>";
	echo "<script>window.close();</script>";
	exit;
}

//recibe los datos mandados por ajax
//$fecha_mov=date('Y-m-d H:i:s');



$id_cliente=$_POST["id_cliente"];
$fecha_fin=$_POST["fecha_fin"];
$fecha_inicio=$_POST["fecha_inicio"];

$tipo_per=$_POST["tipo_per"];
$clau_penal=$_POST["clau_penal"];
$clau_legal=$_POST["clau_legal"];

$otrosi = $_POST["otrosi"];
$duracion = $_POST["duracion"];
$observacion = $_POST["observacion"];
$calculado = $_POST["calculado"];

$id_usuario = $_POST["per_realiza"];



if ($_POST["otrosi"]==""){
	$otrosi="null";
} else {
	$otrosi=$_POST["otrosi"];
}

$fecha_creacion=date("Y-m-d");

//inserto los datos de la tabla facturas,
$sql=mysqli_query($con, "INSERT INTO contrato (fecha_inicio, fecha_final, fecha_crea, tipo_per, id_cliente, duracion, numcontrato, numpoliza, clausulagal, clausulapenal, descripcion, valor, id_contrato_rel, id_usuario) VALUES ('$fecha_inicio', '$fecha_fin', '$fecha_creacion', '$tipo_per', '$id_cliente', '$duracion', '$num_contraro', '$num_poliza', '$clau_legal', '$clau_penal','$observacion','$calculado',$otrosi,'".$_SESSION['user_id']."')");
	
$sql="SELECT MAX(id_contrato) FROM contrato";
$result=mysqli_fetch_array(mysqli_query($con, $sql));
if (isset($result[0])){
	$id_factura=$result[0];
} else {
	$id_factura = 1;
}

//inserto los datos de la tabla tmp en la tabla factura con el id del registro para asi qeudar vinculadas
$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM tmp");
$row= mysqli_fetch_array($count_query);
$numrows = $row['numrows'];
$sql="SELECT * FROM tmp";
		
		$query = mysqli_query($con, $sql);
		if ($numrows>0){
			while ($row=mysqli_fetch_array($query)){
				$aux=$row['cantidad_tmp']*$row['precio_tmp'];
				$insert=mysqli_query($con, "INSERT INTO detalle_contrato (id_contrato,id_producto,cantidad,precio_venta,total)VALUES ('$id_factura','".$row['id_producto']."','".$row['cantidad_tmp']."','".$row['precio_tmp']."','$aux')");
			}
		} else {
			echo "no hay productos";
		}

//tras realizar la importacion de tmp a detalle_factura toca vacia la tabla tmp

$sql=mysqli_query($con,"DELETE FROM tmp");

echo "<script>var opcion = alert ('Factura registrada correctamente')</script>";

?>