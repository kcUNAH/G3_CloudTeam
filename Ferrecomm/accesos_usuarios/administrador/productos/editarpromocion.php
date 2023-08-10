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

include_once "./conexionproducto.php";
include '../../../php/bitacora.php';


if (!empty($_POST)) {

    if (empty($_POST['nombre_promocion']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_final'])
    || empty($_POST['precio_venta'])|| empty($_POST['id_estado_prom']))  
        {
            $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';
    } else {
        $id_promocion = $_POST['id_promocion'];
        $nombre_promocion = $_POST['nombre_promocion'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_final =$_POST['fecha_final'];
        $precio_venta = $_POST['precio_venta'];
        $id_estado_prom = $_POST['id_estado_prom'];
            
               
            $query_update = mysqli_query($conexion, "UPDATE tbl_promociones SET nombre_promocion = '$nombre_promocion',
            fecha_inicio = '$fecha_inicio', fecha_final = '$fecha_final', 
            precio_venta ='$precio_venta', id_estado_prom = '$id_estado_prom'
            WHERE id_promocion = $id_promocion "); 
                
            if ($query_update) {
                echo
                '<script>
                alert("Promocion actualizada correctamente");
                window.location= "promocion.php";
                </script>
                ';
                $codigoObjeto=3;
              $accion='Edición de promoción';
              $descripcion= 'El usuario editó una promoción';
              bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                echo
                '<script>
                alert("Error al actualizar la promocion");
                window.location= "promocioneditar.php";
                </script>
                ';
            }
            }
    }



?>