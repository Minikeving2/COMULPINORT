<?php 
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

$file = fopen("plano.txt", "r+");
$consultas="";
$linea=0;
foreach(file('plano.txt') as $line) {
    if ($linea==0){

    } else {
        $partes = explode(",", $line);
        $sql="INSERT INTO pruebas VALUES (";
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
           } else {
            $sql .= "'".$value."',";
            $aux++;
           }
        }
        echo $sql."<br>";
        mysqli_query($con,$sql);
        $sql=""; 
    }
    $linea=$linea+1;
} 
echo "archivo leido<br>"; 
echo $consultas;
fclose($file);
?>