<?php
session_start();//inicializaando sesion

include_once "../php/conexion2.php";

?>
<?php


if (isset($_SESSION['vario'])) {
  $usuario = $_SESSION['vario'];
 
  try {

    $sentencia = $db->prepare("SELECT id_usuario FROM tbl_ms_usuario WHERE usuario = (?);");
    $sentencia->execute(array($usuario));
    $row = $sentencia->fetchColumn();
    
    if ($row > 0) {
      
      $user = $row;
      if (isset($_POST['verificar_res'])) {
     
        $clave_nueva = ($_POST['clave_nueva']);
        $confirmar_clave = ($_POST['confirmar_clave']);
        $consultar = "SELECT * FROM tbl_ms_usuario WHERE  id_usuario ='$user' AND contrasenia = '$clave_nueva' AND  = '$respuesta';";
        $existe1 = $conn->query($consultar);
        $row = $existe1->num_rows;
        if ($row > 0) { //Si se en la consulta hay una fila si hay registro de la busqueda ,es decir que si es correcta la respuesta
          // echo "<script>
       
          //  window.location='../Vistas/modulos/cambio_contrasena_preguntas.php';
          //</script>";Cambio_contraseña_preguntas
          echo '<script> alert("RESPUESTA CORRECTA "); window.location="../Cambio_contrasena_preguntas.php"; </script>';
        } else { //Si no hay registros en la fila ,la respuesta es incorrecta y se bloquea al usuario :/
          echo '<script> alert("RESPUESTA INCORRECTA "); window.location="../Recuperarpreguntas.php"; </script>';
        //  $_SESSION['vario'] = $usuario;
          
        }
      }
    } else {
      echo '<script> alert("Usuario no existe "); window.location="/G3_CloudTeam/Ferrecomm/"; </script>';
      
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
}
