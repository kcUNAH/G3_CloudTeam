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
//Mostrar datos



if (!empty($_POST)) {

    if (empty($_POST['id_categoria']) || empty($_POST['nombre_producto']) || empty($_POST['descripcion_producto'])
    || empty($_POST['precio_producto'])|| empty($_POST['unidad_medida'])
    || empty($_POST['cantidad_min'])|| empty($_POST['cantidad_max']))  
        {
            $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';
    } else {
        $id_producto = $_POST['id_producto'];
        $categoria = $_POST['id_categoria'];
        $nombre_producto =$_POST['nombre_producto'];
        $descripcion_producto = $_POST['descripcion_producto'];
        $precio_producto = $_POST['precio_producto'];
        $imagen_producto = $_FILES['img_producto'];
        $unidad_medida = $_POST['unidad_medida'];
        $cantidad_min = $_POST['cantidad_min'];
        $cantidad_max = $_POST['cantidad_max'];
        
       // $img_producto = $_POST['img_producto'];

               $query = mysqli_query($conexion,"SELECT * FROM tbl_producto 
                WHERE (nombre_producto = '$nombre_producto' AND id_producto != $id_producto)");

            $result = mysqli_fetch_array($query);
        
            if($imagen_producto == 0){ //Si ya existe manda eel mensaje 
                $alert= '<p class= "msg_error">El producto ya existe.</p>';
                
            }else{
            
                $unidad_medida = $_POST['unidad_medida'];
                $cantidad_min = $_POST['cantidad_min'];
                $cantidad_max = $_POST['cantidad_max'];
        
                $foto = $_FILES['img_producto'];
                $nombre_foto = $foto['name'];
                $type = $foto['type'];
                $url_temp = $foto['tmp_name'];
                $size = $foto['size'];

                if($nombre_foto != ""){
                    $destino = 'img/uploads/';
                    $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
                    $imgProducto = $img_nombre.'.png';
                    $src = $destino.$imgProducto;

                $query_update2 = mysqli_query($conexion, "UPDATE tbl_producto SET id_categoria = '$categoria',
                nombre_producto = '$nombre_producto', descripcion_producto = '$descripcion_producto', 
                precio_producto ='$precio_producto', img_producto = '$imgProducto', unidad_medida = '$unidad_medida',
                cantidad_min = '$cantidad_min', cantidad_max = '$cantidad_max'
                WHERE id_producto = $id_producto ");    
                }else{
                    $query_update2 = mysqli_query($conexion, "UPDATE tbl_producto SET id_categoria = '$categoria',
                    nombre_producto = '$nombre_producto', descripcion_producto = '$descripcion_producto', 
                    precio_producto ='$precio_producto', unidad_medida = '$unidad_medida',
                    cantidad_min = '$cantidad_min', cantidad_max = '$cantidad_max'
                    WHERE id_producto = $id_producto ");   
                }
                
            if ($query_update2) {
                if($nombre_foto != ''){
                    move_uploaded_file($url_temp,$src);
                }
                echo
                '<script>
                alert("Producto actualizado correctamente");
                window.location= "../Productos.php";
                </script>
                ';
                $codigoObjeto=3;
              $accion='Edición de producto';
              $descripcion= 'El usuario editó un producto';
              bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                echo
                '<script>
                alert("Error al actualizar el producto");
                window.location= "actualizar.php";
                </script>
                ';
            }
            }
    }

}

?>