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




if (!empty($_POST)) {

    if (empty($_POST['usuario']) || empty($_POST['nombre']) || empty($_POST['contra']))  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
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
        $estado_usuario = $_POST['estado_usuario'];
        //encriptamiento de la contraseña
        $contrasenia = $_POST['contra'];
        $contrasenia = hash('sha512', $contrasenia);
        
        $rol = $_POST['id_rol'];
        //Creacion automatica de fecha
        date_default_timezone_set('America/Mexico_City');
        $fecha_vencimiento=(new DateTime('+ 1 months'))->format('Y-m-d H:i:s');

        $correo_electronico = $_POST['email'];
        $creado_por = "ADMINISTRADOR";
        //Creacion automatica de fecha
        date_default_timezone_set('America/Mexico_City');
        $fecha_creacion = date("Y-m-d H:i:s");

        if($estado_usuario == 1){
            $estado_usuario= 'ACTIVO';
        }else{
            $estado_usuario= 'INACTIVO';
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
        } else {
            $query_insert = mysqli_query($conex, "INSERT INTO tbl_ms_usuario(usuario,nombre_usuario,estado_usuario,contrasenia,id_rol,
                                        fecha_vencimiento,correo_electronico, creado_por, fecha_creacion)
            VALUES('$usuario','$nombre_usuario','$estado_usuario','$contrasenia','$rol','$fecha_vencimiento','$correo_electronico','$creado_por','$fecha_creacion')");

            if ($query_insert) {
                //  $alert= '<p class= "msg_save">El usuario se ha creado.</p>';
                echo
                '<script>
                alert("Usuario creado correctamente");
                window.location= "GestionUsuarios.php";
                </script>
                ';
            } else {
                // $alert= '<p class= "msg_error">Error al crear el usario.</p>';
                echo
                '<script>
                alert("Error al crear el usario");
                window.location= "registro.php";
                </script>
                ';
            }
        }
    }
}





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../accesos/CSS/Estilos_formulario.css">
    <link rel="stylesheet" href="../../accesos/CSS/Tablas.css">
    <link rel="stylesheet" href="../../accesos/CSS/registro.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuarios</title>
    <link rel="stylesheet" href="accesos/CSS/registro.css">
    <link rel="stylesheet" href="accesos/CSS/Estilos.css">
</head>

<body>

    <?php include 'conex.php'; ?>
    <section id="container">

        <div class="form_register">
            <h1>Registro Usuario</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>


            <!-- formulario registro-->
            <form action="" method="POST" class="formulario__registro" id="formulario">
                <h2>Registrarse</h2>

                <!-- Grupo: Usuario -->
                <div class="formulario__grupo" id="grupo__usuario">
                    <label for="usuario" class="formulario__label">Usuario</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" onblur="cambiarAMayusculas(this);" name="usuario" id="usuario" placeholder="USUARIO123">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener numeros, letras y guion bajo.</p>
                </div>

                <!-- Grupo: Nombre -->
                <div class="formulario__grupo" id="grupo__nombre">
                    <label for="nombre" class="formulario__label">Nombre</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" onblur="cambiarAMayusculas(this);" name="nombre" id="nombre" placeholder="Nombre Apellido">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El nombre solo puede contener letras.</p>
                </div>

                <label for="estado_usuario">Estado</label>
                <select name="estado_usuario" id="Estado Usuario">
                    <option value="1">ACTIVO</option>
                    <option value="2">INACTIVO</option>
                </select>

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
                        <input type="email" class="formulario__input" name="email" id="correo" placeholder="correo@correo.com">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
                </div>

                <!-- Grupo: Contraseña -->
                <div class="formulario__grupo" id="grupo__contra">
                    <label for="password" class="formulario__label">Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" class="formulario__input" name="contra" id="contra">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">La contraseña tiene que ser de 5 a 20 dígitos.</p>
                </div>

                <!-- Grupo: Contraseña 2 -->
                <div class="formulario__grupo" id="grupo__password2">
                    <label for="password2" class="formulario__label">Repetir Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" class="formulario__input" name="password2" id="password2">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                </div>

                <div class="formulario__mensaje" id="formulario__mensaje">
                    <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario</p>
                </div>

                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button>Registrarse</button>
                    <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
                </div>



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

    <a class="link_edit" href="GestionUsuarios.php">Volver</a>


</body>

</html>