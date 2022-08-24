<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos


$id_cliente=$_GET['id_cliente'];


if (isset($_POST['nombre_doc'])){$nombre=$_POST['nombre_doc'];}
if (isset($_FILES['archivo'])){$archivo = $_FILES['archivo'];}
if (isset($_POST['nombre_doc'])){$tipo_doc=$_POST['tipo_doc'];}
if (isset($_POST['fecha_inicio_doc'])){$fecha_inicio =  $_POST['fecha_inicio_doc'];}
if (isset($_POST['fecha_final_doc'])){$fecha_final =  $_POST['fecha_final_doc'];}

	/* Connect To Database*/

mysqli_query($con,"SET NAMES 'utf8'");	

if (!empty($nombre) and !empty($archivo['name']) and !empty($tipo_doc)){

	$name = "(".$nombre.")".$archivo['name'];
	$ruta = $_FILES['archivo']['tmp_name'];
	$destino = "../tercero_documentacion/" . $name;
	$fecha_added=date('Y-m-d');

	if (copy($ruta, $destino)) {
		$sql_doc_nuevo="INSERT INTO detalle_cliente (cod_cliente,nombre,ruta,archivo,tipo_doc,fecha_documento,fecha_vencimiento,fecha_added) VALUES ('$id_cliente','$nombre','$destino','$name','$tipo_doc','$fecha_inicio','$fecha_final','$fecha_added')";
		$insert_tmp=mysqli_query($con,$sql_doc_nuevo);
	} else {
		$resultado.='<script>alert("El tipo de archivo no es valido") </script>';
		echo $resultado;
		exit;
	}
}
if (isset($_POST['id_del'])){//codigo elimina un elemento del array
	$id_detalle=intval($_POST['id_del']);
	$sql =  "SELECT ruta FROM detalle_cliente WHERE id='$id_detalle'";
	$datos = mysqli_fetch_array(mysqli_query($con,$sql));
	//el unlink me elimina el fichero segun la ubicacion y su nombre
	unlink($datos[0]);
	$delete=mysqli_query($con, "DELETE FROM detalle_cliente WHERE id='".$id_detalle."'");
}
/*
if (isset($_POST["fechas_desembolso"])){
	$fechas_desembolsos=$_POST["fechas_desembolso"];
	$total_fechas = explode(",", $fechas_desembolsos);
	$cant_fechas = count($total_fechas);

	$sql=mysqli_query($con, "select * from detalle_cliente where cod_cliente='$id_factura'");
	$i=0;
	while ($row=mysqli_fetch_array($sql)){
		if ($total_fechas[$i]==""){
			$total_fechas[$i]="null";
		} else {
			$total_fechas[$i]="'".$total_fechas[$i]."'";
		}
		mysqli_query($con, "UPDATE detalle_factura SET duracion=".$total_fechas[$i]." WHERE id_detalle='".$row["id_detalle"]."';");
		$i++;	
	}

}*/

$resultado.='<table class="table">
<tr>
	<th class="text-center">Fecha crea.</th>
	<th class="text-center">Nombre</th>
	<th class="text-center">Tipo doc</th>
	<th class="text-center">Fecha documento</th>
	<th class="text-center">Fecha vencimineto</th>
	<th class="text-center">Ruta</th>
	<th></th>
</tr>';

$sql=mysqli_query($con, "select * from detalle_cliente where cod_cliente='".$id_cliente."'");

while ($row=mysqli_fetch_array($sql)){
	$id_detalle=$row["id"];
	$ruta=$row['ruta'];
	$nombre=$row["nombre"];
	$archivo=$row['archivo'];
	$tipo_doc=$row["tipo_doc"];
	$fecha_inicio=$row["fecha_documento"];
	$fecha_final=$row['fecha_vencimiento'];
	$fecha_added=$row['fecha_added'];
	switch ($tipo_doc) {
		case 1:
			$tipo_doc = "informacion legal 1";
			break;
		case 2:
			$tipo_doc = "informacion legal 2";
			break;
		case 3:
			$tipo_doc = "informacion legal 3";
			break;
		case 3:
			$tipo_doc = "informacion legal 4";
			break;
		case 3:
			$tipo_doc = "informacion legal 5";
			break;
		}

	$resultado.='
		<tr>
			<td class="text-center">'.$fecha_added.'</td>
			<td class="text-center">'.$nombre.'</td>
			<td class="text-center">'.$tipo_doc.'</td>
			<td class="text-center">'.$fecha_inicio.'</td>
			<td class="text-center">'.$fecha_final.'</td>
			<td class="text-center">'.$ruta.'</td>
			<td class="text-center"><a href="#" onclick="eliminar('.$id_detalle.')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>';	
}
$resultado.='</table>';
echo $resultado;
?>