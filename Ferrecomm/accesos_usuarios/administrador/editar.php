<?php
session_start();

if(!isset ($_SESSION['usuario'])){
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
        
        include 'conex.php';

    
        if (!empty($_POST)){
            
            if(empty($_POST['usuario']) || empty($_POST['nombre_usuario']) || empty($_POST['contrasenia']) )  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
            {
                $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';    
        
            }else{
                
                $id_usuario = $_POST['id_usuario'];
                $usuario = $_POST['usuario'];
                $nombre_usuario = $_POST['nombre_usuario'];
                $estado_usuario = $_POST['estado_usuario'];
                $contrasenia = $_POST['contrasenia'];
                $rol = $_POST['id_rol'];
               // $fecha_vencimiento = $_POST['fecha_vencimiento'];
                $correo_electronico = $_POST['correo_electronico'];
               // $f_modificacion = $_POST['f_modificacion'];
                //Creacion automatica de fecha
                date_default_timezone_set('America/Mexico_City');
                 $fecha_modificacion =date("Y-m-d H:i:s");

                 if($estado_usuario == 1){
                    $estado_usuario= 'ACTIVO';
                }else{
                    $estado_usuario= 'INACTIVO';
                }

                $query = mysqli_query($conex,"SELECT * FROM tbl_ms_usuario 
                WHERE (usuario = '$usuario' AND id_usuario != $id_usuario)
                or (correo_electronico = '$correo_electronico' AND id_usuario != $id_usuario)");

            $result = mysqli_fetch_array($query); //Almacena datos

            if($result > 0){ //Si ya existe manda eel mensaje 
                $alert= '<p class= "msg_error">El usuario ya existe.</p>';
            }else{

               
                    $sql_update = mysqli_query($conex,"UPDATE tbl_ms_usuario
                    SET nombre_usuario='$nombre_usuario', estado_usuario='$estado_usuario',contrasenia='$contrasenia', id_rol='$rol', 
                    correo_electronico='$correo_electronico',
                    fecha_modificacion='$fecha_modificacion'
                    WHERE id_usuario = $id_usuario");

                    if($sql_update){
                       // $alert= '<p class= "msg_save">El usuario se ha actualizado correctamente.</p>';
                        
                       echo '<script>
                        alert("El usuario se ha actualizado correctamente");
                        window.location= "GestionUsuarios.php";
                        </script>
                        ';
                    }else{
                        //$alert= '<p class= "msg_error">Error al actualizar el usario.</p>';
                        echo '<script>
                        alert("Error al actualizar el usario");
                        window.location= "Editar.php";
                        </script>
                        ';
                    }
                
                
            }
            }
        
    }

//Si no existe el usuario me redirecciona a gestion de usuario QUITAR EL !
    if(empty($_GET['id']))
    {
        header('Location: GestionUsuarios.php');
    }

    $iduser  = $_GET['id'];

    $sql = mysqli_query($conex,"SELECT u.id_usuario, u.usuario, u.nombre_usuario, u.estado_usuario, u.contrasenia, 
    (r.rol), u.fecha_ultima_conexion, u.preguntas_contestadas,u.primer_ingreso, u.correo_electronico, 
     u.creado_por, u.fecha_creacion, u.fecha_modificacion as id_rol, 
     (r.rol) as rol 
    FROM tbl_ms_usuario u 
    INNER JOIN tbl_ms_rol r 
    on u.id_rol = r.id_rol 
    WHERE id_usuario = $iduser ");

    $result_sql = mysqli_num_rows($sql);

//Si es igual a cero no hay registro
    if($result_sql == 0)
    {
        header('Location: GestionUsuarios.php');
    }else{
        $option = ' ';
        while ($data = mysqli_fetch_array($sql)){
            $iduser  = $data['id_usuario'];
            $usuario = $data['usuario'];
            $nombre_usuario = $data['nombre_usuario'];
            $estado_usuario = $data['estado_usuario'];
            $contrasenia = $data['contrasenia'];
           // $rol = $data['id_rol'];
           // $id_rol = $data['id_rol'];
           // $fecha_vencimiento = $data['fecha_vencimiento'];
            $correo_electronico = $data['correo_electronico'];
            //Creacion automatica de fecha
            date_default_timezone_set('America/Mexico_City');
            $fecha_modificacion =date("Y-m-d H:i:s");
            
        if($estado_usuario == 1){
            $estado= 'ACTIVO';
        }else{
            $estado= 'INACTIVO';
        }


      
    }

    }
    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../accesos/CSS/Tablas.css">
    <link rel="stylesheet" href="../../accesos/CSS/registro.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de Usuarios</title>
    <link rel="stylesheet" href="accesos/CSS/registro.css">
    <link rel="stylesheet" href="accesos/CSS/Estilos.css">
</head>

<body>

      <?php include 'conex.php';?>
      <section id="container">

    <div class="form_register">
        <h1>Editar Usuario</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

        <form action="" method ="POST">
            <input type="hidden" name="id_usuario" value="<?php echo $iduser;?>">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" placeholder="usuario" value="<?php echo $usuario;?>">
            <label for="nombre_usuario">Nombre</label>
            <input type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Nombre Completo" value="<?php echo $nombre_usuario; ?>">

            <label for="Estado_usuario">Estado</label>
            <select name="estado_usuario" id="estado_usuario">
                <option value="1">ACTIVO</option>
                <option value="2">INACTIVO</option>
            </select>
            <label for="contrasenia">Contraseña</label>
            <input type="password" name="contrasenia" id="contrasenia" placeholder="contrasenia" value="<?php echo $contrasenia; ?>">

            <label for="id_rol">ROL</label>
            <select name="id_rol" id="id_rol">
                <option value="1">Administrador</option>
                <option value="2">Vendedor</option>
                <option value="3">Default</option>
            </select>
            <label for="correo_electronico">Correo</label>
            <input type="correo_electronico" name="correo_electronico" id="correo_electronico" placeholder="correo_electronico" value="<?php echo $correo_electronico; ?>">
            
            <input type="submit" value="Modificar Usuario" class="btn_save">


        </form>

    </div>

   </section>
   <script src="accesos/JS/scrip.js"> </script>
   
   <a class= "link_edit" href="GestionUsuarios.php">Volver</a>

</body>

</html>