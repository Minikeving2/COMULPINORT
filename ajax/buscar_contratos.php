<?php

	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	mysqli_query($con,"SET NAMES 'utf8'");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_contrato=$_GET['id'];

		//buscar la ruta del archivo que esta guyardado de nel contrato y se busca por medio del id_contrato
		$sql =  "SELECT ruta FROM contrato WHERE id_contrato='$numero_contrato'";
		$datos = mysqli_fetch_array(mysqli_query($con,$sql));
		//el unlink me elimina el fichero segun la ubicacion y su nombre
		unlink($datos[0]);

		$del1="delete from contrato where id_contrato='".$numero_contrato."'";
		$del2="delete from detalle_contrato where id_contrato='".$numero_contrato."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
		    
		    $proceso = "ELIMINAR";
			$descripcion = "CONTRATO";
			$id_usuario = $_SESSION['user_id'];
			$nombre = $_SESSION['user_name'];
			include ("nueva_auditoria.php");
			
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
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
		  $sTable = "contrato, clientes, users";
		 $sWhere = "";
		 $sWhere.=" WHERE contrato.id_cliente=clientes.id_cliente and contrato.id_usuario=users.user_id";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or contrato.numcontrato like '%$q%')";
			
		}
		
		$sWhere.=" order by contrato.id_contrato desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './contrato.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive" id="scroll">
			  <table class="table">
				<tr  class="info">
					<th>Num.</th>
					<th>Cliente</th>
					<th>Fecha Inicio</th>
					<th>Fecha Fin</th>
					<th>Estado</th>
					<th class='text-right'>Total</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_contrato=$row['id_contrato'];
						$numero_contrato=$row['numcontrato'];
						$nombre_cliente=$row['nombre_cliente'];
						$fecha_inicio=$row['fecha_inicio'];
						$fecha_fin=$row['fecha_final'];
						$ruta=str_replace("../", "",$row['ruta']);

						if (strtotime($fecha_fin)< strtotime(date("Y-m-d"))){
							$text_estado="Finalizado";$label_class='label-warning';
						} else {
							$text_estado="Vigente";$label_class='label-success';
						}
						$total_venta=$row['valor'];
					?> 
					<tr>
						<td><?php echo $numero_contrato; ?></td>
						<td><?php echo $nombre_cliente; ?></td>
						<td><?php echo $fecha_inicio; ?></td>
						<td><?php echo $fecha_fin; ?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td class='text-right'><?php echo number_format ($total_venta,2); ?></td>					
					<td class="text-right">
						<a href="editar_contrato.php?id_contrato=<?php echo $id_contrato;?>" class='btn btn-default' title='Editar contrato' ><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="<?php echo $ruta; ?>" class='btn btn-default' title='Descargar contrato' download="contrato<?php echo $id_contrato;?>"><i class="glyphicon glyphicon-download"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar contrato' onclick="eliminar('<?php echo $id_contrato; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php
				}
				?>
			  </table>
			</div>
			<?php
		} else { ?>
			<div class="table-responsive" id="scroll">
				<table class="table">
					<thead>
						<tr  class="info">
							<th>Num.</th>
							<th>Cliente</th>
							<th>Fecha Inicio</th>
							<th>Fecha Fin</th>
							<th>Estado</th>
							<th class='text-right'>Total</th>
							<th class='text-right'>Acciones</th>
						</tr>
					</thead>
				</table>
				<div class="search_null">
					No se encontraron contratos	
				</div>
			</div> 
			<?php
		}
	}
?>