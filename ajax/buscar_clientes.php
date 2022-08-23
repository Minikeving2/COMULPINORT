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
		$id_cliente=intval($_GET['id']);
		$query=mysqli_query($con, "select * from facturas where id_cliente='".$id_cliente."'");
		$count=mysqli_num_rows($query);
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM clientes WHERE id_cliente='".$id_cliente."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		    }else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Tercero ya tiene movimientos
			</div>
			<?php
			
		    }
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  cliente. Existen facturas vinculadas a éste producto. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('nombre_cliente','nit');//Columnas de busqueda
		 $sTable = "clientes";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by nombre_cliente";
			//include 'pagination.php'; //include pagination file
			//pagination variables
			//$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
			//$per_page = 20; //how much records you want to show
			//$adjacents  = 4; //gap between pages after number of adjacents
			//$offset = ($page - 1) * $per_page;
			//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		//$total_pages = ceil($numrows/$per_page);
		$reload = './clientes.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere";
		
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive" id="scroll">
			  <table class="table">
				<thead>
					<tr  class="info">
						<th>Cod.Sicom</th>	
						<th>Nombre</th>
						<th>Teléfono</th>
						<th>Email</th>
						<th>cupo</th>
						<th>Estado</th>
						<th>Agregado</th>
						<th class='text-right'>Acciones</th>
					</tr>
				</thead>
				<tbody>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_cliente=$row['id_cliente'];
						
						$nombre_cliente=$row['nombre_cliente'];
						$telefono_cliente=$row['telefono_cliente'];
						$email_cliente=$row['email_cliente'];
						$direccion_cliente=$row['direccion_cliente'];
						$status_cliente=$row['status_cliente'];
						$codigo_sicom=$row['codigo_sicom'];
						$nit = $row["nit"];
						$municipio=$row["id_municipio"];
						$cupo=$row['cupo'];
						$tipo_tercero=$row["tipo_tercero"];
						$date_added=$row["date_added"];

						$cc_rp=$row["cc_rp"];
						$nombre_rp=$row["nombre_rp"];
						$tel_rp=$row["tel_rp"];
						$email_rp=$row["email_rp"];
						$dir_rp=$row["dir_rp"];
						

						if ($status_cliente==1){$estado="Activo";}
						else {$estado="Inactivo";}
						
					?>
					<input type="hidden" value="<?php echo $id_cliente;?>" id="id_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $codigo_sicom;?>" id="codigo_sicom<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $direccion_cliente;?>" id="direccion_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $nombre_cliente;?>" id="nombre_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $telefono_cliente;?>" id="telefono_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $email_cliente;?>" id="email_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $cupo;?>" id="cupo<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $status_cliente;?>" id="status_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $nit;?>" id="nit<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $telefono_cliente;?>" id="telefono_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $tipo_tercero;?>" id="tipo_tercero<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $date_added;?>" id="date_added<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $municipio;?>" id="id_municipio<?php echo $id_cliente;?>">
					
					<input type="hidden" value="<?php echo $cc_rp;?>" id="cc_rp<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $nombre_rp;?>" id="nombre_rp<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $tel_rp;?>" id="tel_rp<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $email_rp;?>" id="email_rp<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $dir_rp;?>" id="dir_rp<?php echo $id_cliente;?>">
					
					
					



					<tr>
					    <td><?php echo $codigo_sicom; ?></td>
						<td><?php echo $nombre_cliente; ?></td>
						<td ><?php echo $telefono_cliente; ?></td>
						<td><?php echo $email_cliente;?></td>
						<td><?php echo $cupo;?></td>
						<td><?php echo $estado;?></td>
						<td><?php echo $date_added;?></td>
						
					<td ><span class="pull-right">
					<a href="editar_cliente.php?id_cliente=<?php echo $id_cliente;?>" class='btn btn-default' title='Editar cliente'><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Borrar cliente' onclick="eliminar('<?php echo $id_cliente; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
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
							<th>Cod.Sicom</th>	
							<th>Nombre</th>
							<th>Teléfono</th>
							<th>Email</th>
							<th>cupo</th>
							<th>Estado</th>
							<th>Agregado</th>
							<th class='text-right'>Acciones</th>
						</tr>
					</thead>
				</table>
				<div class="search_null">
					No se encontraron clientes 
				</div>
			</div>
			<?php
		}
	}
?>