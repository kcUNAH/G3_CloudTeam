


<?php
include '../conex.php';
include '../../../php/bitacora.php';
   if(!empty($_POST)){
        $id_cliente=$_POST['id_cliente'];

        

       $query_delete = mysqli_query($conex,"DELETE FROM tbl_clientes WHERE id_cliente = $id_cliente");
      
       
       //$query_delete=mysqli_query($conex,"UPDATE tbl_ms_usuario SET estado_usuario = 2 WHERE id_usuario = $idusuario ");
       
       
       if($query_delete){
           // header("Location: GestionUsuarios.php");
            
            echo '
            <script>
            alert("El cliente ha sido eliminado");
            window.location= "clientes.php";
            </script>
            
            ';
        $codigoObjeto=4;
        $accion='Eliminar';
        $descripcion= 'Elimino el cliente existente';
        bitacora($codigoObjeto, $accion,$descripcion);
        }else{
            echo '
            <script>
            alert("Error al eliminar");
            window.location= "clientes.php";
            </script>
            ';

            $codigoObjeto=4;
            $accion='Eliminar';
            $descripcion= 'El Usuario intento eliminar Un cliente';
            bitacora($codigoObjeto, $accion,$descripcion);


        }
   }

    //COMIENZO

    if(empty($_REQUEST['id'])){ //Validando que no vaya vacia
        //header('Location: GestionUsuarios.php');
        echo '
        <script>
        alert("Error, cliente vacio");
        window.location= "cliente.php";
        </script>
        ';
    }else{
        
        include '../conex.php';
        $id_cliente = $_REQUEST['id'];
        $query = mysqli_query($conex,"SELECT * FROM tbl_clientes 
        WHERE id_cliente = $id_cliente" );

        $result = mysqli_num_rows($query);

        if($result>0){ //MAyor a cero si existe el usuario
            while($data = mysqli_fetch_array($query)){

                $dni_cliente = $data['dni_cliente'];
                $nombre_cliente = $data['nombre_cliente'];
                $telefono_cliente = $data['telefono_cliente'];
                $direccion_cliente = $data['direccion_cliente'];
                
                
            }
        }else{
               // header("Location: GestionUsuarios.php"); //Que regrese a gestion de usuarios si el id buscado no existe
                echo '
                <script>
                alert("Error, cliente no existe");
                window.location= "clientes.php";
                </script>
                ';




            }
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <title>Eliminar Cliente</title>
    <link rel="stylesheet" href="../../../accesos/CSS/elim.css">
     




    
  
  
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    

    
    
    

    
    
    <link rel="stylesheet" href="../../../../accesos/CSS/tablaproducto.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <?php include "../productos/menu.php"; ?>
    
</head>

<body>



  <section class="home-section">
    









<style>
form{
    background-color: #db881a;
    border-radius: 3px;
    padding: 20px;
    margin : 0 auto;
    width : 500px;
    font-size: 15px;
   }
   input, textarea{
    border: ;
    outline: none;

   }
   
   input[type="text"]:disabled {
  background: #ffff;
   }

   .field{
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
   }
   .field:focus{
    border-color: #18A383;
   }
   .btn_cancelar{
    height: 45px;
	line-height: 45px;
	background: #d1d40a;
	color: #000000;
	font-weight: bold;
	border: none;
	border-radius: 3px;
	cursor: pointer;
	transition: .1s ease all;
    width: 227px;
   }

   .alert{
    width: 100%;
    background: #d82606;
    border-radius: 6px;
    margin: 20px auto;
}

.msg_error{
    color: black;
}

.msg_save{
    color: greenyellow;
}

.alert p{
    padding: 10px;
}

span{
    background: #ffff;
    border: ;
    outline: none;
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
}





.btn_cancelar{
    height: 45px;
    width: 227px;
	background: #d1d40a;
	color: #000000;
	font-weight: bold;
    display: inline-block;
	border-radius: 5px;
	cursor: pointer;
    
   }

    .btn_ok{
    height: 45px;
    width: 227px;
    background: #2ad313;
    color: black;
    font-weight: bold;
    display: inline-block;
    border-radius: 5px;
    cursor: pointer;
    margin: 15px;
}
</style>

<section class="home-section"></br>
<h2>¿Esta seguro de eliminar el siguiente cliente?</h2>
<form action="" method="POST" enctype="multipart/form-data">
<?php ?>
    <section id="container">
        <div class="data_delete"></div>
        <input type="hidden" name="id_cliente" value="<?php echo $id_cliente;?>">
        <p>DNI: 
        <input type="text" class="field" name="dni_cliente" id="dni_cliente" value="<?=$dni_cliente?>" disabled>
        </p>
        <p>Nombre Cliente: <input type="text" class="field" name="nombre_cliente" id="nombre_cliente" value="<?=$nombre_cliente?>" disabled>
        </p>
        <p>Teléfono: <input type="text" class="field" name="telefono_cliente" id="telefono_cliente" value="<?=$telefono_cliente?>" disabled>
        </p>
        <p>Dirección: <input type="text" class="field" name="direccion_cliente" id="direccion_cliente" value="<?=$direccion_cliente?>" disabled>
        </p>
    
    
        <form method="POST" action="">
            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">

            
            <input type="submit" value="Eliminar" class="btn_ok">
            <button type="reset" onclick="location.href='clientes.php'" class="btn_cancelar">Cancelar</button>
        </form>
</form>
  
        

        
      
      
    </section>
    <script src="accesos/JS/scrip.js"> </script>
</body>

</html>