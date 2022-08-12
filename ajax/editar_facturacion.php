<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$id_factura= $_SESSION['id_factura'];
$numero_factura= $_SESSION['numero_factura'];
if (isset($_POST['id'])){$id=intval($_POST['id']);}
if (isset($_POST['cantidad'])){$cantidad=intval($_POST['cantidad']);}
if (isset($_POST['precio_venta'])){$precio_venta=floatval($_POST['precio_venta']);}

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

mysqli_query($con,"SET NAMES 'utf8'");	
if ($id!="" and $cantidad!="" and $precio_venta!="")
{
	$aux=$cantidad*$precio_venta;
$insert_tmp=mysqli_query($con, "INSERT INTO detalle_factura (id_factura, id_producto,cantidad,precio_venta,total) VALUES ('$id_factura','$id','$cantidad','$precio_venta','$aux')");

}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_detalle=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM detalle_factura WHERE id_detalle='".$id_detalle."'");
}

if (isset($_POST["fechas_desembolso"])){
	$fechas_desembolsos=$_POST["fechas_desembolso"];
	$total_fechas = explode(",", $fechas_desembolsos);
	$cant_fechas = count($total_fechas);

	$sql=mysqli_query($con, "select * from detalle_factura where id_factura='$id_factura'");
	$i=0;
	while ($row=mysqli_fetch_array($sql)){
		if ($total_fechas[$i]==""){
			$total_fechas[$i]="null";
		} else {
			$total_fechas[$i]="'".$total_fechas[$i]."'";
		}
		mysqli_query($con, "UPDATE detalle_factura SET duracion=".$total_fechas[$i]." WHERE id_detalle='".$row["id_detalle"]."';");
		$i++;	
	}

}

?>
<table class="table">
<tr>
	<th class='text-center'>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>
	<th></th>
	<th class='text-right'>PRECIO UNIT.</th>
	<th class='text-right'>PRECIO TOTAL</th>
	<th></th>
</tr>
<?php
	$sumador_total=0;
	$sql=mysqli_query($con, "select * from products, facturas, detalle_factura where facturas.id_factura=detalle_factura.id_factura and  facturas.id_factura='$id_factura' and products.id_producto=detalle_factura.id_producto");
	$aux_desembolso=0;
	while ($row=mysqli_fetch_array($sql))
	{
	$id_detalle=$row["id_detalle"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad'];
	$nombre_producto=$row['nombre_producto'];
	$fecha=$row["duracion"];

	$precio_venta=$row['precio_venta'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	
		?>
		<tr <?php
		 	if($codigo_producto=="DES001" || $codigo_producto=="DES002"){
			    	echo "class='desembolso'";
			}
			?>
		>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto;?></td>
			<td><?php
			if($codigo_producto=="DES001" || $codigo_producto=="DES002"){
			    	echo "<input type='date' class='form-control input-sm' id='desembolso_".$aux_desembolso++."' value='".$fecha."'>";
			}
			?></td>
			<td class='text-right'><?php echo $precio_venta_f;?></td>
			<td class='text-right'><?php echo $precio_total_f;?></td>
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_detalle ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}
	$subtotal=number_format($sumador_total,2,'.','');
	//$total_iva=($subtotal * TAX )/100;
	//$total_iva=number_format($total_iva,2,'.','');
	//$total_factura=$subtotal+$total_iva;
	$total_factura=$subtotal;
	$update=mysqli_query($con,"update facturas set total_venta='$total_factura' where id_factura='$id_factura'");



	
	//<tr>
	//	<td class='text-right' colspan=4>IVA (<?php echo TAX)% $</td>
	//	<td class='text-right'><?php echo number_format($total_iva,2);</td>
	//	<td></td>
	//</tr>
?>
<tr>
	<td class='text-right' colspan=4>SUBTOTAL $</td>
	<td class='text-right'><?php echo number_format($subtotal,2);?></td>
	<td></td><td></td>
</tr>

<tr>
	<td class='text-right' colspan=4>TOTAL $</td>
	<td class='text-right' ><?php echo number_format($total_factura,2);?></td>
	<td></td><td></td>
</tr>

</table>
<script>
	document.getElementById("calculado").value='<?php echo number_format($total_factura,2);?>';
</script>