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
            if (empty($_POST['permiso_insercion']) || empty($_POST['permiso_eliminacion']) || empty($_POST['permiso_actualizacion'])  || empty($_POST['permiso_consultar'])) //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
            {
                $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';    
            }else{
            $id_permisos = $_POST['id_permisos'];
            $id_rol= $_POST['id_rol'];
            $id_objeto = $_POST['id_objeto'];
            $permiso_insercion = $_POST['permiso_insercion'];
            $permiso_eliminacion= $_POST['permiso_eliminacion'];
            $permiso_actualizacion = $_POST['permiso_actualizacion'];
            $permiso_consultar = $_POST['permiso_consultar'];
            
                $id_objeto=11;
                $d=strtotime("today");
                date("Y-m-d h:i:sa", $d);
          
                $sql_update = mysqli_query($conex,"UPDATE tbl_ms_permisos SET permiso_insercion='$permiso_insercion',permiso_eliminacion='$permiso_eliminacion',permiso_actualizacion='$permiso_actualizacion',permiso_consultar='$permiso_consultar',creado_por,='ADMINISTRADOR',  modificado_por='ADMINISTRADOR',fecha_creacion =CURTIME(),fecha_modificacion= CURTIME() WHERE id_permisos = $id_permisos");


                    if($sql_update){
                       // $alert= '<p class= "msg_save">El usuario se ha actualizado correctamente.</p>';
                        
                       echo '<script>
                        alert("El usuario se ha actualizado correctamente");
                        window.location= "../../administrador/proveedores.php";
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

    $sql = mysqli_query($conex,"SELECT * FROM tbl_ms_permisos WHERE id_permisos = $id_permisos ");
   
    $result_sql = mysqli_num_rows($sql);

//Si es igual a cero no hay registro
    if($result_sql == 0)
    {
        header('Location: ../permiso.php');
    }else{
        $option = ' ';
        while ($data = mysqli_fetch_array($sql)){
              
            $id_permisos = $data['id_permisos'];
            $id_rol= $data['id_rol'];
            $id_objeto = $data['id_objeto'];
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
  </style>
  <section class="home-section"></br>
      <h2>  Editar permisos<i class='bx bx-edit'></i></h2>
      <div>
            <form action=" " method="POST" enctype="multipart/form-data" id="formulario">

            <input type="hidden"   name=" id_permisos" id=" id_permisos "  value="<?php echo  $id_permisos;?>" >

                <p>id_rol:
				
		      <input type="text" class="field"  name="id_rol" id="id_rol" style="text-transform:uppercase;" value="<?php echo $id_rol;?>" disabled>
                </p>

                    <p>id_objeto:
			<input type="text" class="field"  name="id_objeto" id="id_objeto"   maxlength="2"  value="<?php echo $id_objeto;?>" disabled>
                    </p>
                    <p>permiso insertar:
         
			<input type="text" class="field"  name="permiso_insercion" id="permiso_insercion"  maxlength="2"  value="<?php echo $permiso_insercion;?>" >
				
					
                    </p>
                    <p>permiso eliminar: 
                        
              
                            <input type="text" class="field"  name="permiso_eliminacion" id="permiso_eliminacion" maxlength="2"  value="<?php echo $permiso_eliminacion;?>">
                       
                    </p> 

              <p>permiso actualización: 
                
            
                    <input type="text" class="field"  name="permiso_actualizacion" id="permiso_actualizacion" maxlength="2" value="<?php echo $permiso_actualizacion;?>" style="text-transform:uppercase;">
				
				
               </p>
               <p>permiso consultar: 
                
            
                    <input type="text" class="field"  name="permiso_consultar" id="permiso_consultar"maxlength="2"  value="<?php echo $permiso_consultar;?>" style="text-transform:uppercase;">
				
				
               </p>
              



    <button class="btn_agregar">Actualizar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='permiso.php'" class="btn_cancelar">Cancelar</button>
      </form>
     





</form>
</form>

</body>
</html>