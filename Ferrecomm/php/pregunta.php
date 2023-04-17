<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    // Si el usuario ha iniciado sesión, mostrar el campo de entrada con su ID de usuario
    $usuarioinicio = $_SESSION['id_usuario'];
    echo ' <input type="hidden"value="'.  $usuarioinicio.'" readonly>';
} else {
    // Si el usuario no ha iniciado sesión, mostrar un mensaje de error o redirigir a la página de inicio de sesión
    echo '
    <script>
    alert("Por favor, debe iniciar seccion");
    window.location= "../index.php";
    </script>
    ';
    //header("localitation: index.php");
    session_destroy();
    die();
}

include_once 'conexion2.php';
// Comprobar si la variable de sesión del contador existe
if (isset($_COOKIE['contador'])) {
    $variable = $_COOKIE['contador'] + 1;
    setcookie('contador', $variable);
  //  echo "El contador es: " .  $variable;
} else {
    $variable = 1;
 setcookie('contador', $variable);
    
}   
// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n=5;
    
    // Obtener los valores del formulario
  
    $respuesta = $_POST["respuesta"];
    $pregunta = $_POST["pregunta_usuario"];
    $Creado = "AUTOREGISTRO";
    $modificado = "ADMINISTRADOR";
    $d = strtotime("today");
    date("Y-m-d h:i:sa", $d);
    $total="SELECT COUNT(*) FROM tbl_ms_preguntas ";
    $tot = $conn->query( $total);
    
    $idpreguntas = "SELECT id_pregunta FROM tbl_ms_preguntas WHERE id_pregunta= ' $pregunta' ";
    $obtenepregunta = mysqli_query($conn, $idpreguntas);
    $filapregunta = mysqli_fetch_array($obtenepregunta);
    $va_preguntaid = $filapregunta['id_pregunta'];
    $preguntaid = $va_preguntaid =  $pregunta;

      //ID_USUARIO
      
    $idusuario = "SELECT usuario FROM tbl_ms_usuario WHERE id_usuario = '$usuarioinicio'";
    $obtenerid = mysqli_query($conn, $idusuario);
    $filaid = mysqli_fetch_array($obtenerid);
    $Usuarioid = $filaid['usuario'];
    
    $usuarios=$Usuarioid;


    //creado por admin
    $idcreado = "SELECT creado_por FROM tbl_ms_usuario WHERE usuario= '$usuarios'";
    $obtenercreado = mysqli_query($conn, $idcreado);
    $filaicreado = mysqli_fetch_array($obtenercreado);
    $va_creado = $filaicreado['creado_por'];

   // Obtener la pregunta seleccionada actualmente
  
    $queri = "INSERT INTO  tbl_ms_preguntas_usuario(id_pregunta,id_usuario,respuesta,creado_por,fecha_creacion,modificado_por,fecha_modificacion)
    VALUES($preguntaid ,$usuarioinicio, '$respuesta ','$Creado',CURTIME(),'$modificado',CURTIME())";
    $EJECUTAR = mysqli_query($conn, $queri);

    // Insertar los valores en la tabla de respuestas
  
    // Comprobar si la consulta se ha ejecutado correctamente
  
    if ($EJECUTAR) {
       
        if ($variable<= $n) {
            echo '
                <script>
                alert("Pregunta Registrada con éxito");
                window.location= "pregunta.php";
                </script>
                ';
                
                // Incrementar el contador


// Actualizar el valor de la variable de sesión del contador


        } else {
            if ($variable > $n) {
            if ($va_creado == 'AUTOREGISTRO') {
                $sql = "UPDATE tbl_ms_usuario SET primer_ingreso = 'COMPLETADO' WHERE usuario = '$usuarios'";
                mysqli_query($conn, $sql);
                echo '
                    <script>
                    alert("Pregunta Registrada con éxito");
                    window.location= "../index.php";
                    </script>
                    ';
    if (isset($_SESSION['usuario'])) {
    // Reiniciar el contador de visitas
    setcookie('contador', 1);

}
            } else {
                if ($va_creado == 'ADMINISTRADOR') {
                    $sql = "UPDATE tbl_ms_usuario SET primer_ingreso = 'COMPLETADO' WHERE usuario = '$usuarios'";
                    mysqli_query($conn, $sql);
            
                    echo '
                    <script>
                    alert("Pregunta Registrada con éxito");
                    window.location= "contrarnueva.php";
                    </script>
                    ';

      if (isset($_SESSION['usuario'])) {
    // Reiniciar el contador de visitas
    setcookie('contador', 1);
}
                }
            }
        }
    }
    } else {
        echo '
        <script>
        alert("Inténtelo de nuevo pregunta no registrada");
        window.location= "pregunta.php";
        </script>
        ';

          if (isset($_SESSION['usuario'])) {
    // Reiniciar el contador de visitas
    setcookie('contador', 1);
}
    }

    mysqli_close($conn);
    
         
             
}


