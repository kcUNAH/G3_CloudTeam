<?php
session_start();
include '../../php/bitacora.php';
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
            
            if(empty($_POST['usuario']) || empty($_POST['nombre_usuario'])  )  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
            {
                $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';    
        
            }else{
                
                $id_usuario = $_POST['id_usuario'];
                $usuario = $_POST['usuario'];
                $nombre_usuario = $_POST['nombre_usuario'];
                $estado_usuario = $_POST['estado_usuario'];
                //$contrasenia = $_POST['contrasenia'];
                $rol = $_POST['id_rol'];
               // $fecha_vencimiento = $_POST['fecha_vencimiento'];
                $correo_electronico = $_POST['correo_electronico'];
               // $f_modificacion = $_POST['f_modificacion'];
                //Creacion automatica de fecha
                date_default_timezone_set('America/Mexico_City');
                 $fecha_modificacion =date("Y-m-d H:i:s");

                 if ($estado_usuario == 1) {
                    $estado_usuario = 'ACTIVO';
                }elseif ($estado_usuario == 2){
                    $estado_usuario = 'INACTIVO';
                }else{
                    $estado_usuario = 'NUEVO';
                }

                $query = mysqli_query($conex,"SELECT * FROM tbl_ms_usuario 
                WHERE (usuario = '$usuario' AND id_usuario != $id_usuario)
                or (correo_electronico = '$correo_electronico' AND id_usuario != $id_usuario)");

            $result = mysqli_fetch_array($query); //Almacena datos

            if($result > 0){ //Si ya existe manda eel mensaje 
                $alert= '<p class= "msg_error">El usuario ya existe.</p>';
            }else{

               
                    $sql_update = mysqli_query($conex,"UPDATE tbl_ms_usuario
                    SET nombre_usuario='$nombre_usuario', estado_usuario='$estado_usuario', id_rol='$rol', 
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
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'El Usuario Actualizo el registro';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }else{
                        //$alert= '<p class= "msg_error">Error al actualizar el usario.</p>';
                        echo '<script>
                        alert("Error al actualizar el usario");
                        window.location= "Editar.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'Se produjo un error al  Actualizo el registro';
                        bitacora($codigoObjeto, $accion,$descripcion);
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
            //$contrasenia = $data['contrasenia'];
           $rol = $data['rol'];
           $id_rol = $data['id_rol'];
           // $fecha_vencimiento = $data['fecha_vencimiento'];
            $correo_electronico = $data['correo_electronico'];
            //Creacion automatica de fecha
            date_default_timezone_set('America/Mexico_City');
            $fecha_modificacion =date("Y-m-d H:i:s");
            
            $option = '<option value="'.$id_rol.'"select>'.$rol.'</option>';

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
    <link rel="stylesheet" href="../../accesos/CSS/tablaproducto.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../accesos/CSS/Tablas.css">

    
    
    <link rel="stylesheet" href="../../accesos/CSS/registro.css">

    
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../../accesos/CSS/tablaproducto.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

      <?php include 'conex.php';?>
      <section id="container">




      <div class="sidebar">
    <div class="logo-details">
        <i class='bx bxs-factory icon'></i>
        <div class="logo_name">FERRECOMM</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
        <li>
            <a href="./Menu.php">
                <i class='bx bxs-home' ></i>
                <span class="links_name">Inicio</span>
            </a>
            <span class="tooltip">Inicio</span>
        </li>
        <li>
            <a href="Menu_facturacion.php">
                <i class='bx bx-money'></i>
                <span class="links_name">Facturación</span>
            </a>
            <span class="tooltip">Facturación</span>
        </li>
        <li>
            <a href="./Compras.php">
                <i class='bx bxs-cart'></i>
                <span class="links_name">Compras</span>
            </a>
            <span class="tooltip">Compras</span>
        </li>
        <li>
            <a href="./Productos.php">
                <i class='bx bx-shopping-bag'></i>
                <span class="links_name">Productos</span>
            </a>
            <span class="tooltip">Productos</span>
        </li>
        <li>
            <a href="./categoria.php">
            <i class='bx bxs-category'></i>
                <span class="links_name">Categorias</span>
            </a>
            <span class="tooltip">Categorias</span>
        </li>
        <li>
            <a href="./productos/promocion.php">
            <i class='bx bxs-purchase-tag-alt'></i>
                <span class="links_name">Promociones</span>
            </a>
            <span class="tooltip">Promociones</span>
        </li>
      <li>
        <li>
            <a href="./Seguridad.php">
                <i class='bx bx-shield-quarter'></i>
                <span class="links_name">Seguridad</span>
            </a>
            <span class="tooltip">Seguridad</span>
        </li>
        <li>
            <a href="./Proveedores.php">
                <i class='bx bxs-user'></i>
                <span class="links_name">Proveedores</span>
            </a>
            <span class="tooltip">Proveedores</span>
        </li>
        
        <li>
            <a href="./Inventario.php">
                <i class='bx bx-package'></i>
                <span class="links_name">Inventario</span>
            </a>
            <span class="tooltip">Inventario</span>
        </li>
        
        <a href="../../../index.php">
     <li class="profile">
         <i class='bx bx-log-out' id="log_out" ></i>
         <div class="Salir">Cerrar Sesión</div>
     </li>
    </a>
    </ul>
  </div>
  <style>
   form{
    background-color: #db881a;
    border-radius: 3px;
    padding: 20px;
    margin : 0 auto;
    width : 500px;
    font-size: 15px;
   }
   input, textarea{
    border: ;
    outline: none;

   }
   .field{
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
   }
   .field:focus{
    border-color: #18A383;
   }
   .btn_agregar{
    height: 45px;
    width: 227px;
    background: #2ad313;
    color: black;
    font-weight: bold;
    display: inline-block;
    border-radius: 5px;
    cursor: pointer;
    margin: 15px;
   }
   .btn_cancelar{
    height: 45px;
    width: 227px;
	background: #d1d40a;
	color: #000000;
	font-weight: bold;
    display: inline-block;
	border-radius: 5px;
	cursor: pointer;
    margin: 15px;
   }

   .alert{
    width: 100%;
    background: #d82606;
    border-radius: 6px;
    margin: 20px auto;
}

.msg_error{
    color: black;
}

.msg_save{
    color: greenyellow;
}

.alert p{
    padding: 10px;
}

  </style>












    <div class="form_register">
       
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <h1>Editar Usuario</h1>
        <form action="" method ="POST">
            <input type="hidden" name="id_usuario" style="text-transform:uppercase;" value="<?php echo $iduser;?>">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" style="text-transform:uppercase;" placeholder="usuario" value="<?php echo $usuario;?>">
            <label for="nombre_usuario">Nombre</label>
            <input type="text" name="nombre_usuario" id="nombre_usuario" style="text-transform:uppercase;" placeholder="Nombre Completo" value="<?php echo $nombre_usuario; ?>">

            <label for="Estado_usuario">Estado</label>
            <select name="estado_usuario" id="estado_usuario">
                <option value="1">ACTIVO</option>
                <option value="2">INACTIVO</option>
            </select>
            
            <label for="id_rol">Rol</label></br>
                
                <?php
           $query_prom = mysqli_query($conex,"SELECT * from tbl_ms_rol");
           $result_prom = mysqli_num_rows($query_prom)
        ?>
            
                <select name="id_rol" id="id_rol">
                   <?php
                     echo $option;
                      if($result_prom > 0){
                        while ($promo= mysqli_fetch_array($query_prom)) {
                        
                   ?>
                   <option value="<?php echo $promo["id_rol"]; ?>"><?php echo $promo["rol"]?> </option>
                   <?php
                   }
                   }

                   ?>
                </select>
            <label for="correo_electronico">Correo</label>
            <input type="correo_electronico" name="correo_electronico" id="correo_electronico" placeholder="correo_electronico" value="<?php echo $correo_electronico; ?>">
            
            <br>
            <button class="btn_agregar">Actualizar</button> 
            <button type="reset" onclick="location.href='GestionUsuarios.php'" class="btn_cancelar">Cancelar</button>




        </form>

    </div>

   </section>
   <script src="accesos/JS/scrip.js"> </script>
   
   <a class= "link_edit" href="GestionUsuarios.php">Volver</a>

</body>

</html>