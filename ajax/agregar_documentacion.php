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

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
mysqli_query($con,"SET NAMES 'utf8'");

$resultado="";
if (!empty($nombre) and !empty($archivo['name'])){

	$name = "(".$nombre.")".$archivo['name'];
	$ruta = $_FILES['archivo']['tmp_name'];
	$destino = "../tercero_documentacion/" . $name;

	if (copy($ruta, $destino)) {
		$insert_tmp=mysqli_query($con, "INSERT INTO tmp_files (nombre,ruta,archivo) VALUES ('$nombre','$destino','$name')");
	
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
	<th class="text-center">Nombre</th>
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

	
		$resultado.='
		<tr>
			<td class="text-center">'.$nombre.'</td>
			<td class="text-right">'.$ruta.'</td>
			<td class="text-center"><a href="#" onclick="eliminar('.$id_tmp.')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>';	
		
	}
	$resultado.='</table>';
	echo json_encode($resultado);
?>