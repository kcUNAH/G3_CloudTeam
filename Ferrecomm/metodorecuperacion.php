<?php


session_start();


function generaPass(){  
    $cadena = "ABCDEF%GHIJKLM%@$#NOPQRST#UVWXYZ%@#$0123456789%#$#abcdefghijklm#$@#nopqrst$@uvwxyz$@%#";
    $longitudCadena=strlen($cadena);    
    $passw = "";
    $longitudPass=8;    
    for($i=1 ; $i<=$longitudPass ; $i++){
        $pos=rand(0,$longitudCadena-1);     
        $passw .= substr($cadena,$pos,1);
    }
    return $passw;
}

include_once "php/conexion.php";
include_once "php/conexion2.php";

//validacion de Recuperacion de contrasena por medio de correo
if(isset($_REQUEST['usuario'])) {  //aqui capturo el usuario enviado
    if(isset($_REQUEST['correo'])) { //este if es verdad si se presiono el boton correo <entonces.. entro al bloque de codigo

        $usuario = ($_POST["usuario"]);// entonces capturo el dato del usuario enviado mediante el metodo POST

        $_SESSION['vario']  = $_POST["usuario"]; // se crea una variable de sesion con el nombre del isuario

        $contrasenia=generaPass();
        $pass = hash('sha512', $contrasenia);

        $validar_usuario = mysqli_query($conexion, "SELECT correo_electronico FROM tbl_ms_usuario WHERE usuario = '$usuario'");

      
        if(mysqli_num_rows($validar_usuario) > 0){
                          $fila = mysqli_fetch_array($validar_usuario);
                          $va_email = $fila['correo_electronico'];
            
                          $para = $va_email; // Dirección de correo electrónico del destinatario
                          $asunto = 'Recuperacion de contraseña'; // Asunto del correo electrónico
                          $mensaje = 'Su contraseña temporal es la siguiente:' ."\r\n". $contrasenia; // Cuerpo del correo electrónico
            
                          // Cabezera del correo electrónico
                          $cabecera = 'From: river261527@gmail.com' . "\r\n" .
                          'Reply-To: river261527@gmail.com' . "\r\n" .
                          'X-Mailer: PHP/' . phpversion();
            
                          //Actualizando la contraseña en la base de datos
                          //$sql = "Update tbl_ms_usuario Set contrasenia='$pass' Where usuario='$usuario'";
                         
            
                          // Confirmación y envío del correo electrónico
                         if (mail($para, $asunto, $mensaje, $cabecera)) {
                                echo 'El correo electrónico fue enviado exitosamente.';
                                $queri = "UPDATE tbl_ms_usuario
                                SET contrasenia= '$pass' 
                                where usuario = '$usuario' ";
                                $EJECUTAR = mysqli_query($conexion, $queri);

                         } else {
                                echo 'Ocurrió un error al enviar el correo electrónico.';
                         }
               
                         echo'
                         <script>
                          alert("Se le ha enviado un correo con contraseña temporal, porvafor revise su bandeja de entrada o en correo no deseados y copie la contraseña temporal, debera cambiar la contraseña en el formulario que le parece a continuación");
                          window.location= "cambiarcontrasena.php";
                         </script>
                          ';
            
            
                        exit();
                        } else {
            
                        echo '
                        <script>
                        alert("Usuario no encontrado, por favor intente de nuevo");
                        window.location= "index.php";
                        </script>
                        ';
                        exit();
                        
                       
                       // $queri = "UPDATE  tbl_ms_usuario (contrasenia) SET (CURRENT_DATE(),$pass)'";
                       // mysqli_close($conexion);
                       // $EJECUTAR = mysqli_query($conexion, $queri);
                       // mysqli_close($conexion);


        }


    } 
     //validacion de Recuperacion de contrasena por medio de preguntas
    else if(isset($_POST['recu'])) { // este if es verdad si se presiono el boton preguntas <entonces.. entro al bloque de codigo


        $usuario = ($_POST["usuario"]);

        session_start();
        $_SESSION['vario'] = $_POST["usuario"]; // se crea una variable de sesion con el nombre del isuario

        $consultar_usuario="SELECT *FROM tbl_ms_usuario WHERE usuario='$usuario'";
        $existe=$conn->query($consultar_usuario);
        $filas=$existe->num_rows;

        if($filas>0){
            header("location: Recuperarpreguntas.php"); 
          
                  }else{
                      
                    echo '<script>
                    alert("Datos incorrectos");
                    window.location="index.php";
                          </script>';
        }


    }


}
?>