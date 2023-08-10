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
    $id_pregunta=$_POST['id_pregunta'];
  
   $query_delete = mysqli_query($conex,"DELETE FROM tbl_ms_preguntas WHERE id_pregunta= $id_pregunta ");
   if($query_delete){
       
        echo
            '<script>
            alert("Pregunta eliminada correctamente");
            window.location= "./preguntas.php";
            </script>
            ';
   $codigoObjeto=4;
    $accion='Eliminación';
    $descripcion= 'El usuario eliminó una pregunta correctamente';
    bitacora($codigoObjeto, $accion,$descripcion);
        
    }else{
        echo
            '<script>
            alert("Error al eliminar la pregunta correctamente");
            window.location= "./preguntas.php";
            </script>
            ';

         $codigoObjeto=4;
        $accion='Eliminación';
        $descripcion= 'El Usuario intento eliminar un pregunta';
        bitacora($codigoObjeto, $accion,$descripcion);
    }
}
 

?>