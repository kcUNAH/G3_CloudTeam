<?php
session_start();

include 'conexion.php';

//obtencion de datos 
$usuario = $_POST['usuario_login'];
$contra = $_POST['contra_login'];
// leer contraseña incriptada
$contra = hash('sha512', $contra);


// validar datos 

$validar_login = mysqli_query($conexion, "SELECT * FROM tbl_ms_usuario WHERE usuario = '$usuario'
                              and contrasenia = '$contra' ");

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

//obtener numero de intentos
// ADMIN_INTENTOS =  (id= 1) nombre del paramentro en la base de datos que especifica el numero de intentos.

//$intentos = "SELECT parametro FROM tbl_ms_parametros WHERE id = '1'";
//$obtener_intentos = mysqli_query($conexion, $intentos);
//$fila_intentos = mysqli_fetch_array($obtener_intentos);
//$va_intentos = $fila_intentos['parametro'];

if (isset($_COOKIE["block" . $usuario])) {
    echo '
        <script>
        alert("Usuario bloqueado, demasiados intentos ");
        window.location= "../index.php";
        </script>
        ';
} else {

    if (mysqli_num_rows($validar_login) > 0 && $va_estado == 'ACTIVO') {

        switch ($va_rol) {
            case 1:
                $_SESSION['usuario']['user'] = $usuario;
                $_SESSION['usuario']['rol'] = "ADMINISTRADOR";
                $_SESSION['usuario']['nombre'] = $va_Nombre;
                header("Location: ../accesos_usuarios/administrador/Menu.php");
                break;

            case 2:
                $_SESSION['usuario']['user'] = $usuario;
                $_SESSION['usuario']['rol'] = "VENDEDOR";
                $_SESSION['usuario']['nombre'] = $va_Nombre;
                header("Location: ../accesos_usuarios/vendedor/Menu.php");
                break;

            case 3:
                $_SESSION['usuario']['user'] = $usuario;
                $_SESSION['usuario']['rol'] = "DEFAULT";
                $_SESSION['usuario']['nombre'] = $va_Nombre;
                header("Location: ../accesos_usuarios/defaul/Menu.php");
                break;
        }


        exit();
    } else {



        if (isset($_COOKIE["$usuario"])) {
            $cont = $_COOKIE["$usuario"];
            $cont++;
            setcookie($usuario, $cont, time() + 120);
            if ($cont >= 3) {
                setcookie("block" . $usuario, $cont, time() + 30);
                $queribloqueo = "UPDATE tbl_ms_usuario
                          SET estado_usuario = 'INACTIVO' 
                          where usuario = '$usuario' ";

                $EJECUTAR_bloqueo = mysqli_query($conexion, $queribloqueo);
            }
        } else {
            setcookie($usuario, 1, time() + 120);
        }










        if ($va_estado == 'INACTIVO') {
            echo '
        <script>
        alert("Usuario ingresado inactivo, por favor intente de nuevo ");
        window.location= "../index.php";
        </script>
        ';
            exit();
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
