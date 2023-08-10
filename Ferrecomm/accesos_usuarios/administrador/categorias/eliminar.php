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

 if(!empty($_POST)){
    $id_categoria=$_POST['id_categoria'];
  
    $query_check = mysqli_query($conex, "SELECT * FROM tbl_producto WHERE id_categoria = $id_categoria");
    if (mysqli_num_rows($query_check) > 0) {
        echo '<script>alert("No se puede eliminar esta categoria porque esta siendo usada en uno o varios productos, porfavor cambie de categoria esos productos");</script>';
    } else {

   $query_delete = mysqli_query($conex,"DELETE FROM tbl_categoria WHERE id_categoria = $id_categoria ");
   if($query_delete){
       
        echo
            '<script>
            alert("Categoria eliminada correctamente");
            window.location= "../categoria.php";
            </script>
            ';
   $codigoObjeto=4;
    $accion='Eliminación';
    $descripcion= 'El usuario eliminó una categoría correctamente';
    bitacora($codigoObjeto, $accion,$descripcion);
        
    }else{
        echo
            '<script>
            alert("Error al eliminar la categoria correctamente");
            window.location= "../categoria.php";
            </script>
            ';

         $codigoObjeto=4;
        $accion='Eliminación';
        $descripcion= 'El usuario intento eliminar una categoria';
        bitacora($codigoObjeto, $accion,$descripcion);
    }
}
 }

?>