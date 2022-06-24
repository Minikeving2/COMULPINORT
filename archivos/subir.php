<?php
session_start();
if (isset($_SESSION['username'])) {

}else{
  echo "<script type=\"text/javascript\">alert(\"No Tiene Acceso, inicie sesion\");window.location.href='../../index.php';</script>";
}

include_once '../config.inc.php';
if (isset($_POST['subir'])) {
    $nombre = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $tamanio = $_FILES['archivo']['size'];
    $ruta = $_FILES['archivo']['tmp_name'];
    $destino = "archivos/" . $nombre;
    if ($nombre != "") {
        if (copy($ruta, $destino)) {
            $ano= 2009;
            $titulo= $_POST['titulo'];
            $descri= $_POST['descripcion'];
            $db=new Conect_MySql();
            $sql = "INSERT INTO actasasamblea(ano,titulo,descripcion,tamanio,tipo,nombre_archivo) VALUES('$ano','$titulo','$descri','$tamanio','$tipo','$nombre')";
            $query = $db->execute($sql);
            if($query){
                echo "<script>
                        alert('Se Subio Correctamente');
                      </script>";
            }
        } else {
            echo "Error";
        }
    }
}
?>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <link rel="stylesheet" href="../../css/subir.css">
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="shortcut icon" href="img/coo.png">
  <title>Subir pdf</title>
</head>

<body style=" background: rgba(83, 205, 117, 0.53); text-align: center; ">
  <div class="box">
    <a class="title">Subir PDF</a><br>
    <form method="post" action="" enctype="multipart/form-data">
      <table>
        <div class="form-group">
          <input required="" type="text" name="titulo" class="form-control" placeholder="Titulo">
        </div>
        <div class="form-group">
          <input required="" name="descripcion" type="text" class="form-control" placeholder="Descripcion">
        </div>
        <div class="form-group">
          <input type="file" name="archivo" accept="application/pdf" class="form-control-file">
        </div>

        <button type="submit" value="subir" name="subir" class=" bt btn btn-primary">Subir</button>
        <a href="2009.php" class=" bt2 btn ">Volver</a>
      </table>
    </form>


  </div>
</body>
<link href="../../js/jquery-3.3.1.min.js">
<link href="../../js/popper.js">
<link href="../../js/bootstrap.min.js">

</html>
