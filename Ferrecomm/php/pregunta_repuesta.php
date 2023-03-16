<?php


include_once 'conexion.php';

if (isset($_POST['verifica'])) {


    $preguntas1 = $_POST['preguntas1'];
    $respuesta = $_POST['repuestas'];
    $usuarios = $_POST['usuarios'];
    $Creado = "AUTOREGISTRO";
    $modificado = "ADMINISTRADOR";
    $d = strtotime("today");
    date("Y-m-d h:i:sa", $d);
    //ID PREGUNTA

    $idpreguntas = "SELECT id_pregunta FROM tbl_ms_preguntas WHERE id_pregunta= '$preguntas1' ";
    $obtenepregunta = mysqli_query($conexion, $idpreguntas);
    $filapregunta = mysqli_fetch_array($obtenepregunta);
    $va_preguntaid = $filapregunta['id_pregunta'];
    $preguntaid = $va_preguntaid = $preguntas1;
    //ID_USUARIO
    $idusuario = "SELECT id_usuario FROM tbl_ms_usuario WHERE usuario = '$usuarios'";
    $obtenerid = mysqli_query($conexion, $idusuario);
    $filaid = mysqli_fetch_array($obtenerid);
    $Usuarioid = $filaid['id_usuario'];

    //creado por admin
    $idcreado = "SELECT creado_por FROM tbl_ms_usuario WHERE usuario= '$usuarios'";
    $obtenercreado = mysqli_query($conexion, $idcreado);
    $filaicreado = mysqli_fetch_array($obtenercreado);
    $va_creado = $filaicreado['creado_por'];
    $queri = "INSERT INTO  tbl_ms_preguntas_usuario(id_pregunta,id_usuario,respuesta,creado_por,fecha_creacion,modificado_por,fecha_modificacion)
                                                                             VALUES($preguntaid , $Usuarioid, '$respuesta','$Creado',CURTIME(),'$modificado',CURTIME())";
    $EJECUTAR = mysqli_query($conexion, $queri);


    if ($EJECUTAR) {
        if ($va_creado == 'AUTOREGISTRO') {
            $sql = "UPDATE tbl_ms_usuario SET primer_ingreso = 'Si' WHERE usuario = '$usuarios'";
            mysqli_query($conexion, $sql);
            echo '
        <script>
        alert("Pregunta Registrada con exito");
        window.location= "../index.php";
        </script>
        ';
        } else {
            if ($va_creado == 'ADMINISTRADOR') {
                $sql = "UPDATE tbl_ms_usuario SET primer_ingreso = 'Si' WHERE usuario = '$usuarios'";
                mysqli_query($conexion, $sql);

                echo '
        <script>
        alert("Pregunta Registrada con exito");
        window.location= "contrarnueva.php";
        </script>
        ';
            }
        }
    } else {
        echo '
        <script>
        alert("intentelo de nuevo pregunta no registrada");
        window.location= "pregunta.php";
        </script>
        ';
    }

    mysqli_close($conexion);
}
