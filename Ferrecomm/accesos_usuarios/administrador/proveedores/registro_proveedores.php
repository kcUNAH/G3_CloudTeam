
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

    if (empty($_POST['nombre_proveedor']) || empty($_POST['rtn_proveedor']) || empty($_POST['telefono'])  || empty($_POST['email']) || empty($_POST['direccion'])) //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        
        // $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';  
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location= "agregar_proveedores.php";
            </script>
            ';
    } else {

        $nombre_proveedor = $_POST['nombre_proveedor'];
        $rtn_proveedor= $_POST['rtn_proveedor'];
        $telefono_proveedor = $_POST['telefono'];
        $correo_proveedor = $_POST['email'];
        $direccion_proveedor = $_POST['direccion'];
        
        $query = mysqli_query($conex, "SELECT * FROM tbl_proveedores WHERE nombre_proveedor = '$nombre_proveedor' or correo_proveedor = '$correo_proveedor' ");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            // $alert= '<p class= "msg_error">El usuario ya existe.</p>';
            echo
                '<script>
                alert("El proveedor ya existe");
                window.location= "../proveedores.php";
                </script>
                ';
            $codigoObjeto = 7;
            $accion = 'Registro';
            $descripcion = 'intento ingresar un proveedor ya existente';
            bitacora($codigoObjeto, $accion, $descripcion);
        } else {
           
            $sql="INSERT INTO tbl_proveedores(nombre_proveedor,rtn_proveedor,telefono_proveedor,correo_proveedor,direccion_proveedor)
                                      VALUES( '$nombre_proveedor', '$rtn_proveedor','$telefono_proveedor',' $correo_proveedor ',' $direccion_proveedor')";

              $ejecuta=mysqli_query($conex, $sql);

            if ($ejecuta) {
                //  $alert= '<p class= "msg_save">El usuario se ha creado.</p>';
                echo
                '<script>
                alert("Proveedor creado correctamente");
                window.location= "../proveedores.php";
                </script>
                ';
                $codigoObjeto=7;
                $accion='Registro';
                $descripcion= 'Se agrego un proveedor con Exito';
                bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                // $alert= '<p class= "msg_error">Error al crear el usario.</p>';
                echo
                '<script>
                alert("Error al crear el proveedor");
                window.location= "../proveedores.php";
                </script>
                ';
                $codigoObjeto=7;
                $accion='Registro';
                $descripcion= 'Se intento registrar un proveedor';
                bitacora($codigoObjeto, $accion,$descripcion);
            }
     
      
      
        }
    }
}



?>
