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


   if(!empty($_POST)){
        $id_producto=$_POST['id_producto'];

        $query_check = mysqli_query($conex, "SELECT * FROM tbl_promociones_producto WHERE id_producto= $id_producto");
        if (mysqli_num_rows($query_check) > 0) {
            echo '<script>alert("No se puede eliminar esta producto, ya que posee una promocion y para eliminar este producto debera eliminar primero la promocion ");</script>';
        } else {
    

       $query_delete = mysqli_query($conex,"DELETE FROM tbl_producto WHERE id_producto = $id_producto ");
       if($query_delete){
           // header("Location: GestionUsuarios.php");
            
            echo
                '<script>
                alert("Producto eliminado correctamente");
                window.location= "../Productos.php";
                </script>
                ';
       $codigoObjeto=4;
        $accion='Eliminación';
        $descripcion= 'Elimino un producto correctamente';
        bitacora($codigoObjeto, $accion,$descripcion);
            
        }else{
            echo
                '<script>
                alert("Error al eliminar el producto correctamente");
                window.location= "../Productos.php";
                </script>
                ';

             $codigoObjeto=4;
            $accion='Eliminar';
            $descripcion= 'El usuario intento eliminar un producto';
            bitacora($codigoObjeto, $accion,$descripcion);
        }
   }}

?>