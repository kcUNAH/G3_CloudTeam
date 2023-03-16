
<?php
session_start();

include 'conex.php';

if (!empty($_POST)) {
$alert='';
    if (empty($_POST['nombre']) || empty($_POST['RTN']) || empty($_POST['telefono'])  || empty($_POST['correo'] || empty($_POST['direccion'])))  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        // $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';  
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location= "registro.php";
            </script>
            ';
    } else {

        $nombre = $_POST['nombre'];
        $RTN = $_POST['RTN'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        
        $query = mysqli_query($conex, "SELECT * FROM tbl_proveedores WHERE nombre = '$nombre' or correo= '$correo' ");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            // $alert= '<p class= "msg_error">El usuario ya existe.</p>';
            echo
            '<script>
                alert("El usuario ya existe");
                window.location= "registro.php";
                </script>
                ';
        } else {
           

            $query_insert = mysqli_query($conex, "INSERT INTO tbl_proveedores(id_proveedor,nombre_proveedor,rtn_proveedor,telefono_proveedor,correo_proveedor,direccion_proveedor)
                                                                                       VALUES('$nombre',' $RTN ', '$telefono','$correo','$direccion')");

            if ($query_insert) {
                //  $alert= '<p class= "msg_save">El usuario se ha creado.</p>';
                echo
                '<script>
                alert("Usuario creado correctamente");
                window.location= "GestionUsuarios.php";
                </script>
                ';
            } else {
                // $alert= '<p class= "msg_error">Error al crear el usario.</p>';
                echo
                '<script>
                alert("Error al crear el usario");
                window.location= "registro.php";
                </script>
                ';
            }
        }
    }
}





?>
