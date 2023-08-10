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

    if (empty($_POST['nombre_categoria']) || empty($_POST['presentacion']))  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location.href= "promocionagregar.php";
            </script>
            ';
    } else {

        $nombre_categoria =$_POST['nombre_categoria'];
        $presentacion = $_POST['presentacion'];

            $query_insert = mysqli_query($conex, "INSERT INTO tbl_categoria(nombre_categoria,presentacion)
            VALUES('$nombre_categoria','$presentacion')");

            if ($query_insert) {
                echo
                '<script>
                alert("Categoria agregada correctamente");
                window.location= "../categoria.php";
                </script>
                ';
                $codigoObjeto=7;
                $accion='Nueva categoría';
                $descripcion= 'El usuario agrego una categoría nueva con éxito';
                bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                echo
                '<script>
                alert("Error al añadir la caategoria");
                window.location= "categorianueva.php";
                </script>
                ';
            }
        }
    }






?>