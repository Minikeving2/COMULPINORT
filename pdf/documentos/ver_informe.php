<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
    }
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
    $id_factura=1;
	$nombre=$_GET['q'];
    $fecha_inicio=$_GET['date_s'];
    $fecha_fin=$_GET['date_e'];
    $tipo_informe=$_GET['tipo'];
if ($tipo_informe==1){
    $sql_count=mysqli_query($con,"SELECT count(*) AS numrows FROM clientes, facturas, detalle_factura, products WHERE clientes.nombre_cliente like '%$nombre%' and clientes.id_cliente = facturas.id_cliente and facturas.id_factura = detalle_factura.id_factura and detalle_factura.id_producto = products.id_producto and facturas.fecha_factura >= '$fecha_inicio' and facturas.fecha_factura <= '$fecha_fin'");
	$row=mysqli_fetch_array($sql_count);
    $numrows = $row['numrows'];
	
	$sql_informe=mysqli_query($con,"SELECT id_cliente FROM clientes WHERE nombre_cliente like '%$nombre%'");
	$rw_factura=mysqli_fetch_array($sql_informe);
	$id_cliente=$rw_factura['id_cliente'];
    $nombre_busqueda=$nombre;
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/ver_informe_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Informe.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
} else if ($tipo_informe==2) {
    $sql_count=mysqli_query($con,"SELECT count(*) AS numrows FROM clientes, contrato WHERE clientes.nombre_cliente like '%$nombre%' and clientes.id_cliente = contrato.id_cliente and contrato.fecha_crea >= '$fecha_inicio' and contrato.fecha_crea <= '$fecha_fin'");
	$row=mysqli_fetch_array($sql_count);
    $numrows = $row['numrows'];
	if ($numrows==0){  
	    echo "<script>alert('Informe no encontradoss')</script>";
	    echo "<script>window.close();</script>";
    exit;
	}
	$sql_informe=mysqli_query($con,"SELECT id_cliente FROM clientes WHERE nombre_cliente like '%$nombre%'");
	$rw_factura=mysqli_fetch_array($sql_informe);
	$id_cliente=$rw_factura['id_cliente'];
    $nombre_busqueda=$nombre;
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/ver_informe_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Informe.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

}