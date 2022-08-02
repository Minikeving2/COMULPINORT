<?php 
include("../../config/db.php");
//importacion de la libreria de html2pdf
require_once(dirname(__FILE__).'/../html2pdf.class.php');
$imagen1=$_POST['imagen_1'];
$imagen2=$_POST['imagen_2'];
$imagen3=$_POST['imagen_3'];
$imagen4=$_POST['imagen_4'];
$año=$_POST['year'];
ob_start();
include(dirname('__FILE__').'/res/ver_grafico_html.php');
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
   $html2pdf->Output('Grafico.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>