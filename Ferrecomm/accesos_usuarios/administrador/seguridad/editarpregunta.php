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
        
        include '../conex.php';

    
        if (!empty($_POST)){
            
            if(empty($_POST['pregunta']) )  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
            {
                $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';    
        
            }else{
                
                $id_pregunta = $_POST['id_pregunta'];
                $pregunta = $_POST['pregunta'];
              

                $query = mysqli_query($conex,"SELECT * FROM tbl_ms_preguntas
                WHERE (pregunta = '$pregunta' AND id_pregunta != $id_pregunta)");

            $result = mysqli_fetch_array($query); //Almacena datos

            if($result > 0){ //Si ya existe manda eel mensaje 
                $alert= '<p class= "msg_error">El cliente ya existe.</p>';
            }else{

               
                    $sql_update = mysqli_query($conex,"UPDATE tbl_ms_preguntas SET 
                    pregunta ='$pregunta'
                    WHERE id_pregunta = $id_pregunta");

                    if($sql_update){
                       // $alert= '<p class= "msg_save">El usuario se ha actualizado correctamente.</p>';
                        
                       echo '<script>
                        alert("La pregunta se ha actualizado correctamente");
                        window.location= "preguntas.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Edición de pregunta';
                        $descripcion= 'El usuario editó una pregunta';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }else{
                        //$alert= '<p class= "msg_error">Error al actualizar el usario.</p>';
                        echo '<script>
                        alert("Error al actualizar la pregunta");
                        window.location= "preguntaseditar.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Edición de pregunta';
                        $descripcion= 'Se produjo un error al editar la pregunta';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }
                
                
            }
            }
        
    }

    
?>