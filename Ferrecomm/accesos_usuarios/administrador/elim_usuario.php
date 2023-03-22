<?php 
session_start();
include 'conex.php';
include '../../php/bitacora.php';
   if(!empty($_POST)){
        $idusuario=$_POST['id_usuario'];

        

       $query_delete = mysqli_query($conex,"DELETE FROM tbl_ms_usuario WHERE id_usuario = $idusuario ");
      
       
       //$query_delete=mysqli_query($conex,"UPDATE tbl_ms_usuario SET estado_usuario = 2 WHERE id_usuario = $idusuario ");
       
       
       if($query_delete){
           // header("Location: GestionUsuarios.php");
            
            echo '
            <script>
            alert("El usuario ha sido eliminado");
            window.location= "GestionUsuarios.php";
            </script>
            
            ';
        $codigoObjeto=4;
        $accion='Eliminar';
        $descripcion= 'Elimino el Usuario existente';
        bitacora($codigoObjeto, $accion,$descripcion);
        }else{
            echo '
            <script>
            alert("Error al eliminar");
            window.location= "GestionUsuarios.php";
            </script>
            ';

            $codigoObjeto=4;
            $accion='Eliminar';
            $descripcion= 'El Usuario Elimino Un registro';
            bitacora2($codigoObjeto, $accion,$descripcion);


        }
   }

    //COMIENZO

    if(empty($_REQUEST['id'])){ //Validando que no vaya vacia
        //header('Location: GestionUsuarios.php');
        echo '
        <script>
        alert("Error, usuario vacio");
        window.location= "GestionUsuarios.php";
        </script>
        ';
    }else{
        
        include 'conex.php';
        $idusuario = $_REQUEST['id'];
        $query = mysqli_query($conex,"SELECT u.id_usuario, u.usuario, u.nombre_usuario, u.estado_usuario, u.contrasenia, r.rol, 
        u.fecha_ultima_conexion, u.preguntas_contestadas, u.primer_ingreso, u.fecha_vencimiento, u.correo_electronico, 
        u.creado_por, u.fecha_creacion, u.fecha_modificacion
        FROM tbl_ms_usuario u INNER JOIN tbl_ms_rol r ON u.id_rol = r.id_rol WHERE u.id_usuario = $idusuario" );

        $result = mysqli_num_rows($query);

        if($result>0){ //MAyor a cero si existe el usuario
            while($data = mysqli_fetch_array($query)){

                $usuario = $data['usuario'];
                $nombre_usuario = $data['nombre_usuario'];
                $estado_usuario = $data['estado_usuario'];
                $contrasenia = $data['contrasenia'];
                $rol = $data['rol'];
                $fecha_ultima_conexion = $data['fecha_ultima_conexion'];
                $preguntas_contestadas = $data['preguntas_contestadas'];
                $primer_ingreso = $data['primer_ingreso'];
                $fecha_vencimiento = $data['fecha_vencimiento'];
                $correo_electronico = $data['correo_electronico'];
                $creado_por = $data['creado_por'];
                $fecha_creacion = $data['fecha_creacion'];
                $fecha_modificacion = $data['fecha_modificacion'];
                
            }
        }else{
               // header("Location: GestionUsuarios.php"); //Que regrese a gestion de usuarios si el id buscado no existe
                echo '
                <script>
                alert("Error, usuario no existe");
                window.location= "GestionUsuarios.php";
                </script>
                ';




            }
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="../../accesos/CSS/elim.css">
</head>

<body>
    <?php ?>
    <section id="container">
        <div class="data_delete"></div>
        <h2>¿Esta seguro de eliminar el siguiente registro?</h2>
        <p>Usuario: <span><?php echo $usuario; ?></span></p>
        <p>Nombre: <span><?php echo $nombre_usuario; ?></span></p>
        <p>Estado: <span><?php echo $estado_usuario; ?></span></p>
        <p>Rol: <span><?php echo $rol; ?></span></p>
        <p>Ultima Conexión: <span><?php echo $fecha_ultima_conexion; ?></span></p>
        <p>Primer Ingreso: <span><?php echo $primer_ingreso; ?></span></p>
        <p>Fecha Vencimiento: <span><?php echo $fecha_vencimiento; ?></span></p>
        <p>Email: <span><?php echo $correo_electronico; ?></span></p>
        <p>Creado Por: <span><?php echo $creado_por; ?></span></p>
        <p>Fecha Creación: <span><?php echo $fecha_creacion; ?></span></p>
        <p>Fecha Modificación: <span><?php echo $fecha_modificacion; ?></span></p>
        

        <form method="POST" action="">
            <input type="hidden" name="id_usuario" value="<?php echo $idusuario; ?>">

            <a href="GestionUsuarios.php" class="btn_cancel">Cancelar</a>
            <input type="submit" value="Aceptar" class="btn_ok">
        </form>


    </section>
    <script src="accesos/JS/scrip.js"> </script>
</body>

</html>