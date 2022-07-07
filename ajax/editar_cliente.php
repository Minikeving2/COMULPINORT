<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	
	if (empty($_POST['id_cliente'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['nombre_cliente'])) {
           $errors[] = "Nombre vacío";
        }  else if ($_POST['estado']==""){
			$errors[] = "Selecciona el estado del cliente";
		}  else if ( !empty($_POST['id_cliente']) && !empty($_POST['nombre_cliente']) && $_POST['estado']!="" )
		{
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
	
mysqli_query($con,"SET NAMES 'utf8'");
		$id_cliente=intval($_POST['id_cliente']);
		$nit=$_POST["nit"];
		$nombre_cliente=mysqli_real_escape_string($con,(strip_tags($_POST["nombre_cliente"],ENT_QUOTES)));
		$codigo_sicom=intval($_POST["codigo_sicom"]);
		$estado=intval($_POST['estado']);
		$id_municipio=intval($_POST['id_municipio']);
		$cupo=intval($_POST['cupo']);
		$tipo_tercero=intval($_POST["tipo_tercero"]);
		$telefono_cliente=mysqli_real_escape_string($con,(strip_tags($_POST["telefono_cliente"],ENT_QUOTES)));
		$email_cliente=mysqli_real_escape_string($con,(strip_tags($_POST["email_cliente"],ENT_QUOTES)));
		$direccion_cliente=mysqli_real_escape_string($con,(strip_tags($_POST["direccion_cliente"],ENT_QUOTES)));
		$cc_rp=intval($_POST["cc_rp"]);
		$nombre_rp=mysqli_real_escape_string($con,(strip_tags($_POST["nombre_rp"],ENT_QUOTES)));
		$telefono_rp=mysqli_real_escape_string($con,(strip_tags($_POST["telefono_rp"],ENT_QUOTES)));
		$email_rp=mysqli_real_escape_string($con,(strip_tags($_POST["email_rp"],ENT_QUOTES)));
		$direccion_rp=mysqli_real_escape_string($con,(strip_tags($_POST["direccion_rp"],ENT_QUOTES)));
		
		//echo $id_cliente."-".$nit."-".$nombre_cliente."-".$codigo_sicom."-".$estado."-".$cupo."-".$tipo_tercero."-".$telefono_cliente."-".$email_cliente."-".$direccion_cliente."-".$cc_rp."-".$nombre_rp."-".$telefono_rp."-".$email_rp."-".$direccion_rp;
		$sql= "UPDATE clientes SET nombre_cliente='".$nombre_cliente."', telefono_cliente='".$telefono_cliente."', email_cliente='".$email_cliente."', direccion_cliente='".$direccion_cliente."', status_cliente='".$estado."', codigo_sicom='".$codigo_sicom."', nit='".$nit."', cc_rp='".$cc_rp."', nombre_rp='".$nombre_rp."', tipo_tercero='".$tipo_tercero."', tel_rp='".$telefono_rp."', email_rp='".$email_rp."', dir_rp='".$direccion_rp."', id_municipio='".$id_municipio."', cupo='".$cupo."', fecha_act='". date('Y-m-d', time())."' where id_cliente= '".$id_cliente."';";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Cliente ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>