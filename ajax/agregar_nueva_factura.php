<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();


//recibe los datos mandados por ajax
$num_fact=$_POST['num_factura'];
$fecha_fact=date('Y-m-d H:i:s');
$id_cliente=$_POST['id_cliente'];
$id_vendedor=$_POST['id_vendedor'];
$condiciones=$_POST['condiciones'];
$total_venta=str_replace(',','',$_POST['total_venta']);
$estado=$_POST['estado'];
$fecha_mov=date('Y-m-d H:i:s');
$num_comprobante=$_POST['num_comp'];
$fecha_com=date('Y-m-d H:i:s');

$tipo_mov=$_POST['tipo_mov'];

if ($_POST['id_proveedor']==''){
	$id_proveedor=null;
} else {
	$id_proveedor=$_POST['id_proveedor'];
}

	/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

//inserto los datos de la tabla facturas
$insert=mysqli_query($con,"INSERT INTO facturas (numero_factura,id_cliente,id_vendedor,condiciones,total_venta,estado_factura,fecha_mov,nro_comprobante,fecha_comprobante,id_proveedor,tipo_mov) VALUES ('$num_fact','$id_cliente','$id_vendedor','$condiciones','$total_venta','$estado','$fecha_mov','$num_comprobante','$fecha_com',$id_proveedor,'$tipo_mov')");

//busco el id de la factura creada

$sql="SELECT MAX(id_factura) FROM facturas";
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
				$insert=mysqli_query($con, "INSERT INTO detalle_factura (id_factura,id_producto,cantidad,precio_venta)VALUES ('$id_factura','".$row['id_producto']."','".$row['cantidad_tmp']."','".$row['precio_tmp']."')");
			}
		} else {
			echo "no hay productos";
		}

//tras realizar la importacion de tmp a detalle_factura toca vacia la tabla tmp

$sql=mysqli_query($con,"DELETE FROM tmp")
?>