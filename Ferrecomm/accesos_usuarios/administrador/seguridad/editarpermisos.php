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
         
        if (!empty($_POST)){
            $alert="";
            if (empty($_POST['id_permisos']) ) //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
            {
                $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';    
            }else{
              
        
         // Conexión a la base de datos

// Actualización de los valores de los checkboxes
$creado_por="ADMINISTRADOR";
$modificado_por="ADMINISTRADOR";
$d=strtotime("today");
date("Y-m-d h:i:sa", $d);

$host = 'localhost'; // tu servidor de base de datos
$dbname = 'ferrecomm_db'; // tu base de datos
$user = 'root'; // tu usuario
$password = ""; // tu contraseña



$id_permisos = $_POST['id_permisos'];
$permiso_insercion = $_POST['permiso_insercion'];
$permiso_eliminacion= $_POST['permiso_eliminacion'];
$permiso_actualizacion = $_POST['permiso_actualizacion'];
$permiso_consultar = $_POST['permiso_consultar'];



$sql_update = mysqli_query($conex,"UPDATE tbl_ms_permisos SET 
permiso_insercion = '$permiso_insercion', permiso_eliminacion ='$permiso_eliminacion', 
permiso_actualizacion = '$permiso_actualizacion' , permiso_consultar = '$permiso_consultar '
WHERE id_permisos = $id_permisos");

              

                    if($sql_update){
                       // $alert= '<p class= "msg_save">El usuario se ha actualizado correctamente.</p>';
                        
                       echo '<script>
                        alert("El permiso se ha actualizado correctamente");
                        window.location= "permiso.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'permisos Actualizo ';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }else{
                        //$alert= '<p class= "msg_error">Error al actualizar el usario.</p>';
                        echo '<script>
                        alert("Error al actualizar el usario");
                        window.location= "editarpermisos.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'Se produjo un error al  Actualizo el permiso';
                        bitacora($codigoObjeto, $accion,$descripcion);
                

                    }
                }
  
  

  }
  

         

//Si no existe el usuario me redirecciona a gestion de usuario QUITAR EL !
    if(empty($_REQUEST['id']))
    {
        header('Location: ../../administrador/permiso.php');
        mysqli_close($conex);
    }

    $id_permisos = $_REQUEST['id'];

    $sql= mysqli_query($conex,"SELECT p.id_permisos, r.rol , o.objeto , p.permiso_insercion, p.permiso_eliminacion, p.permiso_actualizacion, p.permiso_consultar, p.creado_por,
 p.fecha_creacion, p.modificado_por, p.fecha_modificacion 
 FROM tbl_ms_permisos p INNER JOIN tbl_ms_rol r on p.id_rol = r.id_rol INNER JOIN tbl_ms_objetos o on p.id_objeto = o.id_objeto WHERE id_permisos= $id_permisos");
    
  
    $result_sql = mysqli_num_rows($sql);

//Si es igual a cero no hay registro
    if($result_sql == 0)
    {
        header('Location: ../permiso.php');
    }else{
        $option = ' ';
        while ($data = mysqli_fetch_array($sql)){
          
     
            $id_permisos = $data['id_permisos'];
            $id_rol= $data['rol'];
            $id_objeto =$data['objeto'];
            $permiso_insercion = $data['permiso_insercion'];
            $permiso_eliminacion= $data['permiso_eliminacion'];
            $permiso_actualizacion = $data['permiso_actualizacion'];
            $permiso_consultar = $data['permiso_consultar'];
           
           
    

      
    }

    }
    
?> 







<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../../accesos/CSS/tablaproducto.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
        <i class='bx bxs-factory icon'></i>
        <div class="logo_name">FERRECOMM</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
        <li>
            <a href="../Menu.php">
                <i class='bx bxs-home' ></i>
                <span class="links_name">Inicio</span>
            </a>
            <span class="tooltip">Inicio</span>
        </li>
        <li>
            <a href="../Facturacion.php">
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
        
        <a href="../../php/Cerrar_Seccion.php">
        <li class="profile">
          <i class='bx bx-log-out' id="log_out"></i>
          <div class="Salir">Cerrar Sesión</div>
        </li>
      </a>
    </ul>
  </div>
  <div>
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

   .formulario_input{
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
   }
   .field:focus{
    border-color: #18A383;
   }
   .btn_agregar{
    height: 45px;
	line-height: 45px;
	background: #2ad313;
	color: #000000;
	font-weight: bold;
	border: none;
	border-radius: 3px;
	cursor: pointer;
	transition: .1s ease all;
    width: 227px;
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

   .warnings{
      width: 200px;
      text-align: center;
      margin: auto;
      color: #B06AB3;
      padding-top: 20px;
   }


   @media screen and (max-width: 800px) {
	.formulario {
		grid-template-columns: 1fr;
	}

	.formulario__grupo-terminos, 
	.formulario__mensaje,
	.formulario__grupo-btn-enviar {
		grid-column: 1;
	}

	.formulario__btn {
		width: 100%;
	}
}
.switch-button__checkbox {
  display: none;
}

.switch-button__label {
  display: inline-block;
  width: 40px;
  height: 20px;
  background-color: #ccc;
  border-radius: 20px;
  position: relative;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

.switch-button__label::before {
  content: "";
  position: absolute;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background-color: #fff;
  top: 2px;
  left: 2px;
  transition: left 0.3s ease-in-out;
}

.switch-button__checkbox:checked + .switch-button__label {
  background-color: #4CAF50;
}

.switch-button__checkbox:checked + .switch-button__label::before {
  left: 22px;
}

  </style>
  <section class="home-section"></br>
      <h2>  Editar permisos<i class='bx bx-edit'></i></h2>
      <div>
            <form action=" " method="POST" enctype="multipart/form-data" id="">

            <input type="hidden"   name=" id_permisos" id=" id_permisos "  value="<?php echo  $id_permisos;?>" >

            <p>Rol:
				
                <input type="text" class="field"  name="id_rol" id="id_rol" style="text-transform:uppercase;" value="<?php echo   $id_rol;?>" disabled>
                  </p>
  
                      <p>permiso Asignado
              <input type="text" class="field"  name="id_objeto" id="id_objeto"   maxlength="2"  value="<?php echo $id_objeto;?>" disabled>
                      </p>  
<label><input type="hidden" name="permiso_insercion" value="0"><input type="checkbox" name="permiso_insercion" value="1" <?php if ($permiso_insercion == 1) echo "checked"; ?>> Permiso de inserción</label></br>

<label><input type="hidden" name="permiso_eliminacion" value="0"><input type="checkbox" name="permiso_eliminacion" value="1" <?php if ($permiso_eliminacion == 1) echo "checked"; ?>> Permiso de eliminación</label> </br>

<label><input type="hidden" name="permiso_actualizacion" value="0"><input type="checkbox" name="permiso_actualizacion" value="1" <?php if ($permiso_actualizacion == 1) echo "checked"; ?>> Permiso de actualización</label></br>

<label><input type="hidden" name="permiso_consultar" value="0"><input type="checkbox" name="permiso_consultar" value="1" <?php if ($permiso_consultar == 1) echo "checked"; ?>> Permiso de consulta</label></br>


    <button type="submit" class="btn_agregar">Actualizar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='permiso.php'" class="btn_cancelar">Cancelar</button>
      </form>
     





</form>
</form>

</body>
</html>