<?php
session_start();
include 'conexion.php';


if (empty($_POST['verificaa'])) {
  $usuario = $_SESSION['usuario']['user'];
  $contrasenia_nueva = $_POST['contra'];
  
  $validar_contrasenia = mysqli_query($conexion, "SELECT * FROM tbl_ms_usuario WHERE usuario = '$usuario'
                                ");
  
  if (mysqli_num_rows($validar_contrasenia) > 0){
  
    $queri = "UPDATE tbl_ms_usuario
    SET contrasenia = '$contrasenia_actual' 
    where usuario = '$usuario' ";
    
    $EJECUTAR = mysqli_query($conexion, $queri);
    session_destroy();  
    echo '
    <script>
    alert("Contraseña actualizada con exito!! Por favor ingrese de nuevo ");
    window.location= "../index.php";
    </script>
    ';
        exit();
  
  
  
  }else{
    echo '
    <script>
    alert("Contraseña incorrecta, por favor pruebe de nuevo ");
    </script>
    ';
  }

}






?>
