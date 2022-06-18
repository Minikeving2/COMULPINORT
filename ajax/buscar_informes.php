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
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    
	/*if (isset($_GET['id'])){
		$id_factura=intval($_GET['id']);
		$del1="delete from facturas where id_factura='".$id_factura."'";
		$del2="delete from detalle_factura where id_factura='".$id_factura."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
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
	}*/
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         //fechas para la busqueda entre un rango
         $fecha_start= "'".$_REQUEST['fecha_start']."'";
         $fecha_end= "'".$_REQUEST['fecha_end']."'";

		 
		
		//include 'pagination.php'; //include pagination file
		//pagination variables
		//$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		//$per_page = 10; //how much records you want to show
		//$adjacents  = 4; //gap between pages after number of adjacents
		//$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/

		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM clientes, facturas, detalle_factura, products WHERE clientes.nombre_cliente like '%$q%' and clientes.id_cliente = facturas.id_cliente and facturas.id_factura = detalle_factura.id_factura and detalle_factura.id_producto = products.id_producto and facturas.fecha_factura >= $fecha_start and facturas.fecha_factura <= $fecha_end");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		//$total_pages = ceil($numrows/$per_page);
		$reload = './facturas.php';
		//main query to fetch the data
		$sql="SELECT facturas.id_factura, facturas.fecha_factura, clientes.nombre_cliente, products.codigo_producto, products.nombre_producto, detalle_factura.cantidad, detalle_factura.total FROM clientes, facturas, detalle_factura, products WHERE clientes.nombre_cliente like '%$q%' and clientes.id_cliente = facturas.id_cliente and facturas.id_factura = detalle_factura.id_factura and detalle_factura.id_producto = products.id_producto and facturas.fecha_factura >= $fecha_start and facturas.fecha_factura <= $fecha_end ORDER BY `facturas`.`fecha_factura` ASC";
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
					<th>Cod prod.</th>
					<th>Nombre producto</th>
					<th>Cantidad</th>
					<th class='text-right'>Total</th>
					<!--<th class='text-right'>Acciones</th>-->	
				</tr>
				</thead>
				<tbody>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_factura=$row['id_factura'];
						$fecha_factura=$row['fecha_factura'];
						$nombre_cliente=$row['nombre_cliente'];
						$cod_producto=$row['codigo_producto'];
						$nombre_producto=$row['nombre_producto'];
						$cantidad=$row["cantidad"];
						$total=$row['total'];
						$precio_total_f=number_format($total,2);//Precio total formateado
					?>
					<tr>
						<td><?php echo $id_factura;?></td>
						<td><?php echo $fecha_factura;?></td>
						<td><?php echo $nombre_cliente;?></td>
						<td><?php echo $cod_producto;?></td>
						<td><?php echo $nombre_producto;?></td>
						<td class='text-center'><?php echo $cantidad;?></td>
						<td class='text-right'><?php
						echo $precio_total_f;
						 ?></td>
											
					<!--<td class="text-right">
						<a href="editar_factura.php?id_factura=<?php echo $id_factura;?>" class='btn btn-default' title='Editar factura' ><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default' title='Descargar factura' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar factura' onclick="eliminar('<?php echo $id_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>-->
						
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
							<th>Cod prod.</th>
							<th>Nombre prod.</th>
							<th class='text-right'>Total</th>
								
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