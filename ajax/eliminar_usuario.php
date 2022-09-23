<?php

include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
		if (empty($_POST['id'])){
			$errors[] = "Nombres vacíos";
		} elseif(!empty($_POST['id'])){
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		
				mysqli_query($con,"SET NAMES 'utf8'");	
				// escaping, additionally removing everything that could be (html/javascript-) code
				$user_id=intval($_POST['id']);
					
               
					// write new user's data into database
                    $sql = "DELETE FROM users WHERE user_id = $user_id;";
                    $query_delete = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_delete) {

						$proceso = "ELIMINAR";
						$descripcion = "USUARIO";
						$id_usuario = $_SESSION['user_id'];
						$nombre = $_SESSION['user_name'];
						include ("nueva_auditoria.php");

                        $messages[] = "La cuenta ha sido eliminada con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , no se ha podido eliminar.";
                    }
                
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
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