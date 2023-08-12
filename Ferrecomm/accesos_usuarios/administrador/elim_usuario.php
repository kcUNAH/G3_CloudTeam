
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
            $descripcion= 'El Usuario intento eliminar Un registro';
            bitacora($codigoObjeto, $accion,$descripcion);


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
    
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="../../accesos/CSS/elim.css">
     




    
  
  
    <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
    

    
    
    

    
    
    <link rel="stylesheet" href="../../../accesos/CSS/tablaproducto.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    
  <div class="sidebar">
    <div class="logo-details">
        <i class='bx bxs-factory icon'></i>
        <div class="logo_name">FERRECOMM</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
        <li>
            <a href="Menu.php">
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
            <a href="Compras.php">
                <i class='bx bxs-cart'></i>
                <span class="links_name">Compras</span>
            </a>
            <span class="tooltip">Compras</span>
        </li>
        <li>
            <a href="Comprobante.php">
            <i class='bx bx-spreadsheet'></i>
                <span class="links_name">Comprobantes</span>
            </a>
            <span class="tooltip">Comprobantes compras</span>
        </li>
        <li>
            <a href="Productos.php">
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
            <a href="productos/promocion.php">
            <i class='bx bxs-purchase-tag-alt'></i>
                <span class="links_name">Promociones</span>
            </a>
            <span class="tooltip">Promociones</span>
        </li>
        <li>
            <a href="Seguridad.php">
                <i class='bx bx-shield-quarter'></i>
                <span class="links_name">Seguridad</span>
            </a>
            <span class="tooltip">Seguridad</span>
        </li>
        <li>
            <a href="Proveedores.php">
                <i class='bx bxs-user'></i>
                <span class="links_name">Proveedores</span>
            </a>
            <span class="tooltip">Proveedores</span>
        </li>

        <li>
            <a href="Inventario.php">
                <i class='bx bx-package'></i>
                <span class="links_name">Inventario</span>
            </a>
            <span class="tooltip">Inventario</span>
        </li>
      

        <a href="../../php/Cerrar_Seccion.php">
     <li class="profile">
         <i class='bx bx-log-out' id="log_out" ></i>
         <div class="Salir">Cerrar Sesión</div>
     </li>
    </a>
    </ul>
   </div>
  </div>
    
</head>

<body>

  <section class="home-section">
    









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
   
   input[type="text"]:disabled {
  background: #ffff;
   }

   .field{
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
   }
   .field:focus{
    border-color: #18A383;
   }
   .btn_cancelar{
    height: 45px;
	line-height: 45px;
	background: #d1d40a;
	color: #000000;
	font-weight: bold;
	border: none;
	border-radius: 3px;
	cursor: pointer;
	transition: .1s ease all;
    width: 227px;
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

span{
    background: #ffff;
    border: ;
    outline: none;
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
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
    
   }

    .btn_ok{
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
</style>

<section class="home-section"></br>
<h2>¿Esta seguro de eliminar el siguiente registro?</h2>
<form action="" method="POST" enctype="multipart/form-data">
<?php ?>
    <section id="container">
        <div class="data_delete"></div>
        <input type="hidden" name="id_producto" value="<?php echo $idusuario;?>">
        <p>Usuario: 
        <input type="text" class="field" name="usuario" id="usuario" value="<?=$usuario?>" disabled>
        </p>
        <p>Nombre: <input type="text" class="field" name="nombre_usuario" id="nombre_usuario" value="<?=$nombre_usuario?>" disabled>
        </p>
        <p>Estado: <input type="text" class="field" name="estado_usuario" id="estado_usuario" value="<?=$estado_usuario?>" disabled>
        </p>
        <p>Rol: <input type="text" class="field" name="rol" id="rol" value="<?=$rol?>" disabled>
        </p>
        <p>Ultima Conexión: <input type="text" class="field" name="fecha_ultima_conexion" id="fecha_ultima_conexion" value="<?=$fecha_ultima_conexion?>" disabled>
        </p>
        <p>Primer Ingreso: <input type="text" class="field" name="primer_ingreso" id="primer_ingreso" value="<?=$primer_ingreso?>" disabled>
        </p>
        <p>Fecha Vencimiento: <input type="text" class="field" name="fecha_vencimiento" id="fecha_vencimiento" value="<?=$fecha_vencimiento?>" disabled>
        </p>
        <p>Email: <input type="text" class="field" name="correo_electronico" id="correo_electronico" value="<?=$correo_electronico?>" disabled>
        </p>
        <p>Creado Por: <input type="text" class="field" name="creado_por" id="creado_por" value="<?=$creado_por?>" disabled>
        </p>
        <p>Fecha Creación: <input type="text" class="field" name="fecha_creacion" id="fecha_creacion" value="<?=$fecha_creacion?>" disabled>
        </p>
        <p>Fecha Modificación: <input type="text" class="field" name="fecha_modificacion" id="fecha_modificacion" value="<?=$fecha_modificacion?>" disabled>
        </p>
        

        <form method="POST" action="">
            <input type="hidden" name="id_usuario" value="<?php echo $idusuario; ?>">

            
            <input type="submit" value="Eliminar" class="btn_ok">
            <button type="reset" onclick="location.href='GestionUsuarios.php'" class="btn_cancelar">Cancelar</button>
        </form>
</form>
  
        

        
      
      
    </section>
    <script src="accesos/JS/scrip.js"> </script>
</body>

</html>