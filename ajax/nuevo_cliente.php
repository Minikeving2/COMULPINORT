<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	
	if (empty($_POST['nombre_tercero']) or empty($_POST['nit'])) {
		if (empty($_POST['nombre_tercero'])) {
			$errors[] = "Nombre de la EDS/Asociado está vacío";
		}
		if (empty($_POST['nit'])) {
			$errors[] = "Nit/C.C. de la EDS/Asociado está vacío";
		}
		   
    } else if (!empty($_POST['nombre_tercero'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		//ASIGNACION DE VARIABLES PARA INSERTAR
		
		mysqli_query($con,"SET NAMES 'utf8'");
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre_tercero"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono_cliente"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email_cliente"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion_cliente"],ENT_QUOTES)));
		$estado=intval($_POST['estado']);
		$date_added=date("Y-m-d H:i:s");
		$id_mun=$_POST['mun'];

		$codsicom=mysqli_real_escape_string($con,(strip_tags($_POST["sicom"],ENT_QUOTES)));
		$nit=mysqli_real_escape_string($con,(strip_tags($_POST["nit"],ENT_QUOTES)));
		$cupo=mysqli_real_escape_string($con,(strip_tags($_POST["cupo"],ENT_QUOTES)));
		$tipoter=intval($_POST['tipo_tercero']);
		$fechaact=date("Y-m-d H:i:s");

		$ccrp=mysqli_real_escape_string($con,(strip_tags($_POST["cedula_rp"],ENT_QUOTES)));
		$nombrerp=mysqli_real_escape_string($con,(strip_tags($_POST["nombre_rp"],ENT_QUOTES)));
		$telefonorp=mysqli_real_escape_string($con,(strip_tags($_POST["tel_rp"],ENT_QUOTES)));
		$emailrp=mysqli_real_escape_string($con,(strip_tags($_POST["email_rp"],ENT_QUOTES)));
		$direccionrp=mysqli_real_escape_string($con,(strip_tags($_POST["direccion_rp"],ENT_QUOTES)));
		
		if ($tipoter==1){
			$tipoter="E";
		} elseif ($tipoter="2") {
			$tipoter="P";
		} elseif ($tipoper) {
			$tipoter="A";
		}


		$sql="INSERT INTO clientes (nombre_cliente, telefono_cliente, email_cliente, direccion_cliente, status_cliente, date_added,fecha_act, nit, cupo, tipo_tercero, cc_rp, nombre_rp, tel_rp, email_rp, dir_rp , id_municipio, codigo_sicom) VALUES ('$nombre','$telefono','$email','$direccion','$estado','$date_added', '$fechaact','$nit','$cupo','$tipoter','$ccrp','$nombrerp','$telefonorp','$emailrp','$direccionrp',$id_mun,'$codsicom')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){

				$sql="SELECT MAX(id_cliente) FROM clientes";
				$result=mysqli_fetch_array(mysqli_query($con, $sql));
				if (isset($result[0])){
					$id_cliente=$result[0];
				} else {
					$id_cliente = 1;
				}
				
				//inserto los datos de la tabla tmp en la tabla factura con el id del registro para asi qeudar vinculadas
				$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM tmp_files");
				$row= mysqli_fetch_array($count_query);
				$numrows = $row['numrows'];
				$sql="SELECT * FROM tmp_files";
						
						$query = mysqli_query($con, $sql);
						if ($numrows>0){
							$aux="";
							while ($row=mysqli_fetch_array($query)){
								$ruta=$row['ruta'];
								$archivo=$row['archivo'];
								$nombre_doc=$row['nombre'];
								$tipo_doc=$row['tipo_doc'];
								$fecha_inicio=$row['fecha_inicio'];
								$fecha_fin=$row['fecha_final'];
								$fecha_added=date('Y-m-d');
								$insert=mysqli_query($con, "INSERT INTO detalle_cliente (cod_cliente,nombre,ruta,archivo,tipo_doc,fecha_documento,fecha_vencimiento,fecha_added) VALUES ('$id_cliente','".$nombre_doc."','".$ruta."','".$archivo."','".$tipo_doc."','".$fecha_inicio."','".$fecha_fin."','".$fecha_added."')");
								
								$proceso = "INSERTAR";
								$descripcion = "ARCHIVO - ESTACION";
								$id_usuario = $_SESSION['user_id'];
								$nombre = $_SESSION['user_name'];
								include ("nueva_auditoria.php");
							}
						}
				
				//tras realizar la importacion de tmp a detalle_factura toca vacia la tabla tmp
				
				$sql=mysqli_query($con,"DELETE FROM tmp_files");
				

				$messages[] = "Tercero ha sido ingresado satisfactoriamente.";
				
				$proceso = "INSERTAR";
				$descripcion = "ESTACION";
				$id_usuario = $_SESSION['user_id'];
				$nombre = $_SESSION['user_name'];
				include ("nueva_auditoria.php");

			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}

		//pasar los archivos qeu se introduciran en una carpta temporal
		//y pasar la informacion de la tabla tmp a la tabla detalle_cliente

		$resultado="";
		if (isset($errors)){
			$resultado.='<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>';
					
						foreach ($errors as $error) {
							$resultado.=$error;
							}
						
							$resultado.='</div>';
							
			
		}
			if (isset($messages)){
				$resultado.='<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Bien hecho!</strong>';
						
							foreach ($messages as $message) {
								$resultado.=$message;
								}
				$resultado.='</div>';
				
			}
			echo json_encode($resultado);
?>