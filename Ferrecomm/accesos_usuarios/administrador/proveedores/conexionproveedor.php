<?php
//el signo $ se utiliza para poder declarar una variable, se debe colocar al inicio 
//seguido del nombre de la variable 
// compocision de la conexion puerto, ususario,contraseña,nombre de la base de datos
$conexion = mysqli_connect("localhost", "root", "", "ferrecomm_db");


function insertar($conexion,$nombre_proveedor,$rtn_proveedor,$telefono_proveedor,$correo_proveedor,$direccion_proveedor){
    $sql= "INSERT INTO tbl_proveedores(nombre_proveedor,rtn_proveedor,telefono_proveedor,
    correo_proveedor,direccion_proveedor)
    VALUES('$nombre','$RTN','$telefono','$correo','$direccion')";
  $query = mysqli_query($conexion,$sql);
  return $query;
}

//if($conexion){
//    echo 'conectado exitosamente';
//} else{
//    echo 'no se a conectado exitosamente';
//}

?>
