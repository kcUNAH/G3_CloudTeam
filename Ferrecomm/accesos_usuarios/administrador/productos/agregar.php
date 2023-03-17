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

    if (empty($_POST['id_categoria']) || empty($_POST['nombre_producto']) || empty($_POST['descripcion_producto'])
    || empty($_POST['precio_producto'])|| empty($_POST['unidad_medida'])
    || empty($_POST['cantidad_min'])|| empty($_POST['cantidad_max']))  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        // $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';  
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location= "agregarproducto.php";
            </script>
            ';
    } else {


        $categoria = $_POST['id_categoria'];
        $nombre_producto =$_POST['nombre_producto'];
        $descripcion_producto = $_POST['descripcion_producto'];
        $precio_producto = $_POST['precio_producto'];
        
        $unidad_medida = $_POST['unidad_medida'];
        $cantidad_min = $_POST['cantidad_min'];
        $cantidad_max = $_POST['cantidad_max'];
        $nombimagen =$_FILES['img_producto']['name'];
        $tamañoarchivo=$_FILES['img_producto']['size'];
        $imagensubida = fopen($_FILES['img_producto']['tmp_name'],'r');
        $img_productos =fread($imagensubida,$tamañoarchivo);
        
        $img_producto = mysqli_escape_string($conex,$img_productos);
       // $img_producto = $_POST['img_producto'];
            $query_insert = mysqli_query($conex, "INSERT INTO tbl_producto(id_categoria,nombre_producto,descripcion_producto,
                                                   precio_producto,img_producto,unidad_medida,cantidad_min,cantidad_max)
            VALUES('$categoria','$nombre_producto','$descripcion_producto','$precio_producto','$img_producto',
            '$unidad_medida','$cantidad_min','$cantidad_max')");

            if ($query_insert) {
                echo
                '<script>
                alert("Producto agregado correctamente");
                window.location= "../Productos.php";
                </script>
                ';
                $codigoObjeto=7;
                $accion='Registro';
                $descripcion= 'Se agrego un producto con Exito';
                bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                echo
                '<script>
                alert("Error al añadir el producto");
                window.location= "agregarproducto.php";
                </script>
                ';
            }
        }
    }






?>