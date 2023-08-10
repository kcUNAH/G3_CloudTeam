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
//Mostrar datos




 if(!empty($_POST)){
    $id_descuento=$_POST['id_descuento'];
  
   $query_delete = mysqli_query($conex,"DELETE FROM tbl_descuentos WHERE id_descuentos= $id_descuento ");
   if($query_delete){
       
        echo
            '<script>
            alert("Descuento eliminado correctamente");
            window.location= "./descuentos.php";
            </script>
            ';
   $codigoObjeto=4;
    $accion='Eliminación';
    $descripcion= 'Elimino un descuento correctamente';
    bitacora($codigoObjeto, $accion,$descripcion);
        
    }else{
        echo
            '<script>
            alert("Error al eliminar el descuento correctamente");
            window.location= "./descuentos.php";
            </script>
            ';

         $codigoObjeto=4;
        $accion='Eliminar';
        $descripcion= 'El Usuario intento eliminar un descuento';
        bitacora($codigoObjeto, $accion,$descripcion);
    }
}
 

?>