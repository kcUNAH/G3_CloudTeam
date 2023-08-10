
<?php

include_once "./conexionproducto.php";
include '../../../php/bitacora.php';
//Mostrar datos

if(empty($_GET['id'])){
    header('Location: Productos.php');
}
 $id_producto = $_GET['id'];
 $sql = mysqli_query($conexion, "SELECT p.id_producto,p.nombre_producto, p.descripcion_producto,
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
	background: #2ad313;
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

      <h2>  Editar producto <i class='bx bx-edit'></i></h2>
      
      <form action="productoeditar.php" method="POST" enctype="multipart/form-data" id="formulario">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
      <input type="hidden" name="id_producto" value="<?php echo $id_producto;?>">
        <label for="id_categoria">Categoría</label></br>
        <?php
           $query_categoria = mysqli_query($conexion,"SELECT * from tbl_categoria");
           $result_categoria = mysqli_num_rows($query_categoria)
        ?>
            
                <select name="id_categoria" id="id_categoria">
                   <?php
                     echo $option;
                      if($result_categoria > 0){
                        while ($categoria = mysqli_fetch_array($query_categoria)) {
                        
                   ?>
                   <option value="<?php echo $categoria["id_categoria"]; ?>"><?php echo $categoria["nombre_categoria"]?> </option>
                   <?php
                   }
                   }

                   ?>
                </select>
        
            

                <div class="formulario__grupo" id="grupo__nombre_producto">
				<label for="nombre_producto" class="formulario__label">Nombre producto</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="nombre_producto" id="nombre_producto" style="text-transform:uppercase;" value="<?=$nombre_producto?>" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre del producto tiene que contener letras y contener 3 a 16 de las mismas</p>
			    </div>

                <div class="formulario__grupo" id="grupo__descripcion_producto">
				<label for="descripcion_producto" class="formulario__label">Descripción</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="descripcion_producto" id="descripcion_producto" style="text-transform:uppercase;" value="<?php echo $descripcion_producto;?>" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La descripción del producto debe de tener 4 a 16 letras, solo puede contener números Y letras.</p>
			    </div>

                <div class="formulario__grupo" id="grupo__precio_producto">
				<label for="precio_producto" class="formulario__label">Precio</label>
				<div class="formulario__grupo-input">
					<input type="number" class="field"  name="precio_producto" id="precio_producto" value="<?php echo $precio_producto;?>" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El precio solo puede contener números y puntos</p>
			    </div>

            <p class="input-file-wrapper">
            <label for="upload">Imagen del producto:</label></br>
            <div align="center">
            <?php echo $foto; ?></br>
                </div>
            <input type="file" name="img_producto" id="img_producto" height="70px" > </input>
            </p>
            <div class="formulario__grupo" id="grupo__unidad_medida">
				<label for="unidad_medida" class="formulario__label">Unidad medida</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="unidad_medida" id="unidad_medida" style="text-transform:uppercase;" value="<?php echo $unidad_medida;?>" onblur="cambiarAMayusculas(this);" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener números y letras</p>
			    </div>

                <div class="formulario__grupo" id="grupo__cantidad_min">
				<label for="cantidad_min" class="formulario__label">Cantidad mínima:</label>
				<div class="formulario__grupo-input">
					<input type="number" class="field"  name="cantidad_min" id="cantidad_min" value="<?php echo $cantidad_min;?>" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener numeros y debe ser menor que la cantidad máxima</p>
			    </div>

                <div class="formulario__grupo" id="grupo__cantidad_max">
				<label for="cantidad_max" class="formulario__label">Cantidad máxima:</label>
				<div class="formulario__grupo-input">
					<input type="number" class="field"  name="cantidad_max" id="cantidad_max" value="<?php echo $cantidad_max;?>" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener números y debe ser mayor que la cantidad mínima </p>
			    </div>

            </br>
            
            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>


            <button type="submit" class="btn_agregar">Actualizar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='../productos.php'" class="btn_cancelar">Cancelar</button>


                    <script>
                        function cambiarAMayusculas(elemento) {
                            let texto = elemento.value;
                            elemento.value = texto.toUpperCase();
                        }
                    </script>

                    
                </form>
<script src="formularioproductoeditar.js"></script>

      
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