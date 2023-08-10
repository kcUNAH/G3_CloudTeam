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

    
        if (!empty($_POST)){
            
            if(empty($_POST['nombre_descuento']) || empty($_POST['porcentaje_descontar'])  )  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
            {
                $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';    
        
            }else{
                
                $id_descuento = $_POST['id_descuento'];
                $nombre_descuento = $_POST['nombre_descuento'];
                $porcentaje_descontar = $_POST['porcentaje_descontar'];
              

                $query = mysqli_query($conex,"SELECT * FROM tbl_descuentos
                WHERE (nombre_descuento = '$nombre_descuento' AND id_descuentos != $id_descuento)");

            $result = mysqli_fetch_array($query); //Almacena datos

            if($result > 0){ //Si ya existe manda eel mensaje 
                $alert= '<p class= "msg_error">El cliente ya existe.</p>';
            }else{

               
                    $sql_update = mysqli_query($conex,"UPDATE tbl_descuentos SET 
                    nombre_descuento ='$nombre_descuento', porcentaje_descontar='$porcentaje_descontar'
                    WHERE id_descuentos = $id_descuento");

                    if($sql_update){
                       // $alert= '<p class= "msg_save">El usuario se ha actualizado correctamente.</p>';
                        
                       echo '<script>
                        alert("El descuento se ha actualizado correctamente");
                        window.location= "descuentos.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Edición de descuento';
                        $descripcion= 'El usuario editó un descuento';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }else{
                        //$alert= '<p class= "msg_error">Error al actualizar el usario.</p>';
                        echo '<script>
                        alert("Error al actualizar el descuento");
                        window.location= "editar_cliente.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'Se produjo un error al editar el descuento';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }
                
                
            }
            }
        
    }

    
?>