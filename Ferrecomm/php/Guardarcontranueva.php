<?php

include_once 'conexion.php';
if(isset($_SESSION['vario'])){ //Verificar que haya datos en la variable de sesion  
 $usuario= $_SESSION['vario'];
if(isset($_POST['cambiar_clave'])) {

 
            $clave_nueva= $_POST['clave_nueva'];
            $confirmar_clave = $_POST['confirmar_clave'];
            $d=strtotime("today");
            date("Y-m-d h:i:sa", $d);
            
            $queri="UPDATE tbl_ms_usuario SET contrasenia = $clave_nueva ";
             $EJECUTAR = mysqli_query($conexion,$queri);
   
    if($EJECUTAR) {
        echo'
        <script>
        alert("Pregunta Registrada con exito");
        window.location= "../index.php";
        </script>
        ';
       
    }else {
        echo'
        <script>
        alert("intentelo de nuevo pregunta no registrada");
        window.location= "pregunta.php";
        </script>
        ';
    }
    
    mysqli_close($conexion);

}
        
}

    ?> 





  

