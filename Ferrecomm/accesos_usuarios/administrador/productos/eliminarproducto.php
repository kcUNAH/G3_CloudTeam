

<?php 
include '../conex.php';
include '../../../php/bitacora.php';

if(empty($_GET['id'])){
    header('Location: Productos.php');
}
 $id_producto = $_GET['id'];
 $sql = mysqli_query($conex, "SELECT p.id_producto,p.nombre_producto, p.descripcion_producto,
 p.precio_producto, p.img_producto, p.unidad_medida, p.cantidad_min, p.cantidad_max, 
 (p.id_categoria) as id_categoria, (c.nombre_categoria) as categoria
FROM tbl_producto p 
INNER JOIN tbl_categoria c 
on p.id_categoria = c.id_categoria 
WHERE id_producto = $id_producto;");
 $result_sql = mysqli_num_rows($sql);

 if($result_sql == 0){
    header('Location: Productos.php');
 }else{
    $option = '';
    while ($data = mysqli_fetch_array($sql)){
        $id_producto = $data['id_producto'];
        $id_categoria = $data['id_categoria'];
        $categoria = $data['categoria'];
        $nombre_producto =$data['nombre_producto'];
        $descripcion_producto = $data['descripcion_producto'];
        $precio_producto = $data['precio_producto'];
        $unidad_medida = $data['unidad_medida'];
        $cantidad_min = $data['cantidad_min'];
        $cantidad_max = $data['cantidad_max'];

            $option = '<option value="'.$id_categoria.'"select>'.$categoria.'</option>';
       

        if($data['img_producto'] != 'Imagen.PNG')
        {
            $foto = '<img width="150" src="img/uploads/'.$data['img_producto'].'" alt="Producto">';
        }else{
            $foto = '<img width="150" src="img/uploads/'.$data['img_producto'].'" alt="Producto">';
        }

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

span{
    background: #ffff;
    border: ;
    outline: none;
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
}
  </style>
  <section class="home-section"></br>

      <h2>  Eliminar producto <i class='bx bxs-trash'></i></h2>
      
      <form action="productoeliminar.php" method="POST" enctype="multipart/form-data">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
      <input type="hidden" name="id_producto" value="<?php echo $id_producto;?>">
            <label for="id_categoria">Categoría:</label></br>    
            <input type="text" class="field" name="categoria" id="categoria" value="<?=$categoria?>" disabled>
            </p>
            <p>Nombre del producto:
            <input type="text" class="field" name="nombre_producto" id="nombre_producto" value="<?=$nombre_producto?>" disabled>
            </p>
            <p>Descripción:
             <input type="text" class="field" name="descripcion_producto" id="descripcion_producto" value="<?php echo $descripcion_producto;?>" disabled>
            </p>
             <p>Precio:
            <input type="text" class="field" name="precio_producto" id="precio_producto" value="<?php echo $precio_producto;?>" disabled>
            </p>
            <p class="input-file-wrapper">
            <label for="upload">Imagen del producto:</label></br>
            <div align="center">
            <?php echo $foto; ?>
             </div></p>
            <p>Unidad medida:
            <input type="text" class="field" name="unidad_medida" id="unidad_medida" value="<?php echo $unidad_medida;?>" disabled >
            </p>
            <p>Cantidad mínima:
            <input type="text" class="field" name="cantidad_min" id="cantidad_min" value="<?php echo $cantidad_min;?>" disabled>
            </p>
            <p>Cantidad máxima:
            <input type="text" class="field" name="cantidad_max" id="cantidad_max" value="<?php echo $cantidad_max;?>" disabled>
            </p>
            </br>
            
      <button class="btn_agregar">Eliminar</button>
      <button type="reset" onclick="location.href='../Productos.php'" class="btn_cancelar">Cancelar</button>



                    <script>
                        function cambiarAMayusculas(elemento) {
                            let texto = elemento.value;
                            elemento.value = texto.toUpperCase();
                        }
                    </script>

                    
                </form>

      
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