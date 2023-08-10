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

 if(!empty($_POST)){
    $id_promocion=$_POST['id_promocion'];

    

   $query_delete = mysqli_query($conexion,"DELETE FROM tbl_promociones WHERE id_promocion = $id_promocion ");
   if($query_delete){
       
        echo
            '<script>
            alert("Promocion eliminada correctamente");
            window.location= "promocion.php";
            </script>
            ';
   $codigoObjeto=4;
    $accion='Eliminación';
    $descripcion= 'El usuario eliminó una promoción correctamente';
    bitacora($codigoObjeto, $accion,$descripcion);
        
    }else{
        echo
            '<script>
            alert("Error al eliminar la promocion correctamente");
            window.location= "promocion.php";
            </script>
            ';

         $codigoObjeto=4;
        $accion='Eliminar';
        $descripcion= 'El Usuario intento eliminar una promocion';
        bitacora($codigoObjeto, $accion,$descripcion);
    }
}
?>