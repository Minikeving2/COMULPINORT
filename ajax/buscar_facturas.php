<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	mysqli_query($con,"SET NAMES 'utf8'");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_factura=intval($_GET['id']);
		$desc_mov = mysqli_query($con, "SELECT tipo_mov FROM factura WHERE id_factura = $id_factura");
		$del1="delete from facturas where id_factura='".$id_factura."'";
		$del2="delete from detalle_factura where id_factura='".$id_factura."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			switch ($desc_mov) {
				case 1:
					$mov = "Equipos (Comodato)";
					break;
				case 2:
					$mov = "Publicidad";
					break;
				case 3:
					$mov = "Letrero de precios";
					break;
				case 4:
					$mov = "Apoyo arreglos locativos";
					break;
				case 5:
					$mov = "Apoyo Económico/Transacción";
					break;
				case 6:
					$mov = "Apoyo Económico/Efectivo";
					break;
				case 7:
					$mov = "Apoyo Económico/Cruce Cart.";
					break;
				case 8:
					$mov = "Crédito/Transacción";
					break;
				case 9:
					$mov = "Crédito/Cruce Cart.";
					break;
				case 10:
					$mov = "Cupo Crédito Estaciones";
					break;
				case 11:
					$mov = "Préstamos";
					break;
				case 12:
					$mov = "Pólizas SURA";
					break;
				case 13:
					$mov = "Descuentos Gasolina Nacional";
					break;
				case 14:
					$mov = "Mejoras E.D.S";
					break;
			}
			$proceso = "ELIMINAR";
			$descripcion = "MOVIMIENTO - ".$mov;
			$id_usuario = $_SESSION['user_id'];
			$nombre = $_SESSION['user_name'];
			include ("nueva_auditoria.php");
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong><?php echo $id_factura; ?> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $sTable = "facturas, clientes, users";
		 $sWhere = "";
		 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id";
		if ( $_GET['q'] != "" ){
			$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%')";
		}
		$sWhere.=" order by facturas.id_factura desc";
		//include 'pagination.php'; //include pagination file
		//pagination variables
		//$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		//$per_page = 10; //how much records you want to show
		//$adjacents  = 4; //gap between pages after number of adjacents
		//$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		//$total_pages = ceil($numrows/$per_page);
		$reload = './facturas.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive" id="scroll">
			  <table class="table">
				<thead>
				<tr  class="info">
					<th>#</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Tipo de Movimineto</th>
					<th>Estado</th>
					<th class='text-right'>Total</th>
					<th class='text-right'>Acciones</th>	
				</tr>
				</thead>
				<tbody>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha_add=date("d/m/Y", strtotime($row['fecha_factura']));
						$nombre_cliente=$row['nombre_cliente'];
						$telefono_cliente=$row['telefono_cliente'];
						$email_cliente=$row['email_cliente'];
						$tipo_mov=$row['tipo_mov'];
						$nombre_vendedor=$row['firstname']." ".$row['lastname'];
						$estado_factura=$row['estado_factura'];
						$total_venta=$row['total_venta'];
						if ($tipo_mov<11 && $tipo_mov>4){
							$query_estado=mysqli_query($con,"SELECT id_detalle,duracion FROM detalle_factura WHERE id_factura = $id_factura");	
							$cont_fechas=0;
							while ($rows=mysqli_fetch_array($query_estado)){
								$id_datalle=$rows['id_detalle'];
								$fecha=$rows['duracion'];
								if (empty($rows['duracion'])){
									$cont_fechas=$cont_fechas+1;
								}
							}
							if ($cont_fechas==0){
								$label_class='label-success';
								$text_estado="Pagado";
							} else {
								$label_class='label-warning';
								$text_estado="Pendiente";
							}
						} else {
							$label_class='label-success';
							$text_estado="Pagado";
						}
						switch ($tipo_mov) {
							case 1:
								$tipo_mov = "Equipos (Comodato)";
								break;
							case 2:
								$tipo_mov = "Publicidad";
								break;
							case 3:
								$tipo_mov = "Letrero de precios";
								break;
							case 4:
								$tipo_mov = "Apoyo arreglos locativos";
								break;
							case 5:
								$tipo_mov = "Apoyo Económico/Transacción";
								break;
							case 6:
								$tipo_mov = "Apoyo Económico/Efectivo";
								break;
							case 7:
								$tipo_mov = "Apoyo Económico/Cruce Cart.";
								break;
							case 8:
								$tipo_mov = "Crédito/Transacción";
								break;
							case 9:
								$tipo_mov = "Crédito/Cruce Cart.";
								break;
							case 10:
								$tipo_mov = "Cupo Crédito Estaciones";
								break;
							case 11:
								$tipo_mov = "Préstamos";
								break;
							case 12:
								$tipo_mov = "Pólizas SURA";
								break;
							case 13:
								$tipo_mov = "Descuentos Gasolina Nacional";
								break;
							case 14:
								$tipo_mov = "Mejoras E.D.S";
								break;
							}
					?>
					<tr>
						<td><?php echo $id_factura; ?></td>
						<td><?php echo $fecha_add; ?></td>
						<td><a href="#" data-toggle="tooltip" data-placement="top" title="<i class='glyphicon glyphicon-phone'></i> <?php echo $telefono_cliente;?><br><i class='glyphicon glyphicon-envelope'></i>  <?php echo $email_cliente;?>" ><?php echo $nombre_cliente;?></a></td>
						<td><?php echo $tipo_mov; ?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td class='text-right'><?php echo number_format ($total_venta,2); ?></td>					
						<td class="text-right">
							<a href="editar_factura.php?id_factura=<?php echo $id_factura;?>" class='btn btn-default' title='Editar factura' ><i class="glyphicon glyphicon-edit"></i></a> 
							<a href="#" class='btn btn-default' title='Descargar factura' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar factura' onclick="eliminar('<?php echo $id_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
						</td>
					</tr>
					<?php
				}
				?>
				</tbody>
			  </table>
			</div>
			<?php
		} else {
			
				?>
				<div class="table-responsive" id="scroll">
				<table class="table">
					<thead>
						<tr  class="info">
							<th>#</th>
							<th>Fecha</th>
							<th>Cliente</th>
							<th>Tipo de Movimiento</th>
							<th>Estado</th>
							<th class='text-right'>Total</th>
							<th class='text-right'>Acciones</th>	
						</tr>
					</thead>
				</table>
					<div class="search_null">
						No se encontraron movimientos  
					</div>
				  </div>
				  <?php
		}
	}
?>