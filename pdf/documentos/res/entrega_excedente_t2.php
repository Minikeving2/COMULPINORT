<style type="text/css">
<!--
.estacion{
    font-size: 10px;
    padding: 4px 4px 4px;
    color:Black;
    font-weight: bold;

    border: 1px solid black;
    border-bottom: none;
    background: #80ff00;
    
    
    text-align: center;
}
.titulos{
    font-size: 10px;
    color:Black;
    font-weight: bold;
    border: 1px solid black;
    border-bottom: none;
    text-align: center;
    background: #c4d79b;
}  
.union{
    font-size: 10px;
    padding: 4px 4px 4px;
    color:Black;
    font-weight: bold;

    border: 1px solid black;
    border-bottom: none;
    border-top: none;
    background: #ffff00;
    
    
    text-align: center;
}  
.celdas{
	font-size:8px;
    padding: 4px 4px 4px;
	color:Black;
	font-weight:bold;
    border: 1px solid black;;
    border-bottom: none;
    
    
    text-align: center;
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
<page backtop="2mm" backbottom="2mm" backleft="2mm" backright="2mm" style="font-size: 12pt; font-family: arial" >
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
                <?php  $sql_depar = mysqli_fetch_array(mysqli_query($con,"SELECT nombre FROM municipios WHERE id=".$mun)); 
                    echo "ENTREGA A E.D.S VS EXCEDENTES DEL MUNICIPIO DE ".strtoupper($sql_depar[0]);
                ?>
				</span>
            </td>
			<td style="width: 25%;text-align:right">
			</td>
        </tr>
    </table>
    <br>


        <?php 
        $acum1=0;
        $acum2=0;
        $acum3=0;
        $acum4=0;
        $acum6=0;
        $acum7=0;
        $acum8=0;
        $acum5=0;
        $acum_exc=0;
        $acum_exc_mun=0;
        $acum_diferencia=0;
        
        $sql_umm=mysqli_query($con,"SELECT c.id_cliente, c.nombre_cliente, c.id_municipio, sum(if(tipo_mov = 1, total_venta, 0)) Equipos, sum(if(tipo_mov = 2, total_venta, 0)) Publicidad, sum(if(tipo_mov = 3, total_venta, 0)) Letreroprecios, sum(if(tipo_mov = 4, total_venta, 0)) AE_arreglos_locativos, sum(if(tipo_mov = 5, total_venta, 0)) AE_Transaccion, sum(if(tipo_mov = 6, total_venta, 0)) AE_Efectivo, sum(if(tipo_mov = 7, total_venta, 0)) AE_Crucecart, sum(if(tipo_mov = 8, total_venta, 0)) CR_Transaccion, sum(if(tipo_mov = 9, total_venta, 0)) CR_CruceCart, sum(if(tipo_mov = 10, total_venta, 0)) Cupo_Credito, sum(if(tipo_mov = 11, total_venta, 0)) Prestamos, sum(if(tipo_mov = 12, total_venta, 0)) Poliza_SURA, sum(if(tipo_mov = 13, total_venta, 0)) Descuentos_Gasol, sum(if(tipo_mov = 14, total_venta, 0)) Mejoras_EDS, sum(total_venta) total FROM clientes c LEFT JOIN facturas f on(f.id_cliente = c.id_cliente) group by c.nombre_cliente");
        while ($row=mysqli_fetch_array($sql_umm)){
            $db_mun=$row["id_municipio"];
            if ($mun==$db_mun){
                
                //los convierto en valores numeros para asi poderlos manipular
                $Equipos=intval($row["Equipos"]);
                $Publicidad=intval($row['Publicidad']);
                $Letreroprecios=intval($row['Letreroprecios']);
                $apoyo1=intval($row["AE_arreglos_locativos"]);
                $apoyo2=intval($row["AE_Transaccion"]);
                $apoyo3=intval($row["AE_Efectivo"]);
                $apoyo4=intval($row["AE_Crucecart"]);
                $cupo=intval($row["Cupo_Credito"]);
                $credito1=intval($row["CR_Transaccion"]);
                $credito2=intval($row["CR_CruceCart"]);
                $prestamo=intval($row["Prestamos"]);
                $sura=intval($row["Poliza_SURA"]);
                $descuento=intval($row["Descuentos_Gasol"]);
                $mejoras=intval($row["Mejoras_EDS"]);
                $total=intval($row["total"]);
                $nombre_cliente=$row["nombre_cliente"];
                $id_cliente = $row["id_cliente"];

                $acum_exc_mun=0;
                for ($i=1; $i < 13 ; $i++) {
                    $sql_datos = mysqli_fetch_array(mysqli_query($con, "SELECT CUPO_ZF, CUPO_NAL FROM cupo WHERE  ID_TERCERO = $id_cliente AND YEAR = 2022 AND MES = $i"));
                    
                    if(isset($sql_datos[0])){
                        $consumido = intval($sql_datos[0]);
                        
                    } else {
                        $consumido = 0;
                    }
                    if(isset($sql_datos[1])){
                        $extra = intval($sql_datos[1]);
                        
                    } else {
                        $extra = 0;
                    }
                    
                    if ($i>=6){
                        $valor=244.171;
                    }else{
                        $valor=223.5381;
                    }
                    $cupo_exc=round(($consumido+$extra)*$valor);
                    $acum_exc_mun=$acum_exc_mun+intval($cupo_exc);
                }



                //realizao las operaciones de acumunlacion de datos numericos
                $acum1=$acum1+$Equipos;
                $acum2=$acum2+($credito1+$credito2+$prestamo);
                $acum3=$acum3+$apoyo2;
                $acum4=$acum4+$apoyo4;
                $acum5=$acum5+$Publicidad;
                $acum6=$acum6+$Letreroprecios;
                $acum7=$acum7+($mejoras+$descuento+$sura+$apoyo1);
                $acum8=$acum8+$total;
                $acum_exc = $acum_exc + $acum_exc_mun;
                $diferencia = $acum_exc_mun - $total;
                $acum_diferencia = $acum_diferencia + $diferencia;
                
                

                //los muestro con un formato decimal para asi poder visualizarlos mejor ya que añade las comas y puntos
                $Equipos=number_format($row["Equipos"],2);
                $Publicidad=number_format($row['Publicidad'],2);
                $Letreroprecios=number_format($row['Letreroprecios'],2);
                $apoyo1=number_format($row["AE_arreglos_locativos"],2);
                $apoyo2=number_format($row["AE_Transaccion"],2);
                $apoyo3=number_format($row["AE_Efectivo"],2);
                $apoyo4=number_format($row["AE_Crucecart"],2);
                $cupo=number_format($row["Cupo_Credito"],2);
                $otros=number_format(($mejoras+$descuento+$sura+$apoyo1),2);
                $creditos=number_format(($credito1+$credito2+$prestamo),2);
                $total=number_format($row["total"],2);
                $acum_exc_mun=number_format($acum_exc_mun,2);
                if($diferencia<0){
                    $diferencia="(".number_format(abs($diferencia),2).")";
                } else {
                    $diferencia=number_format($diferencia,2);
                }
                
            
              
                    
        ?>
        <div>
        <table cellspacing="0" style="width: 100%; >
            <tr><td style="width: 100%;" class=estacion"><?php echo $nombre_cliente;?></td></tr>
        </table>
        <table cellspacing="0" style="width: 100%; >
            <tr>
                <td style="width: 25%; padding: 4px 4px 4px; background: #92d050;" class=titulos">
                    ACTIVOS COOMULPINORT (ACTAS ENTREGA EQUIPOS)
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    EQUIPOS Y BOMBAS SUMERGIBLES
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $Equipos;?>
                </td>
            </tr>


            <tr>
                <td style="width: 25%; padding: 4px 4px 4px; background: #92d050;" class=titulos">
                    
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    PRESTAMOS O CUENTAS POR COBRAR
                </td>
                <td style="width: 50%;" class=celdas">
                     <?php echo $creditos;?>
                </td>
            </tr>
            <tr>
                <td style="width: 25%; background: #92d050;" class=union">
                    CUENTAS POR COBRAR
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    ABONOS
                </td>
                <td style="width: 50%;" class=celdas">

                </td>
            </tr>
            <tr>
                <td style="width: 25%;  padding: 4px 4px 4px; background: #92d050;" class=union">
                    
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    SALDO PENDIENTE
                </td>
                <td style="width: 50%;" class=celdas">

                </td>
            </tr>
            

            <tr>
                <td style="width: 25%; padding: 4px 4px 4px; background: #92d050;" class=titulos">
                    TRANSACCION BANCARIA
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    APOYO ECONOMICO
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $apoyo2;?>
                </td>
            </tr>


            <tr>
                <td style="width: 25%; padding: 4px 4px 4px; background: #92d050;" class=titulos">
                    CRUCE CON CARTERA (ACTAS)
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    APOYO ECONOMICO
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $apoyo4;?>
                </td>
            </tr>

            <tr>
                <td style="width: 25%; padding: 0px 4px; vertical-align: bottom; background: #92d050;" class=titulos">
                    GASTO PUBLICIDAD(ACTAS DE
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    NUEVA IMAGEN COOMULPINORT
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $Publicidad;?>
                </td>
            </tr>
            <tr>
                <td style="width: 25%; padding: 0px 4px; vertical-align: top; background: #92d050;" class=union">
                    ENTREGA PUBLICIDAD Y FACTURAS DE PUBLICIDAD)
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    INSTALACION DE TORRES DE PRECIOS CON IMAGEN COOMULPINORT
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $Letreroprecios; ?>
                </td>
            </tr>


            <tr>
                <td style="width: 25%; padding: 4px 4px 4px; background: #92d050;" class=titulos">
                    GASTO APOYO ECONOMICO
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    MEJORAMIENTO INSTALACIONES DE LA E.D.S Y OTROS
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $otros; ?>
                </td>
            </tr>   
        </table>
        <table cellspacing="0" style="width: 100%;>
            <tr>
                <td style="width: 50%; padding: 4px 4px 4px; background: #ffff00;" class=titulos">
                     TOTAL ENTREGADO A E.D.S
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $total; ?>
                </td>
            </tr>


            <tr>
                <td style="width: 50%; padding: 4px 4px 4px; background: #ffff00;" class=titulos">
                    EXCEDENTES GENERADOS
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $acum_exc_mun;?>
                </td>
            </tr>


            <tr>
                <td style="width: 50%; padding: 4px 4px 4px; border-bottom: solid; background: #ffff00;" class=titulos">
                    DIFERENCIA TOTAL EXCEDENTES GENERADOS Y TOTAL ENTREGADO A E.D.S. EN GASTOS (EXCEDENTES REALES)
                </td>
                <td style="width: 50%; border-bottom: solid;" class=celdas">
                    <?php echo $diferencia;?>
                </td>
            </tr>
        </table>
        </div>
        <br>
        <?php }
        } 
        $diferencia = $acum_exc - $acum8;
        $acum1=number_format($acum1,2);
        $acum2=number_format($acum2,2);
        $acum3=number_format($acum3,2);
        $acum4=number_format($acum4,2);
        $acum5=number_format($acum5,2);
        $acum6=number_format($acum6,2);
        $acum7=number_format($acum7,2);
        $acum8=number_format($acum8,2);
        $acum_exc=number_format($acum_exc,2);
        $diferencia = number_format($diferencia,2);
        
        ?>
        <table cellspacing="0" style="width: 100%; >
            <tr><td style="width: 100%;" class=estacion">TOTAL ENTREGADO A LAS ESTACIONES DEL MUNICIPIO DE <?php echo strtoupper($sql_depar[0]);?> </td></tr>
        </table>
        <table cellspacing="0" style="width: 100%; >
            <tr>
                <td style="width: 25%; padding: 4px 4px 4px; background: #92d050;" class=titulos">
                    ACTIVOS COOMULPINORT (ACTAS ENTREGA EQUIPOS)
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    EQUIPOS Y BOMBAS SUMERGIBLES
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $acum1;?>
                </td>
            </tr>


            <tr>
                <td style="width: 25%; padding: 4px 4px 4px; background: #92d050;" class=titulos">
                    
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    PRESTAMOS O CUENTAS POR COBRAR
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $acum2;?>
                </td>
            </tr>
            <tr>
                <td style="width: 25%; background: #92d050;" class=union">
                    CUENTAS POR COBRAR
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    ABONOS
                </td>
                <td style="width: 50%;" class=celdas">

                </td>
            </tr>
            <tr>
                <td style="width: 25%;  padding: 4px 4px 4px; background: #92d050;" class=union">
                    
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    SALDO PENDIENTE
                </td>
                <td style="width: 50%;" class=celdas">

                </td>
            </tr>
            

            <tr>
                <td style="width: 25%; padding: 4px 4px 4px; background: #92d050;" class=titulos">
                    TRANSACCION BANCARIA
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    APOYO ECONOMICO
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $acum3;?>
                </td>
            </tr>


            <tr>
                <td style="width: 25%; padding: 4px 4px 4px; background: #92d050;" class=titulos">
                    CRUCE CON CARTERA (ACTAS)
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    APOYO ECONOMICO
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $acum4;?>
                </td>
            </tr>

            <tr>
                <td style="width: 25%; padding: 0px 4px; vertical-align: bottom; background: #92d050;" class=titulos">
                    GASTO PUBLICIDAD(ACTAS DE
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    NUEVA IMAGEN COOMULPINORT
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $acum5;?>
                </td>
            </tr>
            <tr>
                <td style="width: 25%; padding: 0px 4px; vertical-align: top; background: #92d050;" class=union">
                    ENTREGA PUBLICIDAD Y FACTURAS DE PUBLICIDAD)
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    INSTALACION DE TORRES DE PRECIOS CON IMAGEN COOMULPINORT
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $acum6;?>
                </td>
            </tr>


            <tr>
                <td style="width: 25%; padding: 4px 4px 4px; background: #92d050;" class=titulos">
                    GASTO APOYO ECONOMICO
                </td>
                <td style="width: 25%; padding: 4px 4px 4px;" class=titulos">
                    MEJORAMIENTO INSTALACIONES DE LA E.D.S Y OTROS
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $acum7;?>
                </td>
            </tr>   
        </table>
        <table cellspacing="0" style="width: 100%;>
            <tr>
                <td style="width: 50%; padding: 4px 4px 4px; background: #ffff00" class=titulos">
                    TOTAL ENTREGADO A E.D.S
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $acum8;?>
                </td>
            </tr>


            <tr>
                <td style="width: 50%; padding: 4px 4px 4px; background: #ffff00" class=titulos">
                    EXCEDENTES GENERADOS
                </td>
                <td style="width: 50%;" class=celdas">
                    <?php echo $acum_exc;?>
                </td>
            </tr>


            <tr>
                <td style="width: 50%; padding: 4px 4px 4px; border-bottom: solid; background: #ffff00;" class=titulos">
                    DIFERENCIA TOTAL EXCEDENTES GENERADOS Y TOTAL ENTREGADO A E.D.S. EN GASTOS (EXCEDENTES REALES)
                </td>
                <td style="width: 50%; border-bottom: solid;" class=celdas">
                    <?php echo $diferencia;?>
                </td>
            </tr>
        </table>
</page>

