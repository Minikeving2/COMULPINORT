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
		$id_factura=intval($_GET['id']);
		$del1="delete from facturas where id_factura='".$id_factura."'";
		$del2="delete from detalle_factura where id_factura='".$id_factura."'";
		if ($delete1=mysqli_query($con,$del1)|5){
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
		  $sTable = "ventas, clientes";
		 $sWhere = "";
		 $sWhere.=" WHERE ventas.id_cliente=clientes.id_cliente";
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
					<th>Cliente</th>
					<th>Galones</th>
					<th>Estado</th>
					<th class='text-right'>Total</th>
					
				</tr>
				</thead>
				<tbody>
				<?php
				while ($row=mysqli_fetch_array($query)){
					
					?>
					<tr>
						<td><?php echo $id_factura; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><a href="#" data-toggle="tooltip" data-placement="top" title="<i class='glyphicon glyphicon-phone'></i> <?php echo $telefono_cliente;?><br><i class='glyphicon glyphicon-envelope'></i>  <?php echo $email_cliente;?>" ><?php echo $nombre_cliente;?></a></td>
						<td><?php echo $nombre_vendedor; ?></td>
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
							<th>Nro. venta</th>
							<th>Fecha</th>
							<th>Estacion</th>
							<th>Galones</th>
							<th>Estado</th>
							<th class='text-right'>Total</th>
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