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
            <label for="">Usuario</label>
            <input type="text" name="usuario" /> <br/><br/>
            <label for="">Contraseña anterior:</label>
            <input type="password" class="formulario__input" name="contraanterior" id="contraanterior"><br/><br/>
            <label for="">Nueva contraseña:</label>
            <input type="password" class="formulario__input" name="contra1" id="contra1"><br/><br/>
            <label for="">Confirmar contraseña:</label>
            <input type="password" class="formulario__input" name="contra2" id="contra2">
            <input type="submit" value="Aceptar" />  <br/><br/>
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