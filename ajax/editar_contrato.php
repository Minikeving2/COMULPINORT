<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	$id_contrato= $_SESSION['id_contrato'];
	/*Inicia validacion del lado del servidor*/
	
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		
mysqli_query($con,"SET NAMES 'utf8'");
		$num_contrato = $_POST["num_contrato"];

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
		$fecha_act=date("Y-m-d");
		$observacion = $_POST["observaciones"];
		$calculado = str_replace(',','',$_POST["calculado"]);


		if($archivo['name']){
			$sql =  "SELECT ruta FROM contrato WHERE id_contrato='$id_contrato'";
			$datos = mysqli_fetch_array(mysqli_query($con,$sql));
			//el unlink me elimina el fichero segun la ubicacion y su nombre
			unlink($datos[0]);

			$name = "(".$id_contrato.")".$archivo['name'];
			$ruta = $archivo['tmp_name'];
			$destino = "../archivos/" . $name;
			copy($ruta, $destino);
			$sql="UPDATE contrato SET fecha_inicio='".$fecha_inicio."', fecha_final='".$fecha_fin."', fecha_act='".$fecha_act."',tipo_per='".$tipo_per."',id_cliente='".$id_cliente."',duracion='".$duracion."',numcontrato='".$num_contrato."', numpoliza='".$num_poliza."',clausulagal='".$clau_legal."', clausulapenal='".$clau_penal."', descripcion='".$observacion."', valor='".$calculado."',id_contrato_rel=".$otrosi.", id_usuario='".$id_usuario."', ruta='".$destino."', archivo='".$name."' WHERE id_contrato='".$id_contrato."'";
		} else {
			$sql="UPDATE contrato SET fecha_inicio='".$fecha_inicio."', fecha_final='".$fecha_fin."', fecha_act='".$fecha_act."',tipo_per='".$tipo_per."',id_cliente='".$id_cliente."',duracion='".$duracion."',numcontrato='".$num_contrato."', numpoliza='".$num_poliza."',clausulagal='".$clau_legal."', clausulapenal='".$clau_penal."', descripcion='".$observacion."', valor='".$calculado."',id_contrato_rel=".$otrosi.", id_usuario='".$id_usuario."' WHERE id_contrato='".$id_contrato."'";
		}

	
		
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
			    $proceso = "ACTUALIZAR";
				$descripcion = "CONTRATO";
				$id_usuario = $_SESSION['user_id'];
				$nombre = $_SESSION['user_name'];
				include ("nueva_auditoria.php");
				$messages[0] = "Factura ha sido actualizada satisfactoriamente.";
			} else{
				$errors [0]= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		
	if (isset($errors)){
		echo json_encode('
			<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error!</strong>'.$errors[0].
			'</div>'
		);
	}	
	if (isset($messages)){				
		echo json_encode('
			<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡Bien hecho!</strong>'.$message[0].
			'</div>'
	);
	}
?>