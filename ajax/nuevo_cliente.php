<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	mysqli_query($con,"SET NAMES 'utf8'");
	if (empty($_POST['nombre_cliente']) or empty($_POST['nit'])) {
		if (empty($_POST['nombre_cliente'])) {
			$errors[] = "Nombre de la EDS/Asociado está vacío";
		}
		if (empty($_POST['nit'])) {
			$errors[] = "Nit/C.C. de la EDS/Asociado está vacío";
		}
		   
        } else if (!empty($_POST['nombre_cliente'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		//ASIGNACION DE VARIABLES PARA INSERTAR
		
mysqli_query($con,"SET NAMES 'utf8'");
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre_cliente"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono_cliente"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email_cliente"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion_cliente"],ENT_QUOTES)));
		$estado=intval($_POST['estado']);
		$date_added=date("Y-m-d H:i:s");
		$id_mun=$_POST['id_mun'];

		$codsicom=mysqli_real_escape_string($con,(strip_tags($_POST["codigo_sicom"],ENT_QUOTES)));
		$nit=mysqli_real_escape_string($con,(strip_tags($_POST["nit"],ENT_QUOTES)));
		$cupo=mysqli_real_escape_string($con,(strip_tags($_POST["cupo"],ENT_QUOTES)));
		$tipoter=intval($_POST['tipo_tercero']);
		$fechaact=date("Y-m-d H:i:s");

		$ccrp=mysqli_real_escape_string($con,(strip_tags($_POST["cc_rp"],ENT_QUOTES)));
		$nombrerp=mysqli_real_escape_string($con,(strip_tags($_POST["nombre_rp"],ENT_QUOTES)));
		$telefonorp=mysqli_real_escape_string($con,(strip_tags($_POST["tel_rp"],ENT_QUOTES)));
		$emailrp=mysqli_real_escape_string($con,(strip_tags($_POST["email_rp"],ENT_QUOTES)));
		$direccionrp=mysqli_real_escape_string($con,(strip_tags($_POST["dir_rp"],ENT_QUOTES)));
		
		if ($tipoter==1){
			$tipoter="E";
		} elseif ($tipoter="2") {
			$tipoter="P";
		} elseif ($tipoper) {
			$tipoter="A";
		}


		$sql="INSERT INTO clientes (nombre_cliente, telefono_cliente, email_cliente, direccion_cliente, status_cliente, date_added,fecha_act, nit, cupo, tipo_tercero, cc_rp, nombre_rp, tel_rp, email_rp, dir_rp , id_municipio) VALUES ('$nombre','$telefono','$email','$direccion','$estado','$date_added', '$fechaact','$nit','$cupo','$tipoter','$ccrp','$nombrerp','$telefonorp','$emailrp','$direccionrp',$id_mun)";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Tercero ha sido ingresado satisfactoriamente.";
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