<?php 
include("../../config/db.php");
include("../../config/conexion.php");
//importacion de la libreria de html2pdf
require_once(dirname(__FILE__).'/../html2pdf.class.php');

$id_mun=$_POST['mun'];
$year=$_POST["year"];
$imagen1=$_POST['imagen_1'];
$imagen2=$_POST['imagen_2'];
$imagen3=$_POST['imagen_3'];
$imagen4=$_POST['imagen_4'];

$imagen5=$_POST['imagen_5'];
$imagen6=$_POST['imagen_6'];
$imagen7=$_POST['imagen_7'];
$imagen8=$_POST['imagen_8'];

$imagen9=$_POST['imagen_9'];
$imagen10=$_POST['imagen_10'];
$imagen11=$_POST['imagen_11'];
$imagen12=$_POST['imagen_12'];

$imagenes=["aver",$imagen1,$imagen2,$imagen3,$imagen4,$imagen5,$imagen6,$imagen7,$imagen8,$imagen9,$imagen10,$imagen11,$imagen12];

ob_start();
include(dirname('__FILE__').'/res/grafico_municipio.php');
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
   $html2pdf->Output('Cupo_VS_Consumo_EDS.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>