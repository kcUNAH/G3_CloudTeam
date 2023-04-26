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
include '../conex.php';
include '../../../php/bitacora.php';
   if(!empty($_POST)){
        $id_rol=$_POST['id_rol'];

        $query_check = mysqli_query($conex, "SELECT * FROM tbl_ms_usuario WHERE id_rol= $id_rol");
        if (mysqli_num_rows($query_check) > 0) {
            echo '<script>alert("No se puede eliminar esta ROL, ya que posee un usuario relacionado y para eliminar este ROL deberá cambiar el rol al usuario ");
            window.location= "rol.php";
            </script>';
        } else {
          $id_objeto==16;

       $query_delete = mysqli_query($conex,"DELETE FROM tbl_ms_rol WHERE id_rol = $id_rol");
      
       
       //$query_delete=mysqli_query($conex,"UPDATE tbl_ms_usuario SET estado_usuario = 2 WHERE id_usuario = $idusuario ");
       $usuarioprimero = "SELECT permiso_eliminacion FROM tbl_ms_permisos WHERE id_objeto = 11 ";
       $obtener_primer_ingreso = mysqli_query($conex,$usuarioprimero);
       $filai_primer = mysqli_fetch_array($obtener_primer_ingreso);
       $va_primer_ingreso = $filai_primer ['permiso_eliminacion'];
     
       if($va_primer_ingreso==1 && $id_objeto==16){
       
       if($query_delete){
           // header("Location: GestionUsuarios.php");
            
            echo '
            <script>
            alert("El ROL ha sido eliminado");
            window.location= "rol.php";
            </script>
            
            ';
        $codigoObjeto=4;
        $accion='Eliminar';
        $descripcion= 'Elimino el Rol existente';
        bitacora($codigoObjeto, $accion,$descripcion);
        }else{
            echo '
            <script>
            alert("Error al eliminar");
            window.location= "rol.php";
            </script>
            ';

            $codigoObjeto=4;
            $accion='Eliminar';
            $descripcion= 'El Usuario intento eliminar Un Rol';
            bitacora($codigoObjeto, $accion,$descripcion);


          
        }
        }else{
            if($va_primer_ingreso==0 && $id_objeto==11){
                echo
                '<script>
                alert("usted no tiene permisos para Eliminar un proveedor");
                window.location= "../proveedores.php";
                </script>
                ';
        }
      }
        }
      }
           
    
            
        
    
    //COMIENZO

    if(empty($_REQUEST['id'])){ //Validando que no vaya vacia
        //header('Location: GestionUsuarios.php');
        echo '
        <script>
        alert("Error, _rol vacio");
        window.location= "rol.php";
        </script>
        ';
    }else{
        
        include '../conex.php';
        $id_rol= $_REQUEST['id'];
        $query = mysqli_query($conex,"SELECT * FROM tbl_ms_rol 
        WHERE id_rol = $id_rol" );

        $result = mysqli_num_rows($query);

        if($result>0){ //MAyor a cero si existe el usuario
            while($data = mysqli_fetch_array($query)){

                $rol = $data['rol'];
                $descripcion = $data['descripcion'];
                $creado_por = $data['creado_por'];
                $fecha_creacion = $data['fecha_creacion'];
                $modificado_por = $data['modificado_por'];
                $fecha_modificacion = $data['fecha_modificacion'];
                $estado = $data['estado'];
                
                
            }
        }else{
               // header("Location: GestionUsuarios.php"); //Que regrese a gestion de usuarios si el id buscado no existe
                echo '
                <script>
                alert("Error, ROL no existe");
                window.location= "rol.php";
                </script>
                ';




            }
        }
      
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <title>Eliminar Cliente</title>
    <link rel="stylesheet" href="../../../accesos/CSS/elim.css">
     




    
  
  
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    

    
    
    

    
    
    <link rel="stylesheet" href="../../../../accesos/CSS/tablaproducto.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    
</head>

<body>


<div class="sidebar">
    <div class="logo-details">
      <i class='bx bxs-factory icon'></i>
      <div class="logo_name">FERRECOMM</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="../Menu.php">
          <i class='bx bxs-home'></i>
          <span class="links_name">Inicio</span>
        </a>
        <span class="tooltip">Inicio</span>
      </li>
      <li>
        <a href="../Menu_facturacion.php">
          <i class='bx bx-money'></i>
          <span class="links_name">Facturación</span>
        </a>
        <span class="tooltip">Facturación</span>
      </li>
      <li>
        <a href="../Compras.php">
          <i class='bx bxs-cart'></i>
          <span class="links_name">Compras</span>
        </a>
        <span class="tooltip">Compras</span>
      </li>
      <li>
        <a href="../Productos.php">
          <i class='bx bx-shopping-bag'></i>
          <span class="links_name">Productos</span>
        </a>
        <span class="tooltip">Productos</span>
      </li>
      <li>
            <a href="../categoria.php">
            <i class='bx bxs-category'></i>
                <span class="links_name">Categorias</span>
            </a>
            <span class="tooltip">Categorias</span>
        </li>
        <li>
            <a href="../productos/promocion.php">
            <i class='bx bxs-purchase-tag-alt'></i>
                <span class="links_name">Promociones</span>
            </a>
            <span class="tooltip">Promociones</span>
        </li>
      <li>
      <li>
        <a href="../Seguridad.php">
          <i class='bx bx-shield-quarter'></i>
          <span class="links_name">Seguridad</span>
        </a>
        <span class="tooltip">Seguridad</span>
      </li>
      <li>
        <a href="../Proveedores.php">
          <i class='bx bxs-user'></i>
          <span class="links_name">Proveedores</span>
        </a>
        <span class="tooltip">Proveedores</span>
      </li>
      <li>
        <a href="../Inventario.php">
          <i class='bx bx-package'></i>
          <span class="links_name">Inventario</span>
        </a>
        <span class="tooltip">Inventario</span>
      </li>
    

      <a href="../../../php/Cerrar_Seccion.php">
        <li class="profile">
          <i class='bx bx-log-out' id="log_out"></i>
          <div class="Salir">Cerrar Sesión</div>
        </li>
      </a>
    </ul>
  </div>
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
<h2>¿Esta seguro de eliminar el siguiente ROL?</h2>
<form action="" method="POST" enctype="multipart/form-data">
<?php ?>
    <section id="container">
        <div class="data_delete"></div>
        <input type="hidden" name="id_rol" value="<?php echo $id_rol;?>">
        <p>ROL: 
        <input type="text" class="field" name="rol" id="rol" value="<?=$rol?>" disabled>
        </p>
        <p>Descripcion: <input type="text" class="field" name="descripcion" id="descripcion" value="<?=$descripcion?>" disabled>
        </p>
        <p>Creado_por: <input type="text" class="field" name="creado_por" id="creado_por" value="<?=$creado_por?>" disabled>
        </p>
        <p>Fecha Creación: <input type="text" class="field" name="fecha_creacion" id="fecha_creacion" value="<?=$fecha_creacion?>" disabled>
        </p>
        </p>
        <p>Modificado Por: <input type="text" class="field" name="modificado_por" id="modificado_por" value="<?=$modificado_por?>" disabled>
        </p>
        </p>
        <p>Fecha Modificación: <input type="text" class="field" name="fecha_modificacion" id="fecha_modificacion" value="<?=$fecha_modificacion?>" disabled>
        </p>
        </p>
        <p>Estado: <input type="text" class="field" name="estado" id="estado" value="<?=$estado?>" disabled>
        </p>
    
    
        <form method="POST" action="">
            <input type="hidden" name="id_rol" value="<?php echo $id_rol; ?>">

            
            <input type="submit" value="Eliminar" class="btn_ok">
            <button type="reset" onclick="location.href='rol.php'" class="btn_cancelar">Cancelar</button>
        </form>
</form>
  
        

        
      
      
    </section>
    <script src="accesos/JS/scrip.js"> </script>
</body>

</html>