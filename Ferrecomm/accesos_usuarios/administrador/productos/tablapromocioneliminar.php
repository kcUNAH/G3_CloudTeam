
<?php

include_once "./conexionproducto.php";
include '../../../php/bitacora.php';
//Mostrar datos

if(empty($_GET['id'])){
    header('Location: tablapromocion.php');
}
 $id_promocion_producto = $_GET['id'];
 $sql = mysqli_query($conexion, "SELECT p.id_promocion_producto, p.cantidad,
 (p.id_promocion) as id_promocion, (m.nombre_promocion) as promocion, (p.id_producto) as id_producto, (r.nombre_producto) as producto
FROM tbl_promociones_producto p 
INNER JOIN tbl_promociones m 
on p.id_promocion = m.id_promocion
INNER JOIN tbl_producto r 
on p.id_producto = r.id_producto
WHERE id_promocion_producto = $id_promocion_producto;");
 $result_sql = mysqli_num_rows($sql);

 if($result_sql == 0){
    header('Location: Productos.php');
 }else{
    $option = '';
    while ($data = mysqli_fetch_array($sql)){
            $id_promocion_producto = $data['id_promocion_producto'];
            $promocion = $data['promocion'];
            $producto = $data['producto'];
            $cantidad = $data['cantidad'];
      


    }
 }



 

 if(!empty($_POST)){
    $id_promocion_producto=$_POST['id_promocion_producto'];

    

   $query_delete = mysqli_query($conexion,"DELETE FROM tbl_promociones_producto WHERE id_promocion_producto = $id_promocion_producto ");
   if($query_delete){
       
        echo
            '<script>
            alert("Promocion eliminada del producto correctamente");
            window.location= "../productos.php";
            </script>
            ';
   $codigoObjeto=4;
    $accion='Eliminar';
    $descripcion= 'Elimino una promocion correctamente';
    bitacora($codigoObjeto, $accion,$descripcion);
        
    }else{
        echo
            '<script>
            alert("Error al eliminar la promocion correctamente");
            window.location= "tablapromocion.php";
            </script>
            ';

         $codigoObjeto=4;
        $accion='Eliminar';
        $descripcion= 'El Usuario intento eliminar una promocion';
        bitacora($codigoObjeto, $accion,$descripcion);
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../../accesos/CSS/tablaproducto.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php include "menu.php"; ?>
   </head>
<body>

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
    background-color: #ffff;

   }
   .field{
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
   }
   .field:focus{
    border-color: #18A383;
   }
   .btn_agregar{
    height: 45px;
	line-height: 45px;
	background: #c92f09;;
	color: #000000;
	font-weight: bold;
	border: none;
	border-radius: 3px;
	cursor: pointer;
	transition: .1s ease all;
    width: 227px;
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

  </style>
  <section class="home-section"></br>

      <h2>  Eliminar promoción del producto <i class='bx bxs-trash'></i></h2>
      
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
      <input type="hidden" name="id_promocion_producto" value="<?php echo $id_promocion_producto;?>">
     

                <label for="id_estado_prom">Promoción</label></br>  
            <input type="text" class="field" name="categoria" id="categoria" value="<?=$promocion?>" disabled>
            </p>
            <label for="id_estado_prom">Producto</label></br>  
            <input type="text" class="field" name="categoria" id="categoria" value="<?=$producto?>" disabled>
            </p>
            <label for="id_estado_prom">Cantidad</label></br>  
            <input type="text" class="field" name="categoria" id="categoria" value="<?=$cantidad?>" disabled>
            </p>
                

            </br></br>
            
            <button class="btn_agregar">Eliminar</button>
      <button type="reset" onclick="location.href='../productos.php'" class="btn_cancelar">Cancelar</button>



                    <script>
                        function cambiarAMayusculas(elemento) {
                            let texto = elemento.value;
                            elemento.value = texto.toUpperCase();
                        }
                    </script>

                    
                </form>
<script src="formularioproducto.js"></script>

      
  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();
  });

  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
   }
  }
  </script>


</body>
</html>