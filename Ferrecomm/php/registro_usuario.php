<?php
INCLUDE 'conexion.php';
include_once 'bitacora.php';
$nombre = $_POST ['nombre'];
$email = $_POST ['email'];
$usuario = $_POST ['usuario'];
$contra = $_POST ['contra'];
//encriptamiento de la contraseña
$contra = hash('sha512', $contra);
$defaul_rol = "3";
$defaul_estado = "ACTIVO";
$creado="AUTOREGISTRO";
$primerIngreso = "NO";

 //Creacion automatica de fecha
 date_default_timezone_set('America/Mexico_City');
 $fecha_creacion = date("Y-m-d H:i:s");
 //fecha de vencimiento 
       date_default_timezone_set('America/Mexico_City');
        $fecha_vencimiento=(new DateTime('+ 12 months'))->format('Y-m-d H:i:s');

$queri = "INSERT INTO tbl_ms_usuario (nombre_usuario, correo_electronico, usuario, contrasenia, id_rol, estado_usuario, creado_por, fecha_creacion, primer_ingreso, fecha_vencimiento) 
                     VALUES ('$nombre', '$email','$usuario','$contra','$defaul_rol','$defaul_estado', '$creado','$fecha_creacion','$primerIngreso','$fecha_vencimiento')";


$consulta= "SELECT * FROM tbl_ms_usuario WHERE usuario = '$usuario' ";

// verificar que no se repitan los datos en la base 
//usuario
$verificar_Usuario = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($verificar_Usuario) > 0){
    echo'
    <script>
    alert("Este usuario ya esta registrado, por favor intente de nuevo");
    window.location= "../index.php";
    </script>
    ';
    exit();
}


//correo 
$verificar_Correo = mysqli_query($conexion, "SELECT * FROM tbl_ms_usuario WHERE correo_electronico = '$email' ");
if(mysqli_num_rows($verificar_Correo) > 0){
    echo'
    <script>
    alert("El correo ingresado ya esta registrado, por favor intente de nuevo");
    window.location= "../index.php";
    </script>
    ';
    exit();
}


$EJECUTAR = mysqli_query($conexion, $queri);

if ($EJECUTAR){
    echo'
    <script>
    alert("Usuario registrado exitosamente");
    window.location= "../index.php";
    </script>
    ';
    $codigoObjeto=7;
    $accion='Registro';
    $descripcion= 'Se registro un nuevo Usuario';
    bitacora($codigoObjeto, $accion,$descripcion);
}else {
    echo'
    <script>
    alert("intentelo de nuevo Usuario no registrado");
    window.location= "../index.php";
    </script>
    ';
}

mysqli_close($conexion);


?>