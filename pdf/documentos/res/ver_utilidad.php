<style type="text/css">
    <!--
    table { vertical-align: top; }
    tr    { vertical-align: top; }
    td    { vertical-align: top; }
    .seccion1{
        padding: 4px 4px 4px;
        color:Black;
        font-weight:bold;
        font-size:14px;
        border-color: black white;
        border-width: 1px 0px;
        border-style: solid solid;
    }
    .seccionf{
        padding: 4px 4px 4px;
        color:Black;
        font-size:14px;
        border-color: black;
        border-width: 0px;
        border-bottom: solid;
    }
    .seccion2{
        padding: 4px;
        color:Black;
        font-weight:bold;
        font-size: 8px;
    }
    .zona_frontera{
        text-align: center;
        padding: 4px 2px 2px;
        font-size: 11;
        background: #008000;
        border-color: black;
        border-width: 0.9px;
        border-style: solid;
    }
    .nacional{
        text-align: center;
        padding: 4px 2px 2px;
        font-size: 11;
        background: #99cc00;
        border-color: black;
        border-width: 0.9px;
        border-style: solid;
    }
    .total_consumo{
        text-align: center;
        padding: 4px 2px 2px;
        font-size: 11;
        background: #ff0;
        border-color: black;
        border-width: 0.9px;
        border-style: solid;
    }
    .seccion3{
        padding: 4px 4px 4px;
        color:Black;
        font-weight:bold;
        font-size:12px;
    }
    .parte1{
        text-align: center;
        padding: 9px 1px 5px;
        font-size: 7;
        background: #008000;
        border-color: black;
        border-width: 0.9px;
        border-style: solid;
    }
    .parte2{
        display:grid;
        text-align: center;
        padding: 6px 1px 3px;
        font-size: 6;
        background: #ff99cc;
        border-color: black;
        border-width: 0.9px;
        border-style: solid;
    }
    .parte3{
        display:grid;
        text-align: center;
        padding: 6px 1px 3px;
        font-size: 6;
        background: #fc0;
        border-color: black;
        border-width: 0.9px;
        border-style: solid;
    }
    .parte4{
        display:grid;
        text-align: center;
        padding: 4px 1px 2px;
        font-size: 7;
        background: #9c0;
        border-color: black;
        border-width: 0.9px;
        border-style: solid;
    }
    .parte5{
        display:flex;
        text-align: center;
        padding: 4px 1px 2px;
        font-size: 7;
        background: #ffffcc;
        border-color: black;
        border-width: 0.9px;
        border-style: solid;
    }
    .parte6{
        display:flex;
        text-align: center;
        padding: 4px 1px 2px;
        font-size: 7;
        background: #faebf7;
        border-color: black;
        border-width: 0.9px;
        border-style: solid;
    }
    .seccion4{
        padding: 4px 4px 4px;
        color:Black;
        font-weight:bold;
        font-size:16px;
        border-color: black white;
        border-width: 0.8px 0px;
        border-style: solid solid;
    }
    .seccion5{
        padding: 4px 4px 4px;
        color:Black;
        font-weight:bold;
        font-size:16px;
        border-color: black white;
        border-width: 0.8px 0px;
        border-style: solid solid;
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

<page orientation="landscape" backtop="4mm" backbottom="4mm" backleft="4mm" backright="4mm" style="font-size: 12pt; font-family: arial" >
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
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444; " >
                <br>
                
            </td>
			<td style="width: 50%; color: #000 ;font-size:12px;text-align:center">
                <span style="color: #000;font-size:14px;font-weight:bold">
                    VENTAS POR CUPO CRÉDITO - VENTAS - UTILIDAD
				</span>
				<br>Analisis del Mes : <?php echo $mes." - ".$año; ?><br>
				
                
            </td>
			<td style="width: 25%;text-align:right">
			
			</td>
			
        </tr>
    </table>
    <br>

    <?php
    $aux_sal=0;
        $sql_cliente=mysqli_query($con,"SELECT id_cliente, nombre_cliente, id_municipio, cupo FROM clientes WHERE status_cliente = 1 ORDER BY id_municipio, nombre_cliente");
        while ($row=mysqli_fetch_array($sql_cliente)){
            $id_cliente=$row["id_cliente"];
            $nombre=$row["nombre_cliente"];
            $id_mun=$row["id_municipio"];
            $cupo=number_format($row["cupo"]);
            $sql_depar= mysqli_fetch_array(mysqli_query($con,"SELECT nombre FROM municipios WHERE id=$id_mun"));
            $aux_sal++;
            if($aux_sal==5){
                echo "<br><br>";
            }
            
    ?>
        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
            <tr>
            <td style="width:100%;" class='seccion1'>
                    ESTACION: <?php echo strtoupper($sql_depar[0])." - ".$nombre;?>
            </td>
            </tr>
        </table>
        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
            <tr>
            <td style="width:14%;" class='seccion2'>
                    (ESTACION DE SERVICIO)
            </td>
            <td style="width:25%;" class='seccion2'>
                    <div class='zona_frontera'>ZONA FRONTERA</div> 
            </td>
            <td style="width:20%;" class='seccion2'>
                    <div class='nacional'>NACIONAL</div> 
            </td>
            <td style="width:21%;" class='seccion2'>
                    <div class='total_consumo'>TOTAL CONSUMIDO</div>
            </td>
            <td style="width:21%;" class='seccion2'>
                    
            </td>
            </tr>
        </table>
        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">   
            <tr>
            <td style="width:14%;" class='seccion3'>
                    PERIODO
            </td>

            <td style="width:6%;" class='seccion3'>
                    <div class='parte1'>CUPO TOTAL SICOM</div> 
            </td>
            <td style="width:6%;" class='seccion3'>
                    <div class='parte2'>GALONAJE MES COMPRADO BIODIESEL</div> 
            </td>
            <td style="width:7%;" class='seccion3'>
                    <div class='parte3'>GALONAJE MES COMPRADO GASO. NAL.</div>
            </td>
            <td style="width:6%;" class='seccion3'>
                    <div class='parte4'>TOTAL ZONA FRONTERA DESPACHADO</div>
            </td>

            <td style="width:6%;" class='seccion3'>
                    <div class='parte2' style="font-size:8; padding-bottom:5px;">CUPO MES BIODIESEL</div>
            </td>
            <td style="width:7%;" class='seccion3'>
                    <div class='parte3' style="font-size:6;">CUPO MES GASOLINA NACIONAL</div>
            </td>
            <td style="width:7%;" class='seccion3'>
                    <div class='parte4'>TOTAL NACIONAL DESPACHAD</div>
            </td>

            <td style="width:7%;" class='seccion3'>
                    <div class='parte6'>TOTAL ZONA FRONTERA DESPACHADO</div>
            </td>
            <td style="width:7%;" class='seccion3'>
                    <div class='parte5'>TOTAL ZONA FRONTERA DESPACHADO</div>
            </td>
            <td style="width:7%;" class='seccion3'>
                    <div class='parte1' style="padding: 3px 1px 3px;">TOTAL ZONA FRONTERA DESPACHADO</div>
            </td>

            <td style="width:6%;" class='seccion3'>
                    <div class='parte2' style="font-size:10; padding: 9px 2px">DESC.</div>
            </td>
            <td style="width:7%;" class='seccion3'>
                    <div class='parte3' style="font-size:10; padding:9px 2px">MARGEN</div>
            </td>
            <td style="width:7%;" class='seccion3'>
                    <div class='parte4' style="font-size:9; padding:9px 1px">EXCEDENTE</div>
            </td>
            </tr>
        </table>
        <table cellspacing="0" style="width: 100%; font-size: 11pt;">
            <tr style="text-align: right; vertical-align:bottom">
            <td style="width:14%; text-align: left;" class='seccion1'>
                    mes<?php //aca ira la variable del mes?>
            </td>

            <td style="width:6%; font-size:9px; font-weight: normal;" class='seccion1'>
                    <?php echo $cupo;?>
            </td>
            <td style="width:6%; font-size:9px; font-weight: normal;" class='seccion1'>
                    0
            </td>
            <td style="width:7%; font-size:9px; font-weight: normal;" class='seccion1'>
                    0
            </td>
            <td style="width:6%; font-size:9px; font-weight: normal;" class='seccion1'>
                    0
            </td>

            <td style="width:6%; font-size:9px; font-weight: normal;" class='seccion1'>
                    0
            </td>
            <td style="width:7%; font-size:9px; font-weight: normal;" class='seccion1'>
                    0
            </td>
            <td style="width:7%; font-size:9px; font-weight: normal;" class='seccion1'>
                    0
            </td>

            <td style="width:7%; font-size:9px; font-weight: normal;" class='seccion1'>
                    0
            </td>
            <td style="width:7%; font-size:9px; font-weight: normal;" class='seccion1'>
                    0
            </td>
            <td style="width:7%; font-size:9px; font-weight: normal;" class='seccion1'>
                0
            </td>
                    
            <td style="width:6%; font-size:9px; font-weight: normal;" class='seccion1'>
                0
            </td>
            <td style="width:7%; font-size:9px; font-weight: normal;" class='seccion1'>
                    0
            </td>
            <td style="width:7%; font-size:9px; font-weight: normal;" class='seccion1'>
                    0
            </td>
            </tr>
            

        </table>
        <table cellspacing="0" style="width: 100%; font-size: 11pt;">
            <tr style="text-align: right; vertical-align:bottom">
            <td style="width:14%; text-align: left; font-weight: bold; font-size:10px" class='seccionf'>
                    TOTALES
            </td>

            <td style="width:6%; font-size:9px;" class='seccionf'>
                    
            </td>
            <td style="width:6%; font-size:9px;" class='seccionf'>
                    0
            </td>
            <td style="width:7%; font-size:9px;" class='seccionf'>
                    0
            </td>
            <td style="width:6%; font-size:9px;" class='seccionf'>
                    0
            </td>

            <td style="width:6%; font-size:9px;" class='seccionf'>
                    0
            </td>
            <td style="width:7%; font-size:9px;" class='seccionf'>
                    0
            </td>
            <td style="width:7%; font-size:9px;" class='seccionf'>
                    0
            </td>

            <td style="width:7%; font-size:9px;" class='seccionf'>
                    0
            </td>
            <td style="width:7%; font-size:9px;" class='seccionf'>
                    0
            </td>
            <td style="width:7%; font-size:9px;" class='seccionf'>
                0
            </td>
                    
            <td style="width:6%; font-size:9px;" class='seccionf'>
                0
            </td>
            <td style="width:7%; font-size:9px;" class='seccionf'>
                    0
            </td>
            <td style="width:7%; font-size:9px;" class='seccionf'>
                    0
            </td>
            </tr>
            

        </table>
        <br>
    <?php 
        }
    ?>
</page>

	
