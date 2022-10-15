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
	$id_factura= intval($_GET['id_contrato']);
	$sql_count=mysqli_query($con,"select * from contrato where id_contrato='".$id_contrato."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Contrato no encontrado')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_contrato=mysqli_query($con,"select * from contrato where id_contrato='".$id_contrato."'");
	$rw_factura=mysqli_fetch_array($sql_contrato);
	$numero_factura=$rw_factura['numcontrato'];
	$id_cliente=$rw_factura['id_cliente'];
	$id_vendedor=$rw_factura['id_vendedor'];
	$fecha_factura=$rw_factura['fecha_crea'];
	$condiciones=$rw_factura['descripcion'];
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/ver_contrato_html.php');
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
        $html2pdf->Output('Contrato.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
