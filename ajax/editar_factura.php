<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	$id_factura= $_SESSION['id_factura'];
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['id_cliente'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['id_vendedor'])) {
           $errors[] = "Selecciona el vendedor";
		} else if (
			!empty($_POST['id_cliente']) &&
			!empty($_POST['id_vendedor'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		
        mysqli_query($con,"SET NAMES 'utf8'");

		

		$id_cliente=intval($_POST['id_cliente']);
		$id_vendedor=intval($_POST['id_vendedor']);
        $contraprestacion=$_POST["contraprestacion"];
		$num_fact=$_POST['num_fact'];
		$fecha_fact=$_POST['fecha_fact'];

		$num_comp=$_POST['num_comp'];
		$fecha_comp=$_POST['fecha_comp'];

		$tipo_mov=$_POST['tipo_mov'];
        if ($_POST["proveedor"]==""){
        	$proveedor="null";
        } else {
        	$proveedor="'".$_POST["proveedor"]."'";
        }
		$condiciones=$_POST['observacion'];
		$total = str_replace(',','',$_POST['total']);
		
		$sql="UPDATE facturas SET id_cliente='".$id_cliente."', id_vendedor='".$id_vendedor."', condiciones='".$condiciones."', tipo_mov='".$tipo_mov."', id_proveedor=".$proveedor.", contraprestacion='".$contraprestacion."',";
		
		if ($fecha_comp!="" && $num_comp!=""){
			$sql .= " fecha_comprobante='".$fecha_comp."', nro_comprobante='".$num_comp."',";
		}//datos del comprobante

		if ($fecha_fact!="" && $num_fact!=""){
			$sql .= " fecha_fact='".$fecha_fact."', numero_factura='".$num_fact."',";
		}//datos de la factura de compra

		$sql .= " total_venta='".$total."' WHERE id_factura='".$id_factura."';";
		$query_update = mysqli_query($con,$sql);
		
		if ($query_update){
				$messages[] = "Factura ha sido actualizada satisfactoriamente.";
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