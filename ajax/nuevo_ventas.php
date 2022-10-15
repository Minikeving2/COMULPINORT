<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();


/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

mysqli_query($con,"SET NAMES 'utf8'");

$archivo = $_FILES['archivo'];
if ($archivo['name']==""){
	echo json_encode("<script>alert('No hay ninguno archivo cargado')</script>");
	exit;
}
$name = $archivo['name'];
$ruta = $_FILES['archivo']['tmp_name'];
$destino = "../tmp/".$name;
		
if (copy(utf8_decode($ruta), $destino)) {
 	
    $file = fopen($destino , "r+");
    $consultas="";
    $linea=0;
    $id_cliente="";
    $umm="";
    foreach(file($destino) as $line) {
            $lin = utf8_encode(substr($line, 0, -3));
            $partes = explode(",", $lin);
            $sql="INSERT INTO ventas VALUES (";
            $columna = count($partes);
            $aux=1;
            
            //al utilizar el explode dividiv el renglon delimitado por comas y lo recorro pedazo por peadzo con el foraech
            foreach ($partes as $partes => $value) {
            //verifico si es la ultima columna para colocar el parentesis final con el punto y coma
               if ($aux==$columna){
                //le quito los espacion en blanco de pedazo 
                    $value=trim($value);
                    if($value=="'"){
                        $umm .= $nit_aux."---";
                        $cod=mysqli_query($con, "SELECT id_cliente FROM clientes WHERE nit=$nit_aux");
                    }else {
                         $cod=mysqli_query($con, "SELECT id_cliente FROM clientes WHERE codigo_sicom=$value'");
                    }
                   
                   
                    $cod_cliente=mysqli_fetch_array($cod);
                    if ($cod_cliente[0]==""){
                        $id_cliente="null";
                    } else {
                        $id_cliente=$cod_cliente[0];
                    }

                    if ($value!=""){
                        $sql .= $value."',$id_cliente);";
                    } else {
                        $value='null';
                        $sql .= $value.",$id_cliente);";
                    }
                    $datos[$aux]=$value;
                    
               } else {
                if ($aux==2){;
                    $fecha = explode("/", rtrim(ltrim($value,"'"),"'"));
                    $fecha= trim($fecha[2])."-".trim($fecha[1])."-".trim($fecha[0]);
                    $value="'".$fecha."'"; 
                    
                }
                if ($aux==3){;
                    $nit_aux=$value;
                    
                }
                $sql .= "".$value.",";
                
                $datos[$aux]=$value;
                $aux++;
               }
            }
            $fechass = explode("-", rtrim(ltrim($datos[2],"'"),"'"));
            $fechass= trim($fechass[0])."-".trim($fechass[1])."-".trim($fechass[2]);
            $comparacion = "SELECT count(*) AS numrows FROM ventas WHERE CONCATENATION = $datos[1] AND FECHA = '".$fechass."' AND NIT = $datos[3] AND CODMAT = $datos[5] AND CANLISTA = $datos[7] AND PARCVTA = $datos[8] AND SICOM = $datos[10]';";
            $asd = mysqli_query($con, $comparacion);
            $fgh = mysqli_fetch_array($asd);
            if($fgh[0]>0){} else {
                mysqli_query($con,$sql);
            }
            $sql=""; 
        }
        $linea=$linea+1;
    
    fclose($file);
    unlink("../tmp/$name");
    
    $proceso = "INSERTAR";
    $descripcion = "PLANO";
    $id_usuario = $_SESSION['user_id'];
    $nombre = $_SESSION['user_name'];
    include ("nueva_auditoria.php");
    
    echo json_encode('<script>console.log("'.$umm.'")</script>');
    
} else {
	echo json_encode('<script>alert("El tipo de archivo no es valido") </script>');
	exit;
}
?>

