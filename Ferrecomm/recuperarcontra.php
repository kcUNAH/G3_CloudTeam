<?php
            
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

            INCLUDE_once 'php/conexion.php';

            $usuario = $_POST ['usuario'];            
            $contrasenia = $_POST ['password'];    
            $contraantigua = $_POST ['passwordant'];  
            
           

            $validar_usuario = mysqli_query($conexion, "SELECT * FROM tbl_ms_usuario WHERE usuario = '$usuario'");
            

			if(mysqli_num_rows($validar_usuario) > 0){
                
                //Encriptando la contraseña nueva del usuario
                $pass = hash('sha512', $contrasenia);
                $mail = $_POST['usuario'];

                 //Conexion con la base
                 $conn = new mysqli("localhost", "root", "", "ferrecomm_db");
                 // Conexion fallida
                 if ($conn->connect_error) {
                     die("Connection failed: " . $conn->connect_error);
                 } 
                //Actualizando la contraseña en la base de datos
                $sql = "Update tbl_ms_usuario Set contrasenia='$pass' Where usuario='$mail'";
                
                //Confirmación de la contraseña actualizada
                if ($conn->query($sql) === TRUE) {
                } else {
                    echo 'Usuario no encontrado.';
                }
                $query = "SELECT id_usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'";
                $result = mysqli_query($conexion, $query);
                $row = mysqli_fetch_assoc($result);
                
                // Obtener el id de usuario
                $id_usuario = $row['id_usuario'];
                
                // Insertar la contraseña antigua en la tabla tbl_ms_hist_contrasenia
                $query_insert = "INSERT INTO tbl_ms_hist_contrasenia (id_usuario, contrasenia) VALUES ('$id_usuario', '$contraantigua')";
                $result_insert = mysqli_query($conexion, $query_insert);  
                    echo '<script>
                    alert("Contraseña actualizada exitosamente");
                    window.location= "index.php";
                    </script> ';
                    exit();
                } else  {
                    echo '<script>
                    alert("Usuario no existente, no se puede cambiar su contraseña");
                    window.location= "cambiarcontrasena.php";
                    </script> ' ;
                    exit();


            }
        ?>