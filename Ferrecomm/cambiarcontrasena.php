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
    <link rel="stylesheet" href="accesos/CSS/Estilos.css">
</head>

<body>

    <main>
        <div class="contenedor__todo">

            <div class="caja__trasera">
                <div class="caja__trasera__login">
                  <br> <br> <br> <br>
                  <br><br> <br><br><br/>
                </div>
            </div>
    
            <div class="contenedor__login-registro">
  <!-- formulario recuperar por correo-->                
            <form action="recuperarcontra.php" method="POST" class="formulario__cambio">
            <h4 style="font-size: 20px">Cambiar contraseña</h4><br/>

            <label class="control-label mb-2">Contrase&ntilde;a actual:</label>
                    <div class="input-group mb-3" id="grupo__clave_nueva">
                        <input  type="password" id="clave_nueva" name="contra_actual" class="form-control" 
                          required  minlength="<?php echo $valor1;?>"  maxlength="<?php echo $valor?>"  title="Configure con los valores solicitados" onkeyup="noespacio(this, event)" onkeyup="sinespacio(this);">
                          <div class="input-group-prepend">
                            <button id="show_password" class="form-control btn-outline-secondary  btn-block" type="button" onKeyDown="sinespacio(this);" onclick="mostrar1()"><span class="icon1 fa fa-eye-slash"></button>
                          </div>
                        <p class="formulario__input-error">Debe tener minimo <?php echo $valor1;?> caracteres,una minúscula,mayúscula ,número y caracter especial.</p>
                    </div>   
            <label class="control-label mb-2">Contrase&ntilde;a Nueva:</label>
                    <div class="input-group mb-3" id="grupo__clave_nueva">
                        <input  type="password" id="clave_nueva" name="clave_nueva" class="form-control" 
                          required  minlength="<?php echo $valor1;?>"  maxlength="<?php echo $valor?>"  title="Configure con los valores solicitados" onkeyup="noespacio(this, event)" onkeyup="sinespacio(this);">
                          <div class="input-group-prepend">
                            <button id="show_password" class="form-control btn-outline-secondary  btn-block" type="button" onKeyDown="sinespacio(this);" onclick="mostrar1()"><span class="icon1 fa fa-eye-slash"></button>
                          </div>
                        <p class="formulario__input-error">Debe tener minimo <?php echo $valor1;?> caracteres,una minúscula,mayúscula ,número y caracter especial.</p>
                    </div>
                    
                    <label class="control-label mb-2">Confirmar contrase&ntilde;a</label>
                    <div class="input-group mb-3 " id="grupo__confirmar_clave">
                        <input  type="password" id="confirmar_clave" name="confirmar_clave" class="form-control"
                         required minlength="<?php echo $valor1;?>"  maxlength="<?php echo $valor?>"   title="Configure con los valores solicitados" onkeyup="noespacio(this, event)" onkeyup="sinespacio(this);">
                         <div class="input-group-append">
                           <button id="show_password" class="form-control btn-outline-secondary btn-block" type="button"  onclick="mostrar2()"><span class="icon2 fa fa-eye-slash"></button>
                         </div>
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
            <a href="index.php">Regresar</a>
            <script>
              function cambiarAMayusculas(elemento) {
              let texto = elemento.value;
              .value = texto.toUpperCase();}
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