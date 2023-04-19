<?php
session_start();

include 'conexion.php';
include_once 'bitacora.php';
//obtencion de datos 
$usuario = $_POST['usuario_login'];
$contra = $_POST['contra_login'];
// leer contraseña incriptada
$contra = hash('sha512', $contra);


// validar datos 

$validar_login = mysqli_query($conexion, "SELECT * FROM tbl_ms_usuario WHERE usuario = '$usuario'
                              and contrasenia = '$contra' ");



//obtener numero de intentos
// ADMIN_INTENTOS = (id= 1) nombre del paramentro en la base de datos que especifica el numero de intentos.

$intentos = "SELECT valor FROM tbl_ms_parametros WHERE id_parametro = '1'";
$obtener_intentos = mysqli_query($conexion, $intentos);
$fila_intentos = mysqli_fetch_array($obtener_intentos);
$va_intentos = $fila_intentos['valor'];


if (isset($_COOKIE["block" . $usuario])) {
    echo '
        <script>
        alert("Usuario bloqueado, por demasiados intentos ");
        window.location= "../index.php";
        </script>
        ';
} else {



    if (mysqli_num_rows($validar_login) > 0){
        $estado = "SELECT estado_usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'";
        $obtener_estado = mysqli_query($conexion, $estado);
        $fila_estado = mysqli_fetch_array($obtener_estado);
        $va_estado = $fila_estado['estado_usuario'];
    }

    if (mysqli_num_rows($validar_login) > 0 && $va_estado == 'ACTIVO') {
        $_SESSION['usuario']['user'] = $usuario;

        $rol = "SELECT id_rol FROM tbl_ms_usuario WHERE usuario = '$usuario'";
        $obtener_rol = mysqli_query($conexion, $rol);
        $fila = mysqli_fetch_array($obtener_rol);
        $va_rol = $fila['id_rol'];
        //obtener nombre 
        $Nombre = "SELECT nombre_usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'";
        $obtener_nombre = mysqli_query($conexion, $Nombre);
        $fila_Nombre = mysqli_fetch_array($obtener_nombre);
        $va_Nombre = $fila_Nombre['nombre_usuario'];
        
        //obtener Estado
        $estado = "SELECT estado_usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'";
        $obtener_estado = mysqli_query($conexion, $estado);
        $fila_estado = mysqli_fetch_array($obtener_estado);
        $va_estado = $fila_estado['estado_usuario'];
        //obteer id_usuario
        $idusuario = "SELECT id_usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'";
        $obtenerid = mysqli_query($conexion,$idusuario);
        $filaid = mysqli_fetch_array($obtenerid);
        $va_id =$filaid['id_usuario'];
        //Obtener primer Ingreso 
        $usuarioprimero = "SELECT primer_ingreso FROM tbl_ms_usuario WHERE usuario = '$usuario'";
        $obtener_primer_ingreso = mysqli_query($conexion,$usuarioprimero);
        $filai_primer = mysqli_fetch_array($obtener_primer_ingreso);
        $va_primer_ingreso =$filai_primer ['primer_ingreso'];

        $_SESSION['id_usuario']=$va_id;


        if($va_primer_ingreso =='NO'){
            header("location:pregunta.php");
          exit();
          }
        

        switch ($va_rol) {
            case 1:
             
               
                $_SESSION['usuario']['rol'] = "ADMINISTRADOR";
                $_SESSION['usuario']['nombre'] = $va_Nombre;
                header("Location: ../accesos_usuarios/administrador/Menu.php");
                $codigoObjeto=1;
                $accion='Inicio de sesion';
                $descripcion= 'El usuario Administrador inicio sesion';
                bitacora($codigoObjeto, $accion,$descripcion);
               
              
                break;

            case 2:
                $_SESSION['usuario']['rol'] = "VENDEDOR";
                $_SESSION['usuario']['nombre'] = $va_Nombre;
                header("Location: ../accesos_usuarios/vendedor/Menu.php");
                
                $codigoObjeto=1;
                  $accion='Inicio de sesion';
                  $descripcion= 'El usuario Vendedor inicio sesion';
                  bitacora($codigoObjeto, $accion,$descripcion);
                  break;

            case 3:
                $_SESSION['usuario']['rol'] = "DEFAULT";
                $_SESSION['usuario']['nombre'] = $va_Nombre;
                header("Location: ../accesos_usuarios/defaul/Menu.php");

                $codigoObjeto=1;
                $accion='Inicio de sesion';
                $descripcion= 'El usuario Default inicio sesion';
                bitacora($codigoObjeto, $accion,$descripcion);


                break;
        }


        exit();
    } else {
        if (mysqli_num_rows($validar_login) > 0){
        //obtener Estado  
          $estado = "SELECT estado_usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'";
          $obtener_estado = mysqli_query($conexion, $estado);
          $fila_estado = mysqli_fetch_array($obtener_estado);
          $va_estado = $fila_estado['estado_usuario'];




          if ($va_estado == 'INACTIVO') {
            echo '
        <script>
        alert("Usuario ingresado inactivo, por favor intente de nuevo ");
        window.location= "../index.php";
        </script>
        ';
            exit();
        }
        }



        if (isset($_COOKIE["$usuario"])) {
            $cont = $_COOKIE["$usuario"];
            $cont++;
            setcookie($usuario, $cont, time() + 120);
            if ($cont >= $va_intentos) {
                setcookie("block" . $usuario, $cont, time() + 30);
                $queribloqueo = "UPDATE tbl_ms_usuario
                          SET estado_usuario = 'INACTIVO' 
                          where usuario = '$usuario' ";

                $EJECUTAR_bloqueo = mysqli_query($conexion, $queribloqueo);
            }
        } else {
            setcookie($usuario, 1, time() + 120);
        }

       



        echo '
    <script>
    alert("Usuario o contraseña incorrectos, por favor intente de nuevo");
    window.location= "../index.php";
    </script>
    ';
        exit();
    }

}
