<?php
function bitacora($codigoObjeto, $accion,$descripcion){
include 'conexion.php';
//se obtiene el codigo del usuario
$id_usuario =$_SESSION['id_usuario'];

$d=strtotime("today");
date("Y-m-d h:i:sa", $d);


$sql="INSERT INTO tbl_bitacora(fecha,id_usuario,id_objeto,accion,descripcion)
                        VALUES(CURTIME(),$id_usuario,$codigoObjeto,'$accion','$descripcion')";

    $ejecuta=mysqli_query($conexion, $sql);

}


?>