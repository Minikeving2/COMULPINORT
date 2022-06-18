<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background: #54bf87;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "obedalvarado.pw "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444; " >
                <img style="width: 100%;" src="../../img/largo.png" alt="Logo"><br>
                
            </td>
			<td style="width: 50%; color: #000 ;font-size:12px;text-align:center">
                <span style="color: #000;font-size:14px;font-weight:bold"><?php echo NOMBRE_EMPRESA;?></span>
				<br><?php echo DIRECCION_EMPRESA;?><br> 
				Teléfono: <?php echo TELEFONO_EMPRESA;?><br>
				Email: <?php echo EMAIL_EMPRESA;?>
                
            </td>
			<td style="width: 25%;text-align:right">
			
			</td>
			
        </tr>
    </table>
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>DATOS DEL CLIENTE </td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php 
				$sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
				echo $rw_cliente['nombre_cliente'];
				echo "<br>";
				echo $rw_cliente['direccion_cliente'];
				echo "<br> Teléfono: ";
				echo $rw_cliente['telefono_cliente'];
				echo "<br> Email: ";
				echo $rw_cliente['email_cliente'];
			?>
			
		   </td>
        </tr>
        
   
    </table>
    
       <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>DETALLE</td>
		  <td style="width:25%;" class='midnight-blue'>DESDE</td>
		   <td style="width:25%;" class='midnight-blue'>HASTA</td>
        </tr>
		<tr>
           <td style="width:50%;">
			
				RESUMEN DE MOVIMIENTO
			
		   </td>
		  <td style="width:25%;"><?php echo $fecha_inicio;?></td>
		   <td style="width:25%;" >
				<?php
					echo $fecha_fin; 
				?>
		   </td>
        </tr>
		
        
   
    </table>
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 5%;text-align: center" class='midnight-blue'>ID</th>
			<th style="width: 10%;text-align: center" class='midnight-blue'>FECHA</th>
            <th style="width: 15%;text-align: center" class='midnight-blue'>COD PROD.</th>
            <th style="width: 40%;text-align: left" class='midnight-blue'>NOMBRE PRODUCTO</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>CANTIDAD</th>
			<th style="width: 15%;text-align: right" class='midnight-blue'>TOTAL</th>
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "SELECT facturas.fecha_factura, facturas.id_factura, clientes.nombre_cliente, products.codigo_producto, products.nombre_producto, detalle_factura.cantidad, detalle_factura.total FROM clientes, facturas, detalle_factura, products WHERE clientes.nombre_cliente like '%".$rw_cliente['nombre_cliente']."%' and clientes.id_cliente = facturas.id_cliente and facturas.id_factura = detalle_factura.id_factura and detalle_factura.id_producto = products.id_producto and facturas.fecha_factura >= '$fecha_inicio' and '$fecha_fin' >= facturas.fecha_factura");

while ($row=mysqli_fetch_array($sql))
	{
	
	$fecha_factura_u=$row["fecha_factura"];
	$id_factura=$row['id_factura'];
	$cod_producto=$row['codigo_producto'];
	$nombre_producto=$row['nombre_producto'];
	$cantidad=$row["cantidad"];
	$total_v=$row["total"];

	/*$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	*/$precio_total_f=number_format($total_v,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);/*//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador*/
	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}
	?>

        <tr>
            <td class='<?php echo $clase;?>' style="width: 5%; text-align: center"><?php echo $id_factura;?></td>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $fecha_factura_u;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: center"><?php echo $cod_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 40%; text-align: left"><?php echo $nombre_producto;?></td>
			<td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $cantidad;?></td>
			<td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>

	<?php 

	
	$nums++;
	}
	
	//$subtotal=number_format($sumador_total,2,'.','');
	//$total_iva=($subtotal * TAX )/100;
	//$total_iva=number_format($total_iva,2,'.','');
	//$total_factura=$subtotal+$total_iva;
	//$total_factura=$subtotal;




	//<tr>
	//<td colspan="3" style="widtd: 85%; text-align: right;">IVA (<?php echo TAX; )% &#36; </td>
	//<td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);</td>
	//</tr>
?>
	<!-- 
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
        </tr>
		<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,2);?></td>
        </tr>-->
    </table>
	
	
	
	<br>
	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por su compra!</div>
	
	
	  

</page>

