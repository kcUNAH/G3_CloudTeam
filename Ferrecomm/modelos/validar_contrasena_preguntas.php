<?php
 //VALIDACIONES PARA CAMBIO DE CONTRASEÑAS DESPUES DE HABER HECHO LA VALIDADCION POR PREGUNTAS
 session_start();
 include_once "../php/conexion2.php";
?>
<?php
    if(isset($_SESSION['vario'])){ //Verificar que haya datos en la variable de sesion
        $usuario= $_SESSION['vario']; //asigna la variable de sesion
        try{
            $sentencia = $db->prepare("SELECT id_usuario FROM tbl_ms_usuario WHERE usuario = (?);");
            $sentencia->execute(array($usuario));
            $row=$sentencia->fetchColumn();
           if($row>0){
                $usuari = $row;// Asigna el codigo al que pertenece el usuario de la tabla tbl_usario
                if(isset($_POST['cambiar_clave'])){
                    $clave= $_POST['clave_nueva'];
                    $confirmar_clave = $_POST['confirmar_clave'];
                    $expre = " /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/ ";/*se le asigana expresion regular
                     que valida que la contraseña tenga minimo una letra mayuscula,minuscula,codigo especial y numeros  */
                    if($clave  <> $confirmar_clave){ //Si las contraseñas no son iguales 
                        echo "<script> alert('Las contraseñas no son iguales')
                        location.href = '../Cambio_contraseña_preguntas.php';
                        </script>";
                    }
                    else{ 
                        echo "HOLA MUNDO";
            
                           
                           
                            $pass = hash('sha512', $clave);
                           
                            //se puede mandar a laas otras validaciones
                            try{
                                $sentencia ="SELECT * FROM tbl_ms_usuario WHERE contrasenia = '$pass' AND id_usuario = '$usuari';";
                                $datos=$conn->query($sentencia);
                                $row=$datos->num_rows;
                                if($row>0){ //si la contraseña es la misma que tiene en el sistema
                                    echo "<script> alert('!Utilice una contraseña que no haya usado anteriormente')
                                    location.href = '../Cambio_contraseña_preguntas.php';
                                    </script>";
                                }
                                else{ //si la contraseña es diferente de la que tiene en el sistema
                                    try{
                                     
                                            try{ //insert en la tabla de historial de contraseñas la nueva contraseña por el usario
                                               
                                                //actualiza la tabla de tbl_usuario el cmapo de la contraseña el campo de modificado por
                                                    $update = "UPDATE tbl_ms_usuario SET contrasenia ='$pass'
                                                
                                                    WHERE usuario = '$usuario' ";
                                                    $resul=$conn->query($update);
                                                    if($resul >0){//Si la contraseña se actualizco correctamente
                                                        echo "<script> 
                                                        alert('¡Cambio de contraseña correcto!')
                                                        location.href = '../index.php';
                                                        </script>";
                                                        exit;

                                                       
                                                    }
                                                
                                                else{//error al ingresar los datos,saber que error sera :v (pero hay que mostrar mensaje de error xd )
                                                    echo "<script> 
                                                    alert('!Error al ingresar los datos¡');
                                                    location.href = '../Cambio_contraseña_preguntas.php';
                                                    </script>";
                                                    exit;
                                                }
                                            }catch (PDOException $e){
                                            echo $e->getMessage();  
                                            return false;
                                            }
                                       
                                    }catch (PDOException $e){
                                        echo $e->getMessage();  
                                        return false;
                                    }
                                                        
                                }//final del else
                            }catch (PDOException $e){
                              echo $e->getMessage();  
                              return false;
                            }
                     
                        //Si las contraseñas son iguales
                    }
                }//fin del if de ver si esta lleno el boton de cambiar contraseña
                // no lleva else ni try cacth
            }else{
            echo "<script>
            alert('El usuario que ingreso no existe');
            location.href = '../Recuperarpreguntas.php';
            </script>";
            }
            //fin del if else de verificar si existe el usuario en el sistema.
           }catch (PDOException $e){
           echo $e->getMessage();  
           return false;
        }
    }//Cierre del if padre
?>
