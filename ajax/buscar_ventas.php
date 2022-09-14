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
	
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $fecha_start="'".$_REQUEST['fecha_start']."'";
		 $fecha_end="'".$_REQUEST['fecha_end']."'";
		  $sTable = "ventas, clientes";
		 $sWhere = "";
		 $sWhere.=" WHERE ventas.ID_CLIENTE = clientes.id_cliente and ventas.FECHA >= $fecha_start and ventas.FECHA <= $fecha_end";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (clientes.nombre_cliente like '%$q%')";
			
		}
		
		//$sWhere.=" order by facturas.id_factura desc";
		
        
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
		$reload = './ventas.php';
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
					<th>Contenacion</th>
					<th>Fecha</th>
					<th>Nit</th>
					<th>Nombre Cliente</th>
					<th>CODMAD</th>
					<th>CANLISTA</th>
					<th>PARCVTA</th>
				</tr>
				</thead>
				<tbody>
				<?php
				echo $sql;
				while ($row=mysqli_fetch_array($query)){
					
					$concatenacion=$row['CONCATENATION'];
					$fecha=$row['FECHA'];
					$nit=$row['NIT'];
					$nombre_cliente=$row['NOMBRE'];
					$codmad=$row['CODMAT'];
					$nom_combustible=$row['DESCRIPCION'];
					$canlista=$row['CANLISTA'];
					$PARCVTA=$row['PARCVTA'];
					?>
					<tr>
						<td><?php echo $concatenacion; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $nit; ?></td>
						<td><?php echo $nombre_cliente; ?></td>
						<td><?php echo $nom_combustible; ?></td>
						<td><?php echo $canlista; ?></td>
						<td><?php echo $PARCVTA; ?></td>
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
							<th>Contenacion</th>
							<th>Fecha</th>
							<th>Nit</th>
							<th>Nombre Cliente</th>
							<th>CODMAD</th>
							<th>CANLISTA</th>
							<th>PARCVTA</th>
						</tr>
					</thead>
				</table>
					<div class="search_null">
						No se encontraron ventas  
					</div>
				  </div>
				  <?php
		}
	}
?>