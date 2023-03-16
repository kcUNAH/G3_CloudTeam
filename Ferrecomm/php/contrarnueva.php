<?php
session_start();
include_once "conexion2.php";






?>
<?php
 
 
    $valor = 20;
  
?>
<?php

    $valor1 = 20;

 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../accesos/CSS/Estilos_formulario.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Cambio de contraseña</title>
  </head>
 
<body>
    <div class="row align-items-center justify-content-center mt-5 pt-4" >
          <div class="col-md-5 rounded" style="width: 23rem;" >
            <div  class="card">
              <div class="card-body"> <!--action que  manda al archivo donde estan las validaciones,acuerdensen de poner el method="POST"! -->
            <center><h4 style="font-style: italic; font-size: 20px; ">Cambiar la contraseña Asignada</h4></center>
              <hr style="color: #999; background-color: green ; height: 2px; border: none;">



              <form  method="POST" action="pregunta.php" class="formulario__registro" id="formulario"> 

                    <!-- Grupo: Contraseña actual -->
                    <div class="formulario__grupo" id="grupo__contra_login">
                        <label for="password" class="formulario__label">Contraseña actual</label>
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="contra_login" id="contra_login">
                            <i class="formulario__validacion-estado fa-solid fa-eye" id="Ojito3"></i>
                        </div>
                        <p class="formulario__input-error">La contraseña tiene que ser de 5 a 20 dígitos.</p>
                    </div>

                  


                    <!-- Grupo: Contraseña -->
                    <div class="formulario__grupo" id="grupo__contra">
                    <label for="password" class="formulario__label">Contraseña nueva</label>
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
                        <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Datos incorrectos</p>
                    </div>
                    


                    


                    <br><br>
                    <div class="d-grid">
                      <button style="background-color: #fda00e;" type="submit" name="cambiar_clave" id="cambiar_clave" class="btn btn btn-success btn-block">Cambiar Contrase&ntilde;a</button >
                    </div>
                
                  </div>
                </form>
              </div>
           </div>
        </div>
    </div>


    <script src="../accesos/JS/formulario_cambio_contrasenia.js"></script>

  </body>
</html>
