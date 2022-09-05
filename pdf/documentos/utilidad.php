<?php 
include("../../config/db.php");
include("../../config/conexion.php");
//importacion de la libreria de html2pdf
require_once(dirname(__FILE__).'/../html2pdf.class.php');

$nose=$_POST['datosss'];
$titulo="VENTAS POR CUPO CRÉDITO - VENTAS - UTILIDAD";
$mes= "Julio";
$año = "2022";
ob_start();
include(dirname('__FILE__').'/res/ver_utilidad.php');
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
   $html2pdf->Output('Utilidad.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>