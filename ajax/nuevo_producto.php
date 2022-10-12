<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['cod_producto'])) {
           $errors[] = "Código vacío";
        } else if (empty($_POST['nombre_producto'])){
			$errors[] = "Nombre del producto vacío";
		} else if ($_POST['estado']==""){
			$errors[] = "Selecciona el estado del producto";
		} else if (empty($_POST['precio_producto'])){
			$errors[] = "Precio de venta vacío";
		} else if (
			!empty($_POST['cod_producto']) &&
			!empty($_POST['nombre_producto']) &&
			$_POST['estado']!="" &&
			!empty($_POST['precio_producto'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code

mysqli_query($con,"SET NAMES 'utf8'");
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["cod_producto"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre_producto"],ENT_QUOTES)));
		$estado=intval($_POST['estado']);
		$precio_venta=floatval($_POST['precio_producto']);
		$date_added=date("Y-m-d");
		$tipo=$_POST["tipo"];
		$categoria=$_POST["categoria"];
		$descripcion1=$_POST["descripcion_producto"];
		$descripcion2=$_POST["descripcion_long"];
		
		$sql= "INSERT INTO products (codigo_producto, nombre_producto, status_producto, date_added, precio_producto, descripcion, descripcion2, tipo_prod, tipo_categoria) VALUES ('$codigo','$nombre','$estado','$date_added','$precio_venta', '$descripcion1', '$descripcion2', '$tipo', '$categoria')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
			    
			    $proceso = "INSERTAR";
				$descripcion = "PRODUCTO";
				$id_usuario = $_SESSION['user_id'];
				$nombre = $_SESSION['user_name'];
				include ("nueva_auditoria.php");
				
				$messages[] = "Producto ha sido ingresado satisfactoriamente.";
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