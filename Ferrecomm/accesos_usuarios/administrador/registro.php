<?php
session_start();


include 'conex.php';
include '../../php/bitacora.php';
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






if (!empty($_POST)) {

    if (empty($_POST['usuario']) || empty($_POST['nombre']) || empty($_POST['contra'])) //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        // $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';  
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location= "registro.php";
            </script>
            ';
    } else {

        $usuario = $_POST['usuario'];
        $nombre_usuario = $_POST['nombre'];

        $estado_usuario = ['estado_usuario'];
        //encriptamiento de la contraseña
        $contrasenia = $_POST['contra'];
        $contrasenia = hash('sha512', $contrasenia);

        $rol = $_POST['id_rol'];
        //Creacion automatica de fecha
        date_default_timezone_set('America/Mexico_City');
        $fecha_vencimiento = (new DateTime('+ 12 months'))->format('Y-m-d H:i:s');

        $correo_electronico = $_POST['email'];
        $creado_por = "ADMINISTRADOR";
        $primer_ingreso = "NO";
        //Creacion automatica de fecha
        date_default_timezone_set('America/Mexico_City');
        $fecha_creacion = date("Y-m-d H:i:s");


        if ($estado_usuario == 1) {
            $estado_usuario = 'ACTIVO';
        }elseif ($estado_usuario == 2){
            $estado_usuario = 'INACTIVO';
        }else{
            $estado_usuario = 'NUEVO';
        }




        $query = mysqli_query($conex, "SELECT * FROM tbl_ms_usuario WHERE usuario = '$usuario' or correo_electronico = '$correo_electronico' ");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            // $alert= '<p class= "msg_error">El usuario ya existe.</p>';
            echo
                '<script>
                alert("El usuario ya existe");
                window.location= "registro.php";
                </script>
                ';
            $codigoObjeto = 7;
            $accion = 'Registro';
            $descripcion = 'intento ingresar un usuario ya existente';
            bitacora($codigoObjeto, $accion, $descripcion);
        } else {
            $query_insert = mysqli_query($conex, "INSERT INTO tbl_ms_usuario(usuario,nombre_usuario,estado_usuario,contrasenia,id_rol,
                                        fecha_vencimiento,correo_electronico, creado_por, fecha_creacion, primer_ingreso)
            VALUES('$usuario','$nombre_usuario','$estado_usuario','$contrasenia','$rol','$fecha_vencimiento','$correo_electronico','$creado_por','$fecha_creacion','$primer_ingreso')");

            if ($query_insert) {
                //  $alert= '<p class= "msg_save">El usuario se ha creado.</p>';
                echo
                    '<script>
                alert("Usuario creado correctamente");
                window.location= "GestionUsuarios.php";
                </script>
                ';
                $codigoObjeto = 7;
                $accion = 'Registro';
                $descripcion = 'El Usario Administrador registro un Usuario';
                bitacora($codigoObjeto, $accion, $descripcion);
            } else {
                // $alert= '<p class= "msg_error">Error al crear el usario.</p>';
                echo
                    '<script>
                alert("Error al crear el usario");
                window.location= "registro.php";
                </script>
                ';
                $codigoObjeto = 7;
                $accion = 'Registro';
                $descripcion = 'Error al intentar crear Usuario';
                bitacora($codigoObjeto, $accion, $descripcion);
            }
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

<div class="sidebar">
    <div class="logo-details">
      <i class='bx bxs-factory icon'></i>
      <div class="logo_name">FERRECOMM</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="Menu.php">
          <i class='bx bxs-home'></i>
          <span class="links_name">Inicio</span>
        </a>
        <span class="tooltip">Inicio</span>
      </li>
      <li>
        <a href="Facturacion.php">
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
        <a href="Productos.php">
          <i class='bx bx-shopping-bag'></i>
          <span class="links_name">Productos</span>
        </a>
        <span class="tooltip">Productos</span>
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
      <li>
        <a href="GestionUsuarios.php">
          <i class='bx bx-package'></i>
          <span class="links_name">Usuarios</span>
        </a>
        <span class="tooltip">Usuarios</span>
      </li>

      <a href="../../php/Cerrar_Seccion.php">
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
    width: 226px;
    justify-content: center;
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
    width: 226px;
    justify-content: center;
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






    <?php include 'conex.php'; ?>
    <section id="container">

        <div class="form_register">
            
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>

            <h1>Registro Usuario</h1>
            <!-- formulario registro-->
            <form action="" method="POST" class="formulario__registro" id="formulario">
            

                <!-- Grupo: Usuario -->
                <div class="formulario__grupo" id="grupo__usuario">
                    <label for="usuario" class="formulario__label">Usuario</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" name="usuario"
                            id="usuario" placeholder="USUARIO123">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener
                        numeros, letras y guion bajo.</p>
                </div>

                <!-- Grupo: Nombre -->
                <div class="formulario__grupo" id="grupo__nombre">
                    <label for="nombre" class="formulario__label">Nombre</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" onblur="cambiarAMayusculas(this);" name="nombre"
                            id="nombre" placeholder="Nombre Apellido">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El nombre solo puede contener letras.</p>
                </div>

                <!-- 
                <label for="estado_usuario">Estado</label>
                <select name="estado_usuario" id="Estado Usuario">
                    <option value="1">ACTIVO</option>
                    <option value="2">INACTIVO</option>
                </select>
-->
                <label for="id_rol">ROL</label>
                <select name="id_rol" id="id_rol">
                    <option value="1">Administrador</option>
                    <option value="2">Vendedor</option>
                    <option value="3">Default</option>
                </select>

                <!-- Grupo: Correo Electronico -->
                <div class="formulario__grupo" id="grupo__email">
                    <label for="correo" class="formulario__label">Correo Electrónico</label>
                    <div class="formulario__grupo-input">
                        <input type="email" class="formulario__input" name="email" id="correo"
                            placeholder="correo@correo.com">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y
                        guion bajo.</p>
                </div>

                <!-- Grupo: Contraseña -->
                <div class="formulario__grupo" id="grupo__contra">
                    <label for="password" class="formulario__label">Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" class="formulario__input" name="contra" id="contra">
                        <i class="formulario__validacion-estado fa-solid fa-eye" id="Ojito"></i>
                    </div>
                    <p class="formulario__input-error">La contraseña tiene que ser de 5 a 20 dígitos.</p>
                </div>

                <!-- Grupo: Contraseña 2 -->
                <div class="formulario__grupo" id="grupo__password2">
                    <label for="password2" class="formulario__label">Repetir Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" class="formulario__input" name="password2" id="password2">
                        <i class="formulario__validacion-estado fa-solid fa-eye" id="Ojito2"></i>
                    </div>
                    <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                </div>

                <div class="formulario__mensaje" id="formulario__mensaje">
                    <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario</p>
                </div>

                <br>
                <button type="submit" class="btn_agregar">Agregar</button>
                <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
                <button type="reset" onclick="location.href='GestionUsuarios.php'" class="btn_cancelar">Cancelar</button>
                
                
                


                <script>
                    function cambiarAMayusculas(elemento) {
                        let texto = elemento.value;
                        elemento.value = texto.toUpperCase();
                    }
                </script>
            </form>



        </div>

    </section>
    <script src="accesos/JS/scrip.js"> </script>
    <script src="../JS/formulario_registro.js"> </script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

    <a href="GestionUsuarios.php" class="btn_pdf">Atrás</a>


</body>

</html>