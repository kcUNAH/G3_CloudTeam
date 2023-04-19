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
            if (empty($_POST['valor'])|| empty($_POST['fecha_modificacion']))  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
            {
                $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';    
            }else{
             $id_parametro = $_POST['id_parametro'];
             $parametro = $_POST['parametro'];
            $valor = $_POST['valor'];
            $fecha_creacion = $_POST['fecha_creacion'];
            $fecha_modificacion= $_POST['fecha_modificacion'];
            $creado_por = $_POST['creado_por'];
            $modificado_por=$_POST['modificado_por'];
            $id_usuario=$_POST['id_usuario'];
            $query = mysqli_query($conex,"SELECT * FROM tbl_ms_parametros WHERE (parametro = ' $parametro' AND id_parametro != $id_parametro)");

            $result = mysqli_fetch_array($query); //Almacena datos

            if($result > 0){ //Si ya existe manda eel mensaje 
                $alert= '<p class= "msg_error">El proveedor ya existe.</p>';
            }else{

               
                    $sql_update = mysqli_query($conex,"UPDATE bl_ms_parametros SET parametro='$parametro',valor='$valor',fecha_creacion=' $fecha_creacion',fecha_modificacion='$fecha_modificacion', 
                   creado_por='$creado_por',modificado_por='$modificado_por', id_usuario='$id_usuario' WHERE id_parametro = $id_parametro");

                    if($sql_update){
                       // $alert= '<p class= "msg_save">El usuario se ha actualizado correctamente.</p>';
                        
                       echo '<script>
                        alert("El usuario se ha actualizado correctamente");
                        window.location= "../../administrador/proveedores.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'proveedor Actualizo ';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }else{
                        //$alert= '<p class= "msg_error">Error al actualizar el usario.</p>';
                        echo '<script>
                        alert("Error al actualizar el usario");
                        window.location= "editarproveedores.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'Se produjo un error al  Actualizo el  proveedor';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }
                
                
            }
            }
        
    }

//Si no existe el usuario me redirecciona a gestion de usuario QUITAR EL !
    if(empty($_REQUEST['id']))
    {
        header('Location: ../../administrador/proveedores.php');
        mysqli_close($conex);
    }

    $idparametro  = $_REQUEST['id'];

    $sql = mysqli_query($conex,"SELECT * FROM tbl_ms_parametros WHERE id_parametro = $idparametro");
   
    $result_sql = mysqli_num_rows($sql);

//Si es igual a cero no hay registro
    if($result_sql == 0)
    {
        header('Location: ../Proveedor.php');
    }else{
        $option = ' ';
        while ($data = mysqli_fetch_array($sql)){
                $id_parametro = $data['id_parametro'];
                $parametro = $data['parametro'];
                $valor = $data['valor'];
                $fecha_creacion = $data['fecha_creacion'];
            $fecha_modificacion= $data['fecha_modificacion'];
            $creado_por = $data['creado_por'];
            $modificado_por=$data['modificado_por'];
            $id_usuario=$data['id_usuario'];
           
    

      
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
            <a href="../Seguridad.php">
                <i class='bx bx-shield-quarter'></i>
                <span class="links_name">Seguridad</span>
            </a>
            <span class="tooltip">Seguridad</span>
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

  </style>
  <section class="home-section"></br>
      <h2>  Editar parametros <i class='bx bx-edit'></i></h2>
      <div>
            <form action=" " method="POST" enctype="multipart/form-data" id="formulario">

            <input type="hidden" name=" id_parametro" id="id_parametro "  value="<?php echo $id_parametro;?>" >

                <p>Nombre del parametro:
				
                <input type="text"  class="field"   name="parametro" id=" parametro "  value="<?php echo  $parametro;?>" disabled>
                </p>

                    <p>Valor parametro:
			<input type="text" class="field"  name="$valor " value="<?php echo $valor?>" required >
                    </p>
                    <p>fecha de creacion:
        
			<input type="text" class="field"  name="fecha_creacion" value="<?php echo $fecha_creacion;?>" disabled>
				
					
                    </p>
                    <p>Fecha de modificación: 
                        
              
                            <input type="date" class="field"  name="fecha_modificacion" id="fecha_modificacion"   value="<?php echo $fecha_modificacion;?>">
                       
                    </p> 

              <p>Creado por:
                    <input type="text" class="field"  name="creado_por" id="creado_por"  value="<?php echo $creado_por;?>" disabled>
				
               </p>
               <p>Modificado por:
            
               <input type="text" class="field"  name="modificado_por" id="modificado_por"  value="<?php echo $modificado_por;?>"disabled>
				
				
                </p>
                </p>
                 
                <p>id_usuario:
                 <input type="text" class="field"  name="id_usaurio" id="id_usaurio"  value="<?php echo $id_usuario;?>"disabled>
                  
                  
                  </p>


    <button class="btn_agregar" href="editarparametros.php">Actualizar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='parametros.php'" class="btn_cancelar">Cancelar</button>
      </form>
     







</body>
</html>