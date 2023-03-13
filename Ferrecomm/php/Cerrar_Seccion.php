<?php
INCLUDE 'conexion.php';
session_start();

$user = $_SESSION['usuario']['user'];

 date_default_timezone_set('America/Mexico_City');
 $fecha_Ultima_conexion = date("Y-m-d H:i:s");

$queri = "UPDATE tbl_ms_usuario
SET fecha_ultima_conexion = '$fecha_Ultima_conexion' 
where usuario = '$user' ";

$EJECUTAR = mysqli_query($conexion, $queri);

mysqli_close($conexion);

session_destroy();
header("location: ../index.php")



?>