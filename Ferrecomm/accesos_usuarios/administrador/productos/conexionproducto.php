<?php
//el signo $ se utiliza para poder declarar una variable, se debe colocar al inicio 
//seguido del nombre de la variable 
// compocision de la conexion puerto, ususario,contraseña,nombre de la base de datos
$conexion = mysqli_connect("localhost", "root", "", "ferrecomm_db");


function insertar($conexion,$categoria,$nombre_producto,$descripcion_producto,$precio_producto,$img_productoBLOB,
$unidad_medida,$cantidad_min,$cantidad_max){
    $sql= "INSERT INTO tbl_producto(id_categoria,nombre_producto,descripcion_producto,
    precio_producto,img_producto,unidad_medida,cantidad_min,cantidad_max)
    VALUES('$categoria','$nombre_producto','$descripcion_producto','$precio_producto','$img_productoBLOB',
    '$unidad_medida','$cantidad_min','$cantidad_max')";
  $query = mysqli_query($conexion,$sql);
  return $query;
}

//if($conexion){
//    echo 'conectado exitosamente';
//} else{
//    echo 'no se a conectado exitosamente';
//}

?>
