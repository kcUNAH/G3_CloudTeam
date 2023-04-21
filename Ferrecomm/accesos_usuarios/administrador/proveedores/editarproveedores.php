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
            if (empty($_POST['nombre_proveedor']) || empty($_POST['rtn_proveedor']) || empty($_POST['telefono'])  || empty($_POST['email']) || empty($_POST['direccion'])) //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
            {
                $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';    
            }else{
             $id_proveedor = $_POST['id_proveedor'];
             $nombre_proveedor = $_POST['nombre_proveedor'];
            $rtn_proveedor = $_POST['rtn_proveedor'];
            $telefono_proveedor = $_POST['telefono'];
            $pais= $_POST['pais'];
            $correo_proveedor= $_POST['email'];
             $direccion_proveedor = $_POST['direccion'];
             $telefono_final=$pais.$telefono_proveedor;
           
            $query = mysqli_query($conex,"SELECT * FROM tbl_proveedores WHERE (nombre_proveedor = ' $nombre_proveedor' AND id_proveedor != $id_proveedor) or (correo_proveedor = ' $correo_proveedor' AND id_proveedor != $id_proveedor)");

            $result = mysqli_fetch_array($query); //Almacena datos

            if($result > 0){ //Si ya existe manda eel mensaje 
                $alert= '<p class= "msg_error">El proveedor ya existe.</p>';
            }else{

               
                    $sql_update = mysqli_query($conex,"UPDATE tbl_proveedores SET nombre_proveedor='$nombre_proveedor',rtn_proveedor='$rtn_proveedor',telefono_proveedor=' $telefono_final',correo_proveedor='$correo_proveedor', 
                    direccion_proveedor='$direccion_proveedor' WHERE id_proveedor = $id_proveedor");

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

    $idproveedor  = $_REQUEST['id'];

    $sql = mysqli_query($conex,"SELECT * FROM tbl_proveedores WHERE id_proveedor = $idproveedor");
   
    $result_sql = mysqli_num_rows($sql);

//Si es igual a cero no hay registro
    if($result_sql == 0)
    {
        header('Location: ../Proveedor.php');
    }else{
        $option = ' ';
        while ($data = mysqli_fetch_array($sql)){
                $id_proveedor = $data["id_proveedor"];
                $nombre_proveedor = $data['nombre_proveedor'];
                $rtn_proveedor = $data['rtn_proveedor'];
                $telefono_proveedor = $data['telefono_proveedor'];
                $correo_proveedor = $data['correo_proveedor'];
                $direccion_proveedor = $data['direccion_proveedor'];  
           
                $telefono_proveedor_corto = substr($telefono_proveedor, 7);
    

      
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
        
        <a href="../../../php/Cerrar_Seccion.php">
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
                <style>
  select#country {
    width: 100px;
    padding: 5px;
    line-height: 1;
  }
  input#telefono {
    width: 350px;
    height: 30px;
    padding: 8px;
    font-size: 12px;
    border-radius: 1px;
    border: 1px solid #ccc;
  }
</style>

  <section class="home-section"></br>
      <h2>  Editar proveedores <i class='bx bx-edit'></i></h2>
      <div>
            <form action=" " method="POST" enctype="multipart/form-data" id="formulario">
          
        
            <input type="hidden"   name=" id_proveedor" id=" $id_proveedor "  value="<?php echo  $id_proveedor;?>" >

                <p>Nombre del proveedor:
				
                <input type="text" class="field" name="nombre_proveedor" id="nombre_proveedor"  style="text-transform:uppercase;" min="3" value="<?php echo $nombre_proveedor;?>" required pattern="^[a-zA-Z\s]+$" title="Este campo no permite números.">



                </p>

                    <p>RTN proveedor:
                    <input type="text" class="field" name="rtn_proveedor" id="rtn_proveedor" min="0" maxlength="15" value="<?php echo $rtn_proveedor;?>" required pattern="^(?!0)\d+$" title="El campo no puede consistir solo en dígitos 0.">


    
                    <label for="pais"  class="formulario__label">Telefono:</label>
            <div class="formulario__grupo" id="grupo__telefono">
				
<div class="formulario__grupo-input">

          
         
<select id="country" name="pais" id="country ">
    
        <option value="(+501)">BZ(+501)</option>
        <option value="(+502)">GT(+502)</option>
        <option value="(+503)">SV(+503)</option>
        <option value="(+504)">HN(+504)</option>
        <option value="(+505)">NI(+505)</option>
        <option value="(+506)">CR(+506)</option>
        <option value="(+507)">PA(+507)</option>
			<input type="text" class="field"  name="telefono" id="telefono"  maxlength="8" placeholder="Ingresa tu número de teléfono" value="<?php echo $telefono_proveedor_corto ?>"required pattern="^(?!0)\d+$" title="El campo no puede consistir solo en dígitos 0.">
				
					
                    </p>
                    <p>correo: 
                        
              
                            <input type="email" class="field"  name="email" id="email" placeholder="correo@correo.com"  value="<?php echo $correo_proveedor;?>">
                       
                    </p> 

              <p>direccion:
                
            
                    <input type="text" class="field"  name="direccion" id="direccion"  value="<?php echo $direccion_proveedor;?>" style="text-transform:uppercase;">
				
				
               </p>
              



    <button class="btn_agregar">Actualizar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='../proveedores.php'" class="btn_cancelar">Cancelar</button>
      </form>
     





</form>
</form>

</body>
</html>