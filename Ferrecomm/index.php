<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("localitation: inicio.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="accesos/CSS/Estilos_formulario.css">
    <link rel="stylesheet" href="accesos/CSS/Estilos.css">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

</head>

<body>

    <main>
        <div class="contenedor__todo">

            <div class="caja__trasera">
                <div class="caja__trasera__login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia seción para entrar a la pagina</p>
                    <button id="btn__iniciar-secion"> iniciar secion </button>
                </div>
                <div class="caja__trasera__Registro">
                    <h3>¿Aun no tienes una cuenta?</h3>
                    <p>Registrate para que puedas iniciar seción</p>

                    <button id="btn__Registrarse"> Resgístrarse </button>
                    <h5 id="btn__Recupera">Recuperar contraseña</h5>

                </div>
            </div>

            <!-- aqui se encuentran los formularios que se encuentran en el login (ingresar registrar) -->

            <div class="contenedor__login-registro">
                <!-- formulario login-->
                <form action="php/login_usuario.php"  method="POST" class="formulario__login" id="formulario_login_ingreso">
                    <h2>Iniciar secion</h2>
                    <!-- Grupo: Usuario -->
                    <div class="formulario__grupo" id="grupo__usuario_login">
                        <label for="usuario" class="formulario__label">Usuario</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" onblur="cambiarAMayusculas(this);" name="usuario_login" id="usuario_login" placeholder="USUARIO">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener letras y guion bajo.</p>
                    </div>

                    <!-- Grupo: Contraseña -->
                    <div class="formulario__grupo" id="grupo__contra_login">
                        <label for="password" class="formulario__label">Contraseña</label>
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="contra_login" id="contra_login">
                            <i class="formulario__validacion-estado fa-solid fa-eye" id="Ojito3"></i>
                        </div>
                        <p class="formulario__input-error">La contraseña tiene que ser de 6 a 20 dígitos.</p>
                    </div>

                    <div class="formulario__mensaje" id="formulario__mensaje">
                        <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Datos incorrectos</p>
                    </div>

                        <button>Entrar</button>
               
                </form>

                <!-- formulario registro-->
                <form action="php/registro_usuario.php" method="POST" class="formulario__registro" id="formulario">
                    <h2>Registrarse</h2>

                    <!-- Grupo: Usuario -->
                    <div class="formulario__grupo" id="grupo__usuario">
                        <label for="usuario" class="formulario__label">Usuario</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" onblur="cambiarAMayusculas(this);" name="usuario" id="usuario" placeholder="USUARIO">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener letras y guion bajo.</p>
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
                            <i class="formulario__validacion-estado fa-solid fa-eye" id="Ojito"></i>
                        </div>
                        <p class="formulario__input-error">La contraseña tiene que ser de 6 a 20 dígitos.</p>
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




                <form action="metodorecuperacion.php" method="POST" class="formulario_recupera" id="formulario">
                    <h2>Recuperar contraseña</h2>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="Usuario-recuperar">Usuario:</span>
                        <input required type="text" name="usuario" class="form-control"  placeholder="Ingresa el usuario" aria-label="Username" aria-describedby="basic-addon1" minlength="6" maxlength="15" onkeyup="mayus(this);">
                    </div>
                    <div class="d-grid gap-2">
                       <button type="submit" name="correo" id="correo"  class="btn btn-light border-secondary" type="button">
                           Recuperar contrase&ntilde;a por correo
                       </button>

                       <button type="submit" name="recu" id="recu" class="btn btn-light border-secondary" type="button">
                             Recuperar via preguntas secretas
                       </button>

                       <button type="reset" href='index.php'class="btn btn-block btn-warning btn-flat">
                        <strong>Cancelar</strong> 
                     </button>
                    <?php
            
        
                    ?>
                    <script>
                        function cambiarAMayusculas(elemento) {
                            let texto = elemento.value;
                            elemento.value = texto.toUpperCase();
                        }
                    </script>
                </form>



            </div>
        </div>


    </main>
    
    <script src="accesos/JS/scrip.js"> </script>
    <script src="accesos/JS/formulario.js"> </script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>





</body>

</html>