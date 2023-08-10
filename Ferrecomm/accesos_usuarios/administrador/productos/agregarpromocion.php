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

    if (empty($_POST['nombre_promocion']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_final'])
    || empty($_POST['precio_venta'])|| empty($_POST['id_estado_prom']))  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location.href= "promocionagregar.php";
            </script>
            ';
    } else {

        $nombre_promocion =$_POST['nombre_promocion'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_final = $_POST['fecha_final'];
        $precio_venta = $_POST['precio_venta'];
        $id_estado_prom = $_POST['id_estado_prom'];

            $query_insert = mysqli_query($conex, "INSERT INTO tbl_promociones(nombre_promocion,fecha_inicio,
                                                   fecha_final,precio_venta,id_estado_prom)
            VALUES('$nombre_promocion','$fecha_inicio','$fecha_final','$precio_venta','$id_estado_prom')");

            if ($query_insert) {
                echo
                '<script>
                alert("Promoción agregada correctamente");
                window.location= "promocion.php";
                </script>
                ';
                $codigoObjeto=7;
                $accion='Nueva promoción';
                $descripcion= 'El usuario agrego una promoción nueva con éxito';
                bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                echo
                '<script>
                alert("Error al añadir la promocion");
                window.location= "promocionagregar.php";
                </script>
                ';
            }
        }
    }






?>