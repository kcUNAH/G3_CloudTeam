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

?>


<?php






if (!empty($_POST)) {

    if (empty($_POST['pregunta']) ) //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        // $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';  
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location= "preguntasagregar.php";
            </script>
            ';
    } else {

        $pregunta = $_POST['pregunta'];
        date_default_timezone_set('America/Mexico_City');
        $fecha_creacion = date("Y-m-d H:i:s");
       
        $query = mysqli_query($conex, "SELECT * FROM tbl_ms_preguntas WHERE pregunta = '$pregunta'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            echo
                '<script>
                alert("La pregunta ya existe");
                window.location= "preguntas.php";
                </script>
                ';
            $codigoObjeto = 7;
            $accion = 'Nueva pregunta';
            $descripcion = 'Intento ingresar una pregunta que ya existente';
            bitacora($codigoObjeto, $accion, $descripcion);
        } else {
            $query_insert = mysqli_query($conex, "INSERT INTO tbl_ms_preguntas(pregunta, fecha_creacion)
            VALUES('$pregunta','$fecha_creacion')");


            if ($query_insert) {
                echo
                        '<script>
                alert("Pregunta creada correctamente");
                window.location= "preguntas.php";
                </script>
                ';

              
                $codigoObjeto = 7;
                $accion = 'Nueva pregunta';
                $descripcion = 'El usuario registro una pregunta nueva';
                bitacora($codigoObjeto, $accion, $descripcion);
            } else {
                // $alert= '<p class= "msg_error">Error al crear el usario.</p>';
                echo
                    '<script>
                alert("Error al crear una pregunta");
                window.location= "preguntas.php";
                </script>
                ';
                $codigoObjeto = 7;
                $accion = 'Registro';
                $descripcion = 'Error al intentar crear una pregunta';
                bitacora($codigoObjeto, $accion, $descripcion);
            }
        }
    }
}





?>