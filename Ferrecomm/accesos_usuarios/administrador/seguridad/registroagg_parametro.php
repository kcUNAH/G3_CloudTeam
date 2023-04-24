<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    // Si el usuario ha iniciado sesión, mostrar el campo de entrada con su ID de usuario
    $usuarioinicio = $_SESSION['id_usuario'];
    echo ' <input type="hidden"value="'.  $usuarioinicio.'" readonly>';
} else {
    // Si el usuario no ha iniciado sesión, mostrar un mensaje de error o redirigir a la página de inicio de sesión
    echo '
    <script>
    alert("Por favor, debe iniciar seccion");
    window.location= "../index.php";
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

    if (empty($_POST['nombre_parametro']) || empty($_POST['parametro']))
    {
        
        // $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';  
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location= "parametros.php";
            </script>
            ';
    } else {

        $parametroN = $_POST['nombre_parametro'];
        $valor= $_POST['parametro'];
        $id_objeto=12;
$d=strtotime("today");
date("Y-m-d h:i:sa", $d);

       
        $ruta_archivo = 'registroagg_parametro.php'; // Ruta del archivo que quieres verificar
     
        $creado_por="ADMINISTRADOR";
        $modificado_por="ADMINISTRADOR";
        $id_usuario=$usuarioinicio;
        $query = mysqli_query($conex, "SELECT parametro FROM tbl_ms_parametros WHERE parametro = '$parametroN' ");
        $result = mysqli_fetch_array($query);
        $usuarioprimero = "SELECT permiso_insercion FROM tbl_ms_permisos WHERE id_objeto= 12 ";
        $obtener_primer_ingreso = mysqli_query($conex,$usuarioprimero);
        $filai_primer = mysqli_fetch_array($obtener_primer_ingreso);
        $va_primer_ingreso =$filai_primer ['permiso_insercion'];
        if($va_primer_ingreso==1 && $id_objeto==12){
        if ($result > 0) {
            // $alert= '<p class= "msg_error">El usuario ya existe.</p>';
            echo
                '<script>
                alert("El parametro ya existe");
                window.location= "parametros.php";
                </script>
                ';
            $codigoObjeto = 7;
            $accion = 'Registro';
            $descripcion = 'intento ingresar un parametro que existe';
            bitacora($codigoObjeto, $accion, $descripcion);
        } else {
           
            $sql="INSERT INTO tbl_ms_parametros(parametro,valor,fecha_creacion,fecha_modificacion,creado_por,modificado_por,id_usuario)
                                      VALUES( '$parametroN', '$valor',CURTIME(),CURTIME(),'$creado_por',' $modificado_por','$id_usuario ')";

              $ejecuta=mysqli_query($conex, $sql);

            if ($ejecuta) {
                //  $alert= '<p class= "msg_save">El usuario se ha creado.</p>';
                echo
                '<script>
                alert("Parametro creado correctamente");
                window.location= "parametros.php";
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
                window.location= "agg_parametro.php";
                </script>
                ';
                $codigoObjeto=7;
                $accion='Registro';
                $descripcion= 'Se intento registrar un parametro';
                bitacora($codigoObjeto, $accion,$descripcion);
            }
        }
        }else{
            if($va_primer_ingreso==0){
                echo
                '<script>
                alert("usted no tiene permisos para crear un parametro");
                window.location= "parametros.php";
                </script>
                ';
        }
        
        }
           
                
            }
            
        }
        
        ?>