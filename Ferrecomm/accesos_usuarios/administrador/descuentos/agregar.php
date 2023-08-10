<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo '
    <script>
    alert("Por favor, debe iniciar seccion");
    window.location= "index.php";
    </script>
    ';
    //header("localitation: index.php");
    session_destroy();
    die();
}
?>

<?php

include '../conex.php';
include '../../../php/bitacora.php';




if (!empty($_POST)) {

    if (empty($_POST['nombre_descuento']) || empty($_POST['porcentaje_descontar'])) //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        // $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';  
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location= "descuentoagregar.php";
            </script>
            ';
    } else {

        $nombre_descuento = $_POST['nombre_descuento'];
        $porcentaje_descontar = $_POST['porcentaje_descontar'];
       
        $query = mysqli_query($conex, "SELECT * FROM tbl_descuentos WHERE nombre_descuento = '$nombre_descuento'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            // $alert= '<p class= "msg_error">El usuario ya existe.</p>';
            echo
                '<script>
                alert("El descuento ya existe");
                window.location= "descuentos.php";
                </script>
                ';
            $codigoObjeto = 7;
            $accion = 'Registro';
            $descripcion = 'Intento ingresar un descuento ya existente';
            bitacora($codigoObjeto, $accion, $descripcion);
        } else {
            $query_insert = mysqli_query($conex, "INSERT INTO tbl_descuentos(nombre_descuento, porcentaje_descontar)
            VALUES('$nombre_descuento','$porcentaje_descontar')");


            if ($query_insert) {
                //  $alert= '<p class= "msg_save">El usuario se ha creado.</p>';
                echo
                        '<script>
                alert("Descuento creado correctamente");
                window.location= "descuentos.php";
                </script>
                ';

              
                $codigoObjeto = 7;
                $accion = 'Nuevo descuento';
                $descripcion = 'El usuario registro un descuento nuevo';
                bitacora($codigoObjeto, $accion, $descripcion);
            } else {
                // $alert= '<p class= "msg_error">Error al crear el usario.</p>';
                echo
                    '<script>
                alert("Error al crear el descuento");
                window.location= "descuentos.php";
                </script>
                ';
                $codigoObjeto = 7;
                $accion = 'Registro';
                $descripcion = 'Error al intentar crear un descuento';
                bitacora($codigoObjeto, $accion, $descripcion);
            }
        }
    }
}





?>