?>    
<!-- Formulario para ingresar la pregunta y la respuesta -->

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

</head>


<body>
<form action="pregunta.php"  method="POST" class="formulario__login" id="formulario_login_ingreso">
<div class="container-fluid" style=" background-image: URL(..\..\Ferrecomm\accesos\Imagenes\Logo.jpeg);">

<div class="row justify-content-center mt-5">
        <div class="col-md-5">
     
                <div class="card card-outline card-primary">
                    <div class="card-header text-white  mb-3" style="background-color:rgba(255, 102, 0, 0.911);" style=" background-image: URL(Ferrecomm\accesos\Imagenes\Logo.jpeg);">
                        <h4 class=" text-center ">Estimado Usuario por su seguridad, debe de reponder Las siguientes preguntas</h4>
                    </div>

                    
                    <body>
    
                             
              <!-- Grupo: usuario -->
    
                    <div class="card-body">
                  
                        <form class="needs-validation" novalidate method="POST" >
                       
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <!--Muesrta el nombre del usuario que esta registrado en el sistema,pra cambiar contraseña -->
                                 
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <!--Muesrta el nombre del usuario que esta registrado en el sistema,pra cambiar contraseña -->
                                 
                            </div>
                         
                            <div class="col-md-12 mb-3">
                                        <style>
                                        .input-parejo {
                                          display: block;
                                          width: 100%;
                                          padding: 10px;
                                          box-sizing: border-box;
                                          border: 1px solid #ccc;
                                          border-radius: 4px;
                                          margin-bottom: 10px;
                                        }
                                      </style>

<form method="post">
    <div class="form-group">
    <label>Debe de responder todas las preguntas si repetirlas </label>
        <select class="form-control" aria-label="Default select example" name="pregunta_usuario" id="pregunta_usuario" required>

        <option selected enable value="">--Selecione--</option>
        
            <?php
        

            // Consulta para obtener las preguntas
            $query = "SELECT id_pregunta, pregunta FROM tbl_ms_preguntas";
            $resultado = $conn->query($query);
            // Mostrar las preguntas en el select
          
            if ($resultado->num_rows > 0) {
                while ($pregunta = $resultado->fetch_assoc()) {
                    $valuep = $pregunta['id_pregunta'];
                    $pre = $pregunta['pregunta'];
                  
            ?>
                    <option value="<?php echo $valuep ?>"><?php echo $pre; ?></option>
                    
            <?php
                }
            }
            ?>
        </select>

        </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                    
                               
                                    <input type="text"  name="respuesta" id="respuesta" class="form-control" id="" onkeyup="mayus(this);" autocomplete="off" placeholder="Respuesta de seguridad" onkeypress="return soloLetras(event);" required pattern="[A-Z]{<?php echo $valor1; ?>,<?php echo $valor2; ?>}">
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <!--Botones  -->
                              <button type="submit"  class="btn btn-block btn btn-flat" style="background-color:#4FCF87; color:white;" name="verifica" id="verifica"   Value="Ejecutar" href="pregunta.php">GUARDAR</button>
                              <button type="reset" onclick="location.href='../index.php'" class="btn btn-block btn-warning btn-flat" name="cancele"> CANCELAR</button>
                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



         <!--Funciones js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script>
    function mayus(e) { //Funcion mayuscula
        e.value = e.value.toUpperCase();
    }
    (function() {
        'use strict' //funcion de validacion de campos con js
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })();

    
// Obtener el valor almacenado en el almacenamiento local


</script>
<script>
    
   

</script>


</html>