<?php
    /*---------------------------*/
    include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    /* Connect To Database*/
    require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    mysqli_query($con,"SET NAMES 'utf8'");

    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM auditoria ORDER BY id_auditoria DESC");
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    
    //falta colocar lo que se ingresa por el campo de busqueda
    $sql="SELECT * FROM  auditoria ORDER BY id_auditoria DESC";
    $query = mysqli_query($con, $sql);
    //loop through fetched data
    if ($numrows>0){
	
?>

<div class="table-responsive" id="scroll">
    <table class="table">
        <thead>
            <tr class="info">
                <th>ID</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Descripcion</th>
                <th>Usuario</th>
                <th>IP equipo</th>	
            </tr>
        </thead>
        <tbody>		

<?php
        while ($row=mysqli_fetch_array($query)){
                        
            $id_auditoria = $row['id_auditoria'];
            $fecha = $row['fecha'];
            $tipo = $row['tipo'];
            $descripcion = $row['descripcion'];
            $usuario = $row['id_usuario']." - ".$row['nombre_usuario'];
            $ip = $row['ip_usuario'];
?>

		    <tr>				
				<td><?php echo $id_auditoria;?></td>
				<td><?php echo $fecha;?></td>
				<td><?php echo $tipo;?></td>
				<td><?php echo $descripcion;?></td>
				<td><?php echo $usuario;?></td>
				<td><?php echo $ip;?></td>
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
                <th>ID</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Descripcion</th>
                <th>Usuario</th>
                <th>IP equipo</th>		
            </tr>
        </thead>
	</table>
    <div class="search_null">
        No se encontraron movimientos  
    </div>
</div>
<?php
    }
?>