


<?php
        
        include '../conex.php';

    
        if (!empty($_POST)){
            
            if(empty($_POST['dni_cliente']) || empty($_POST['nombre_cliente'])  )  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
            {
                $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';    
        
            }else{
                
                $id_cliente = $_POST['id_cliente'];
                $dni_cliente = $_POST['dni_cliente'];
                $nombre_cliente = $_POST['nombre_cliente'];
                $telefono_cliente = $_POST['telefono_cliente'];
                $direccion_cliente = $_POST['direccion_cliente'];
              

                $query = mysqli_query($conex,"SELECT * FROM tbl_clientes 
                WHERE (nombre_cliente = '$nombre_cliente' AND id_cliente != $id_cliente)
                or (dni_cliente = '$dni_cliente' AND id_cliente != $id_cliente)");

            $result = mysqli_fetch_array($query); //Almacena datos

            if($result > 0){ //Si ya existe manda eel mensaje 
                $alert= '<p class= "msg_error">El cliente ya existe.</p>';
            }else{

               
                    $sql_update = mysqli_query($conex,"UPDATE tbl_clientes SET 
                    dni_cliente='$dni_cliente', nombre_cliente='$nombre_cliente', 
                    telefono_cliente='$telefono_cliente', 
                    direccion_cliente='$direccion_cliente'
                    WHERE id_cliente = $id_cliente");

                    if($sql_update){
                       // $alert= '<p class= "msg_save">El usuario se ha actualizado correctamente.</p>';
                        
                       echo '<script>
                        alert("El cliente se ha actualizado correctamente");
                        window.location= "clientes.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'El Usuario Actualizo el cliente';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }else{
                        //$alert= '<p class= "msg_error">Error al actualizar el usario.</p>';
                        echo '<script>
                        alert("Error al actualizar el cliente");
                        window.location= "editar_cliente.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'Se produjo un error al  Actualizo el cliente';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }
                
                
            }
            }
        
    }

//Si no existe el usuario me redirecciona a gestion de usuario QUITAR EL !
    if(empty($_GET['id']))
    {
        header('Location: clientes.php');
    }

    $iduser  = $_GET['id'];

    $sql = mysqli_query($conex,"SELECT id_cliente, dni_cliente, nombre_cliente, telefono_cliente, direccion_cliente
     FROM tbl_clientes 
    WHERE id_cliente = $iduser ");

    $result_sql = mysqli_num_rows($sql);

//Si es igual a cero no hay registro
    if($result_sql == 0)
    {
        header('Location: clientes.php');
    }else{
        $option = ' ';
        while ($data = mysqli_fetch_array($sql)){
            $iduser  = $data['id_cliente'];
            $dni_cliente = $data['dni_cliente'];
            $nombre_cliente = $data['nombre_cliente'];
            $telefono_cliente = $data['telefono_cliente'];
            $direccion_cliente = $data['direccion_cliente'];
      
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
     <?php include "../productos/menu.php"; ?>
   </head>
<body>
  
  <section class="home-section">
    
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
  <section class="home-section"></br>
  <h2>  Editar Clientes <i class='bx bxs-user'></i></h2>
      
  <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        
        <form id="formulario" action="" method ="POST">
        <input type="hidden" name="id_cliente" value="<?php echo $iduser;?>">
            
            <div class="formulario__grupo" id="grupo__dni_cliente">
				<label for="dni_cliente" class="formulario__label">DNI</label>
				<div class="formulario__grupo-input">
			    <input type="text" class="field"  name="dni_cliente" id="dni_cliente" maxlength="13"  pattern="[0-9]+" value="<?=$dni_cliente?>" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El DNI solo debe contener numeros, no ingresar guiones y espacios</p>
			    </div>

            <div class="formulario__grupo" id="grupo__nombre_cliente">
				<label for="nombre_cliente" class="formulario__label" >Nombre Cliente</label>
				<div class="formulario__grupo-input">
                <input type="text" class="field"  name="nombre_cliente" id="nombre_cliente" style="text-transform:uppercase;" value="<?=$nombre_cliente?>" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre del cliente tiene que contener letras y contener 3 a 25 de las mismas</p>
			    </div>

            <div class="formulario__grupo" id="grupo__telefono_cliente">
				<label for="telefono_cliente" class="formulario__label">Telefono:</label>
				<div class="formulario__grupo-input">
			<input type="text" class="field"  name="telefono_cliente" id="telefono_cliente"  maxlength="8" value="<?=$telefono_cliente?>"  required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El telefono solo puede contener numeros</p>
			    </div>

                   <div class="formulario__grupo" id="grupo__direccion_cliente">
				<label for="direccion_cliente" class="formulario__label">Dirección</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="direccion_cliente" id="direccion_cliente" style="text-transform:uppercase;" value="<?=$direccion_cliente?>" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La direccion debe de conter mas de 3 letras</p>
			    </div>

            </br>
            
            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>

      <button type="submit" class="btn_agregar">Agregar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='clientes.php'" class="btn_cancelar">Cancelar</button>
      </form>

                    <script>
                        function cambiarAMayusculas(elemento) {
                            let texto = elemento.value;
                            elemento.value = texto.toUpperCase();
                        }
                    </script>

                    
                </form>




                
                    <?php
            
        
                    ?>
                </form>
            </form>



        </div>
        <script src="formulario_cliente_editar.js"></script>

<script>
let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");

closeBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("open");
  menuBtnChange();
});

function menuBtnChange() {
 if(sidebar.classList.contains("open")){
   closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
 }else {
   closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
 }
}
  </script>

<a href="clientes.php" class="btn_pdf">Atrás</a>
</body>
</html>