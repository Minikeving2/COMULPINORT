<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }


.linea {
  position: absolute;
  height: 40px;
  top: 35px;
  bottom: -5px;
  margin: auto;
  left: 0px;
  width: 105%;
  border-top: 1px solid #000;
  -webkit-transform: rotate(-15deg);
  -ms-transform: rotate(-15deg);
  transform: rotate(-15deg);
}

.diagonal {
  height: 35px;
}
.diagonal span.arriba {
  
  top: 2px;
  left: 2px;
}

.diagonal span.abajo {
  bottom: 2px;
  right: 2px;
  z-index: 2;
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
                    &copy; <?php echo  $anio="2022"; ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444; " >
                <img style="width: 60%;" src="../../img/largo.png" alt="Logo"><br>
                
            </td>
			<td style="width: 50%; color: #000 ;font-size:12px;text-align:center">
                <span style="color: #000;font-size:14px;font-weight:bold"><?php echo NOMBRE_EMPRESA;?></span>
				<br><?php echo DIRECCION_EMPRESA;?><br> 
				Teléfono: <?php echo "(607) 5720321";?><br>
				Nit: <?php echo "900.297.348-7";?>
                
            </td>
			<td style="width: 25%;text-align:right">
			
			</td>
			
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="width: 100%;">
        <tr>
            <td style="width: 25%; color: #444444; " >
            </td>
			<td style="width: 50%; color: #000 ;font-size:12px;text-align:center">
                <span style="color: #000;font-size:14px;font-weight:bold"><?php echo $titulo;?></span>
            </td>
        </tr>
    </table>
    <br>
    <br>

    <?php
        $aux = 1;
        $search_knime = mysqli_query($con,"SELECT DISTINCT cod_knime FROM clientes WHERE cod_knime");
        $limite=mysqli_num_rows($search_knime);

        while ($aux<=$limite){
           

            $search_id = mysqli_query($con,"SELECT id_cliente FROM clientes WHERE cod_knime = $aux");
            while ($row=mysqli_fetch_array($search_id)){
                $search_fact_bioacem = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) AS CANT FROM `ventas` WHERE ID_CLIENTE = '".$row["id_cliente"]."' AND FECHA LIKE '".$year."-".$mes."-%' AND DESCRIPCION LIKE 'BIOACEM%'"));
		        $acum_bioacem = $acum_bioacem + $search_fact_bioacem['CANT'];
                $search_fact_gasolina = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) AS CANT  FROM `ventas` WHERE ID_CLIENTE = '".$row["id_cliente"]."' AND FECHA LIKE '".$year."-".$mes."-%' AND DESCRIPCION LIKE 'GASOLINA CORRIENTE%'"));
                $acum_gasolina = $acum_gasolina + $search_fact_gasolina['CANT'];

                
                $search_gal_bioacem = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE ID_CLIENTE = '".$row["id_cliente"]."' AND FECHA LIKE '".$year."-".$mes."-%' AND DESCRIPCION LIKE 'BIOACEM%'"));
		        $gal_bioacem = $gal_bioacem + $search_gal_bioacem['0'];
                $search_gal_gasolina = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(CANLISTA) FROM ventas WHERE ID_CLIENTE = '".$row["id_cliente"]."' AND FECHA LIKE '".$year."-".$mes."-%' AND DESCRIPCION LIKE 'GASOLINA CORRIENTE%'"));
                $gal_gasolina = $gal_gasolina + $search_gal_gasolina['0'];

               
            }
            echo "<br>";
        ?>
    <div>
    <table cellspacing="0" style="width: 100%; padding: 0px;" border="1">
        <tr>
            <td rowspan="2" style="width:10%">
                <?php echo $aux;?>
            </td>
            <td style="width:16%">
                <?php echo "B5 ".$acum_bioacem;?>
            </td>
            <td style="width:37%">
                6887 
            </td>
            <td style="width:37%">
                45.135.010,11
            </td>
        </tr>
        <tr>
            <td style="width:16%">
                <?php echo "GASOLINA ".$acum_gasolina;?>
            </td>
            <td style="width:37%">
                18056
            </td>
            <td style="width:37%">
                120.803.668
            </td>
        </tr>
    </table>
    </div>
    <br>
    <?php
            $acum_bioacem = 0;
            $acum_gasolina = 0;
            $aux=$aux+1;
        }
    ?>
</page>