<?php
session_start();
include_once 'conexion.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>preguntas</title>
        <link rel="stylesheet" href="../accesos/CSS/Estilos_formulario.css">
        <link rel="stylesheet" href="../accesos/CSS/Estilos.css">
    </head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./fontawesome-free/css/all.min.css">

    <title>Restablecer la contraseña usuario</title>
</head>


<body>
<form action="pregunta_repuesta.php"  method="POST" class="formulario__login" id="formulario_login_ingreso">
<div class="container-fluid" style=" background-image: URL(..\..\Ferrecomm\accesos\Imagenes\Logo.jpeg);">

<div class="row justify-content-center mt-5">
        <div class="col-md-6">
     
                <div class="card card-outline card-primary">
                    <div class="card-header text-white  mb-3" style="background-color:rgba(255, 102, 0, 0.911);" style=" background-image: URL(Ferrecomm\accesos\Imagenes\Logo.jpeg);">
                        <h4 class=" text-center ">Estimado Usuario por su seguridad, debe de reponder una pregunta</h4>
                    </div>
                   
                    <div class="card-body">             
              <!-- Grupo: usuario -->
                    <div class="formulario__grupo" id="grupo__usuario">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" onblur="cambiarAMayusculas(this);" name="usuarios" id="usuarios" placeholder="ingrese su Usuario">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    
                
                  
                <select name="preguntas1" class="form-select" aria-label="Default select example">
               <option selected="">----Seleccione una pregunta----</option>
                <option value="1">¿Cuál es el segundo nombre de su mamá?</option>
                 <option value="2" >¿En qué ciudad se conocieron tus padres?</option>
                 <option value="3">¿Cuál es tu comida favorita?</option>
                </select>

                
                
                <!-- Grupo: repuesta -->
                    <div class="formulario__grupo" id="grupo__nombre">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" onblur="cambiarAMayusculas(this);" name="repuestas" id="repuesta" placeholder="ingrese su repuesta">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    

                    <div class="formulario__mensaje" id="formulario__mensaje">
                        <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario</p>
                    </div>

                    <div class="d-grid gap-2">
                    <div class="formulario__grupo formulario__grupo-btn-enviar">
                      
                     </div>

                                <!--Botones  -->
                             
                                <button type="submit" class="btn btn-block btn btn-flat" style="background-color:#4FCF87; color:white;" name="verifica" Value="Ejecutar">VERIFICAR</button>
                                <button type="reset" onclick="location.href='../index.php'" class="btn btn-block btn-warning btn-flat" name="cancele" >CANCELAR</button>
                            </div>
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

        </div>



    <!--Funciones js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
    <script src="accesos/JS/scrip.js"> </script>
    <script src="accesos/JS/formulario.js"> </script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>

</html>