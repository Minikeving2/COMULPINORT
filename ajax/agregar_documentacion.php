<?php
/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();
if (isset($_POST['nombre_doc'])){$nombre=$_POST['nombre_doc'];}

if (isset($_FILES['archivo'])){$archivo = $_FILES['archivo'];}

if (isset($_POST['nombre_doc'])){$tipo_doc=$_POST['tipo_doc'];}

if (isset($_POST['fecha_inicio_doc'])){$fecha_inicio =  $_POST['fecha_inicio_doc'];}
if (isset($_POST['fecha_final_doc'])){$fecha_final =  $_POST['fecha_final_doc'];}


	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
mysqli_query($con,"SET NAMES 'utf8'");

$resultado="";
if (!empty($nombre) and !empty($archivo['name']) and !empty($tipo_doc)){

	$name = "(".$nombre.")".$archivo['name'];
	$ruta = $_FILES['archivo']['tmp_name'];
	$destino = "../tercero_documentacion/" . $name;
	$fecha_added=date('Y-m-d');
	if (copy($ruta, $destino)) {
		$insert_tmp=mysqli_query($con, "INSERT INTO tmp_files (nombre,ruta,archivo,tipo_doc,fecha_inicio,fecha_final,fecha_added) VALUES ('$nombre','$destino','$name','$tipo_doc','$fecha_inicio','$fecha_final','$fecha_added')");
	} else {
		$resultado.='<script>alert("El tipo de archivo no es valido") </script>';
		echo json_encode($resultado);
		exit;
	}
}


//codigo elimina un elemento del array
if (isset($_POST['id'])){
	$id_tmp=intval($_POST['id']);
	$sql =  "SELECT ruta FROM tmp_files WHERE id='$id_tmp'";
	$datos = mysqli_fetch_array(mysqli_query($con,$sql));
	//el unlink me elimina el fichero segun la ubicacion y su nombre
	unlink($datos[0]);

	$delete=mysqli_query($con, "DELETE FROM tmp_files WHERE id='".$id_tmp."'");
	
	
}

$resultado.='
<table class="table">

<tr>
	<th class="text-center">Fecha crea.</th>
	<th class="text-center">Nombre</th>
	<th class="text-center">Tipo doc</th>
	<th class="text-center">Fecha documento</th>
	<th class="text-center">Fecha vencimineto</th>
	<th class="text-center">Ruta</th>
	<th></th>
</tr>';
	$sumador_total=0;
	$sql=mysqli_query($con, "select * from tmp_files");
	while ($row=mysqli_fetch_array($sql)){
		$id_tmp=$row["id"];
		$nombre=$row["nombre"];
		$ruta=$row["ruta"];
		$archivo=$row['archivo'];
		$tipo_doc=$row["tipo_doc"];
		$fecha_inicio=$row["fecha_inicio"];
		$fecha_final=$row['fecha_final'];
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
			case 4:
				$tipo_doc = "informacion legal 4";
				break;
			case 5:
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
			<td class="text-center"><a href="#" onclick="eliminar('.$id_tmp.')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>';	
		
	}
	$resultado.='</table>';
	echo json_encode($resultado);
?>