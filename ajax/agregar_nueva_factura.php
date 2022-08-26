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
mysqli_query($con,"SET NAMES 'utf8'");
$sql_count=mysqli_query($con,"select * from tmp ");
$count=mysqli_num_rows($sql_count);
if ($count==0){
	echo "<script>alert('No hay productos agregados a la factura')</script>";
	echo "<script>window.close();</script>";
	exit;
}

//recibe los datos mandados por ajax
//$fecha_mov=date('Y-m-d H:i:s');
$fechas_desembolsos=$_POST["fechas_desembolso"];
$total_fechas = explode(",", $fechas_desembolsos);
$cant_fechas = count($total_fechas);


$contraprestacion = $_POST["contraprestacion"];
$id_vendedor=$_POST["id_vendedor"];
$fecha_mov=$_POST["fecha_mov"];
$id_cliente=$_POST['id_cliente'];
if ($_POST["num_com"]==""){
	$num_comprobante="null";
} else {
	$num_comprobante=$_POST["num_com"];
}

if ($_POST["fecha_com"]==""){
	$fecha_com="null";
} else {
	$fecha_com="'".str_replace('/','-',$_POST["fecha_com"])."'";
}

if ($_POST["num_fact"]==""){
	$num_factura="null";
} else {
	$num_factura=$_POST["num_fact"];
}
if (str_replace('/','-',$_POST["fecha_fact"])==""){
	$fecha_factura="null";
} else {
	$fecha_factura="'".str_replace('/','-',$_POST["fecha_fact"])."'";
}
if ($_POST["id_proveedor"]==""){
	$id_proveedor="null";
} else {
	$id_proveedor=$_POST["id_proveedor"];
}
$tipo_mov = $_POST["tipo_mov"];
$condiciones=$_POST['condiciones'];
$total_venta=str_replace(',','',$_POST['total_venta']);
$estado=$_POST['estado'];


$date_added=date("Y-m-d");

//inserto los datos de la tabla facturas
$insert=mysqli_query($con,"INSERT INTO facturas (numero_factura,fecha_factura,id_cliente,id_vendedor,condiciones,total_venta,estado_factura,fecha_fact,nro_comprobante,fecha_comprobante,id_proveedor,tipo_mov,contraprestacion) VALUES ($num_factura,'$date_added','$id_cliente','$id_vendedor','$condiciones',$total_venta,$estado,$fecha_factura,$num_comprobante,$fecha_com,$id_proveedor,$tipo_mov,$contraprestacion)");
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
			$i=0;
			while ($row=mysqli_fetch_array($query)){
				$aux=$row['cantidad_tmp']*$row['precio_tmp'];
				if ($total_fechas[$i]==""){
					$total_fechas[$i]="null";
				} else {
					$total_fechas[$i]="'".$total_fechas[$i]."'";
				}
				$insert=mysqli_query($con, "INSERT INTO detalle_factura (id_factura,id_producto,cantidad,precio_venta,total,duracion)VALUES ('$id_factura','".$row['id_producto']."','".$row['cantidad_tmp']."','".$row['precio_tmp']."','$aux',".$total_fechas[$i].")");
				$i++;	
			}
		} else {
			echo "no hay productos";
		}

//tras realizar la importacion de tmp a detalle_factura toca vacia la tabla tmp

$sql=mysqli_query($con,"DELETE FROM tmp");

echo "<script>var opcion = alert ('Factura registrada correctamente')</script>";

?>