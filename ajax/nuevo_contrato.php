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

$sql_count=mysqli_query($con,"select * from tmp");
$count=mysqli_num_rows($sql_count);
if ($count==0){
	echo json_encode("<script>alert('No hay productos agregados a la factura')</script>");

} else {
	$num_contrato = $_POST["num_contrato"];
	$num_poliza = $_POST['num_poliza'];

	if ($_POST['num_poliza']==""){
		$num_poliza="null";
	} else {
		$num_poliza=$_POST['num_poliza'];
	}

	$tipo_per=$_POST["tipo_per"];
	$id_usuario = $_POST["vendedor"];

	$fecha_inicio=$_POST["fecha_inicio"];
	$fecha_fin=$_POST["fecha_fin"];

	$id_cliente=$_POST["id_cliente"];

	if ($_POST["clau_legal"]=="on"){
		$clau_legal='1';
	} else {
		$clau_legal="0";
	}

	if ($_POST["clau_penal"]=="on"){
		$clau_penal="1";
	} else {
		$clau_penal="0";
	}

	if ($_POST["otrosi"]==""){
		$otrosi='null';
	} else {
		$otrosi="'".$_POST["otrosi"]."'";
	}

	if ($_POST["duracion"]==""){
		$duracion = '1';
	} else {
		$duracion = $_POST["duracion"];
	}

	$archivo = $_FILES['archivo'];


	if ($archivo['name']==""){
		echo json_encode("<script>alert('No hay ninguno archivo cargado')</script>");
		exit;
	}
	$observacion = $_POST["observaciones"];
	$calculado = str_replace(',','',$_POST["calculado"]);

	$fecha_creacion=date("Y-m-d");
//inserto los datos de la tabla facturas,
	$sql=mysqli_query($con, "INSERT INTO contrato (fecha_inicio, fecha_final, fecha_crea, tipo_per, id_cliente, duracion, numcontrato, numpoliza, clausulagal, clausulapenal, descripcion, valor, id_contrato_rel, id_usuario) VALUES ('$fecha_inicio', '$fecha_fin', '$fecha_creacion', '$tipo_per', '$id_cliente', '$duracion', '$num_contrato', '$num_poliza', '$clau_legal', '$clau_penal','$observacion','$calculado',$otrosi,'".$_SESSION['user_id']."')");

	if ($sql){	
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
				mysqli_query($con, "INSERT INTO detalle_contrato (id_contrato,id_producto,cantidad,precio_costo,total)VALUES ('$id_factura','".$row['id_producto']."','".$row['cantidad_tmp']."','".$row['precio_tmp']."','$aux')");
			}
		}
			$name = "(".$id_factura.")".$archivo['name'];
			$ruta = $_FILES['archivo']['tmp_name'];
			$destino = "../archivos/" . $name;
		
    		if (copy($ruta, $destino)) {
       			mysqli_query($con, "UPDATE contrato SET ruta = '$destino', archivo = '$name' WHERE id_contrato = $id_factura");
			} else {
					echo json_encode('<script>alert("El tipo de archivo no es valido") </script>');
					exit;
			}
		
	//tras realizar la importacion de tmp a detalle_factura toca vacia la tabla tmp
	
		$sql=mysqli_query($con,"DELETE FROM tmp");
		echo json_encode("<script>alert('factura registrada correctamente')</script>");
 	} else {
		echo json_encode("INSERT INTO contrato (fecha_inicio, fecha_final, fecha_crea, tipo_per, id_cliente, duracion, numcontrato, numpoliza, clausulagal, clausulapenal, descripcion, valor, id_contrato_rel, id_usuario) VALUES ('$fecha_inicio', '$fecha_fin', '$fecha_creacion', '$tipo_per', '$id_cliente', '$duracion', '$num_contrato', '$num_poliza', '$clau_legal', '$clau_penal','$observacion','$calculado','$otrosi','".$_SESSION['user_id']."')");
 	}
}
?>
