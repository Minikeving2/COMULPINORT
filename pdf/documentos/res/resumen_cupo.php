<style type="text/css">
    <!--
    table { vertical-align: center; }
    tr    { vertical-align: center; }
    td    { vertical-align: center; }
    .seccion1{
        border: 1px solid black;
        border-bottom: none; 
        padding: 4px 4px 4px;
        color:Black;
        font-weight:bold;
        font-size:14px;
        border-width: 1px;
        background: #FFFF00;
    }
    .seccion2{
        border: 1px solid black;
        vertical-align: center;
        padding: 4px 4px 4px;
        color:Black;
        font-size:11px;
        background: #92D050;
        border-bottom: none; 
    }
    .contenido{
        border: 1px solid black;
        border-bottom: none;
    }
    .total{
        border: 1px solid black;
        background: #92D050;
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

<page backtop="7mm" backbottom="7mm" backleft="4mm" backright="4mm" style="font-size: 12pt; font-family: arial" >
    <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo  "2022"; ?>
                </td>
            </tr>
        </table>
    </page_footer>

    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444; " >
                <img style="width: 50%;" src="../../img/largo.png" alt="Logo"><br>
            </td>
			<td style="width: 50%; color: #000 ;font-size:12px;text-align:center">
                <span style="color: #000;font-size:14px;font-weight:bold"><?php echo NOMBRE_EMPRESA;?></span>
				<br><?php echo DIRECCION_EMPRESA;?><br> 
				Teléfono: <?php echo "(607) 5720321";?><br>
				Nit: <?php echo "900.297.348-7";?>
                
            </td>
			<td style="width: 25%;text-align:right"></td>
			
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444; " >
                <br>
                
            </td>
			<td style="width: 50%; color: #000 ;font-size:12px;text-align:center">
                <span style="color: #000;font-size:14px;font-weight:bold">
                    <?php 
                    $sql_depar = mysqli_fetch_array(mysqli_query($con,"SELECT nombre FROM municipios WHERE id=".$id_mun));
                    echo $titulo." ".strtoupper($sql_depar[0]);?>
				</span>
                <br>
                <br>
                
            </td>
			<td style="width: 25%;text-align:right">
			
			</td>
			
        </tr>
    </table>
    
    

    <?php
        $aux=0;
        $sql_estacion=mysqli_query($con,"SELECT nombre_cliente, id_cliente FROM clientes WHERE id_municipio = $id_mun");
        while ($row=mysqli_fetch_array($sql_estacion)){
            $id_cliente=$row["id_cliente"];
            $nombre_estacion =$row["nombre_cliente"];
            if ($aux==1){
                echo "<br><br>";
            }
            if ($aux==2){
                echo "<br><br>";
            }
            if ($aux==3) {
              ?> 
              <br>
              <table cellspacing="0" style="width: 100%;">
                <tr>
        
                    <td style="width: 25%; color: #444444; " >
                        <img style="width: 50%;" src="../../img/largo.png" alt="Logo"><br>
                    </td>
                    <td style="width: 50%; color: #000 ;font-size:12px;text-align:center">
                        <span style="color: #000;font-size:14px;font-weight:bold"><?php echo NOMBRE_EMPRESA;?></span>
                        <br><?php echo DIRECCION_EMPRESA;?><br> 
                        Teléfono: <?php echo "(607) 5720321";?><br>
                        Nit: <?php echo "900.297.348-7";?>
                        
                    </td>
                    <td style="width: 25%;text-align:right"></td>
                    
                </tr>
                </table>
                <br>
                <table cellspacing="0" style="width: 100%;">
                    <tr>
            
                        <td style="width: 25%; color: #444444; " >
                            <br>
                            
                        </td>
                        <td style="width: 50%; color: #000 ;font-size:12px;text-align:center">
                            <span style="color: #000;font-size:14px;font-weight:bold">
                                <?php 
                                $sql_depar = mysqli_fetch_array(mysqli_query($con,"SELECT nombre FROM municipios WHERE id=".$id_mun));
                                echo $titulo." ".strtoupper($sql_depar[0]);?>
                            </span>
                            <br>
                            <br>
                            
                        </td>
                        <td style="width: 25%;text-align:right">
                        
                        </td>
                        
                    </tr>
                </table><?php
                $aux=0;
            }
            $aux++;

            $acum_cupo_mes=0;
            $acum_cupo_zf=0;
            $acum_cupo_por=0;
            $acum_cupo_sal=0;
            $acum_cupo_nal=0;
            $acum_exc=0;
    ?>
        
        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 11pt;" class='seccion1'>
            <tr>
                <td style="width:100%;">
                        <?php echo $nombre_estacion;?>
                </td>
            </tr>
        </table>
        
        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 10px;" class="">
            <thead>
                <tr>
                    <td style="width:10%;" class='seccion2'>
                            MES
                    </td>
                    <td style="width:30%;" class='seccion2'>
                            EDS 
                    </td>
                    <td style="width:10%;" class='seccion2'>
                        CUPO ASIGNADO 
                    </td>
                    <td style="width:10%;" class='seccion2'>
                            CUPO CONSUMIDO
                    </td>
                    <td style="width:10%;" class='seccion2'>
                        % CUPO CONSUMIDO 
                    </td>
                    <td style="width:10%;" class='seccion2'>
                        SALDO CUPO GLS
                    </td>
                    <td style="width:10%;" class='seccion2'>
                        CUPO EXTRA CONSUMIDO
                    </td>
                    <td style="width:10%;" class='seccion2'>
                        GENERA EXCEDENTES MENSUAL
                    </td>
                </tr>
            </thead>
            <tbody>
            <?php
            $meses=["","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];
            for ($i=1; $i < 13 ; $i++) {
                $sql_datos = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM cupo WHERE ID_TERCERO = $id_cliente AND YEAR = $year AND MES = $i"));

                    if ($sql_datos[5] == null && $sql_datos[6] == null){
                        $cupo_porcentaje=0;
                        $cupo_sal="";
                    } else {
                        if ($sql_datos[5] == 0 && $sql_datos[6] == 0){
                            
                        }else{
                            $acum_cupo_mes=$acum_cupo_mes+intval($sql_datos[5]);
                            $acum_cupo_zf=$acum_cupo_zf+intval($sql_datos[6]);
                            $cupo_sal=$sql_datos[5]-$sql_datos[6];
                            $cupo_porcentaje=round(($sql_datos[6]/$sql_datos[5])*100);
                            $acum_cupo_sal=$acum_cupo_sal+intval($cupo_sal);
                            $sql_datos[5];
                            $sql_datos[6];
                        }
                    }

                    if ($sql_datos[7] == null && $sql_datos[6] == null){
                        $cupo_exc="";
                    } else {
                        if ($i>=6){
                            $valor=244.171;
                        }else{
                            $valor=223.5381;
                        }
                        $cupo_exc=round(($sql_datos[6]+$sql_datos[7])*$valor);
                        $acum_exc=$acum_exc+intval($cupo_exc);
                    }

                    if ($sql_datos[7] == null){
                        $sql_datos[7] = "";
                    }else{
                        $acum_cupo_nal=$acum_cupo_nal+intval($sql_datos[7]);
                    }
                    




                    
            ?>
                <tr>
                    <td style="width:10%;" class='contenido'>
                        <?php echo $meses[$i]?>
                    </td>
                    <td style="width:30%;" class='contenido'>
                        <?php echo substr($nombre_estacion,0,30).".."; ?>
                    </td>
                    <td style="width:10%;" class='contenido'>
                        <?php echo number_format($sql_datos[5]); ?>
                    </td>
                    <td style="width:10%;" class='contenido'>
                        <?php echo number_format($sql_datos[6]);?>
                    </td>
                    <td style="width:10%;" class='contenido'>
                        <?php if($cupo_porcentaje==0){}else{ echo $cupo_porcentaje."%";}?>
                    </td>
                    <td style="width:10%;" class='contenido'>
                        <?php echo number_format($cupo_sal);?>
                    </td>
                    <td style="width:10%;" class='contenido'>
                        <?php echo number_format($sql_datos[7]);?>
                    </td>
                    <td style="width:10%;" class='contenido'>
                        <?php echo number_format($cupo_exc);?>
                    </td>
                </tr>

            <?php 
                }
            
            ?>
            </tbody>
        </table>
        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 11px;" class="">
            <tr>
                <td style="width:40%;" class='total'>
                    TOTAL
                </td>
                <td style="width:10%;" class='total'>
                    <?php echo number_format($acum_cupo_mes);?>
                </td>
                <td style="width:10%;" class='total'>
                    <?php echo number_format($acum_cupo_zf); ?>
                </td>
                <td style="width:10%;" class='total'>
                    <?php if($acum_cupo_mes == 0 && $acum_cupo_zf == 0){} else {echo round(($acum_cupo_zf/$acum_cupo_mes)*100)."%";}?>
                </td>
                <td style="width:10%;" class='total'>
                    <?php echo number_format($acum_cupo_sal)?>
                </td>
                <td style="width:10%;" class='total'>
                    <?php echo number_format($acum_cupo_nal);?>
                </td>
                <td style="width:10%;" class='total'>
                    <?php echo number_format($acum_exc);?>
                </td>
            </tr>
        </table>
        
    <?php
        }
   
    ?>
</page>