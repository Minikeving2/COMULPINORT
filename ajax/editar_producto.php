<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	
	
	if ($_POST['mod_id']=="") {
           $errors[] = "ID vacio";
        }else if ($_POST['mod_cod_producto']=="") {
           $errors[] = "Código vacío";
        } else if ($_POST['mod_nombre_producto']==""){
			$errors[] = "Nombre del producto vacío";
		} else if ($_POST['mod_estado']==""){
			$errors[] = "Selecciona el estado del producto";
		} else if (($_POST['precio_producto']==0)){
			$errors[] = "Precio de venta vacío";
		} else if (
			($_POST['mod_id']!="") &&
			($_POST['mod_cod_producto']!="") &&
			($_POST['mod_nombre_producto']!="") &&
			($_POST['mod_estado']!="") &&
			($_POST['precio_producto']!=0)
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code

	
mysqli_query($con,"SET NAMES 'utf8'");

		$id_producto = $_POST["mod_id"];
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cod_producto"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre_producto"],ENT_QUOTES)));
		$estado=intval($_POST['mod_estado']);
		$precio_venta=floatval($_POST['precio_producto']);
		$descripcion1= mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion_producto"],ENT_QUOTES)));
		$descripcion2 = mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion_long"],ENT_QUOTES)));
		$categoria = intval($_POST["categoria"]);
		$tipo = intval($_POST["tipo"]);
		
		
		$sql= "UPDATE products SET codigo_producto='".$codigo."', nombre_producto='".$nombre."', status_producto='".$estado."', precio_producto='".$precio_venta."', descripcion='".$descripcion1."', descripcion2='".$descripcion2."', tipo_prod='".$tipo."', tipo_categoria='".$categoria."' WHERE id_producto='".$id_producto."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$proceso = "ACTUALIZAR";
				$descripcion = "PRODUCTO";
				$id_usuario = $_SESSION['user_id'];
				$nombre = $_SESSION['user_name'];
				include ("nueva_auditoria.php");
				$messages[] = "Producto ha sido actualizado satisfactoriamente.";
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