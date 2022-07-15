<?php 
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

$file = fopen("4.txt", "r+");
$consultas="";
$linea=0;
$aver="4.txt";
foreach(file($aver) as $line) {
    
  
    if ($linea==0){

    } else {
        $lin = utf8_encode(substr($line, 0, -3));
        $partes = explode(",", $lin);
        $sql="INSERT INTO ventas VALUES (";
        $columna = count($partes);
        $aux=1;
        foreach ($partes as $partes => $value) {
           if ($aux==$columna){
                $value=trim($value);
                if ($value!=""){
                    $sql .= "'".$value."');";
                } else {
                    $value='null';
                    $sql .= $value.");";
                }
                $datos[$aux]=$value;
                
           } else {
            if ($aux==2){;
                $fecha = explode("/", $value);
                $fecha= trim($fecha[1])."/".trim($fecha[0])."/".trim($fecha[2]);
                $fecha= trim($fecha);
                $value=date("Y-m-d", strtotime($fecha)); 
                
             }
            if ($aux==3){
                $cod=mysqli_query($con, "SELECT id_cliente FROM clientes WHERE nit='$value'");
                $cod_cliente=mysqli_fetch_array($cod);
                $value=$cod_cliente[0];
            }
            if($aux==4){

            } else {
            $sql .= "'".$value."',";
            }
            $datos[$aux]=$value;
            $aux++;
           
            
           }
           
        }
        $comparacion=mysqli_query($con, "SELECT * FROM ventas WHERE CONCATENATION = '$datos[1]' AND FECHA = '".date("Y-m-d", strtotime($datos[2]))."' AND ID_CLIENTE = '$datos[3]' AND CODMAT = '$datos[5]'");        
        $a= mysqli_fetch_array($comparacion);
        if ($a){
        } else {
            mysqli_query($con,$sql);
        }
        $sql=""; 
    }
    $linea=$linea+1;
} 
echo "archivo leido<br>";/* 

?>