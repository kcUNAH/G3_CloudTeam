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
include '../../../php/bitacora.php';
include '../conex.php';

if (!empty($_POST)) {

    if (empty($_POST['nombre_categoria']) || empty($_POST['presentacion']) )  
        {
            $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';
    } else {
        $id_categoria = $_POST['id_categoria'];
        $nombre_categoria = $_POST['nombre_categoria'];
        $presentacion = $_POST['presentacion'];
               
            $query_update = mysqli_query($conex, "UPDATE tbl_categoria SET nombre_categoria = '$nombre_categoria',
            presentacion = '$presentacion'
            WHERE id_categoria = $id_categoria "); 
                
            if ($query_update) {
                echo
                '<script>
                alert("Categoria actualizada correctamente");
                window.location= "../categoria.php";
                </script>
                ';
                $codigoObjeto=3;
              $accion='Edición de categoría';
              $descripcion= 'El usuario editó una categoría';
              bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                echo
                '<script>
                alert("Error al actualizar la categoria");
                window.location= "promocioneditar.php";
                </script>
                ';
            }
            }
    }



?>