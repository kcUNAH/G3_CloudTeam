<?php
session_start();

if(!isset ($_SESSION['usuario'])){
    echo '
    <script>
    alert("Por favor, debe iniciar seccion");
    window.location= "index.php";
    </script>
    ';
    //header("localitation: index.php");
    session_destroy();
    die();
}

?>
<?php

include_once "./conexionproducto.php";

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
        $img_producto = $data['img_producto'];
        $unidad_medida = $data['unidad_medida'];
        $cantidad_min = $data['cantidad_min'];
        $cantidad_max = $data['cantidad_max'];

        $valor = "<img src='data:image/jpg;base64,".base64_encode($img_producto)."'>";

        if($id_categoria == 1){
            $option = '<option value="'.$id_categoria.'"select>'.$categoria.'</option>';
        }else if($id_categoria == 2){
            $option = '<option value="'.$id_categoria.'"select>'.$categoria.'</option>';
        }else if($id_categoria == 3){
            $option = '<option value="'.$id_categoria.'"select>'.$categoria.'</option>';
        }

    }
 }


 


if (!empty($_POST)) {

    if (empty($_POST['id_categoria']) || empty($_POST['nombre_producto']) || empty($_POST['descripcion_producto'])
    || empty($_POST['precio_producto'])|| empty($_POST['unidad_medida'])
    || empty($_POST['cantidad_min'])|| empty($_POST['cantidad_max']))  
        {
            $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';
    } else {
        $id_producto = $_POST['id_producto'];
        $categoria = $_POST['id_categoria'];
        $nombre_producto =$_POST['nombre_producto'];
        $descripcion_producto = $_POST['descripcion_producto'];
        $precio_producto = $_POST['precio_producto'];
        $imagen_producto = $_FILES['img_producto'];
        $unidad_medida = $_POST['unidad_medida'];
        $cantidad_min = $_POST['cantidad_min'];
        $cantidad_max = $_POST['cantidad_max'];
        
       // $img_producto = $_POST['img_producto'];

               $query = mysqli_query($conexion,"SELECT * FROM tbl_producto 
                WHERE (nombre_producto = '$nombre_producto' AND id_producto != $id_producto)");

            $result = mysqli_fetch_array($query);
        
            if($imagen_producto == 0){ //Si ya existe manda eel mensaje 
                $alert= '<p class= "msg_error">El producto ya existe.</p>';
                
            }elseif($imagen_producto == 0){
                 
            $nombimagen =$_FILES['img_producto']['name'];
            $tamañoarchivo=$_FILES['img_producto']['size'];
            $imagensubida = fopen($_FILES['img_producto']['tmp_name'],'r');
            $img_productos =fread($imagensubida,$tamañoarchivo);
        
            $img_producto = mysqli_escape_string($conexion,$img_productos);

            $query_update = mysqli_query($conexion, "UPDATE tbl_producto SET id_categoria = '$categoria',
            nombre_producto = '$nombre_producto', descripcion_producto = '$descripcion_producto', 
            img_producto = '$img_producto', precio_producto ='$precio_producto', unidad_medida = '$unidad_medida', 
            cantidad_min = '$cantidad_min', cantidad_max = '$cantidad_max'
            WHERE id_producto = $id_producto ");

            
            if ($query_update) {
              echo
              '<script>
              alert("Producto actualizado correctamente");
              window.location= "../Productos.php";
              </script>
               ';
             } else {
              echo
             '<script>
             alert("Error al actualizar el producto");
              window.location= "actualizar.php";
             </script>
              ';
             }
            }else{
                
                $query_update2 = mysqli_query($conexion, "UPDATE tbl_producto SET id_categoria = '$categoria',
                nombre_producto = '$nombre_producto', descripcion_producto = '$descripcion_producto', 
                precio_producto ='$precio_producto', unidad_medida = '$unidad_medida', 
                cantidad_min = '$cantidad_min', cantidad_max = '$cantidad_max'
                WHERE id_producto = $id_producto ");

            if ($query_update2) {
                echo
                '<script>
                alert("Producto actualizado correctamente");
                window.location= "../Productos.php";
                </script>
                ';
            } else {
                echo
                '<script>
                alert("Error al actualizar el producto");
                window.location= "actualizar.php";
                </script>
                ';
            }
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
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
        <i class='bx bxs-factory icon'></i>
        <div class="logo_name">FERRECOMM</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
        <li>
            <a href="../Menu.php">
                <i class='bx bxs-home' ></i>
                <span class="links_name">Inicio</span>
            </a>
            <span class="tooltip">Inicio</span>
        </li>
        <li>
            <a href="../Facturacion.php">
                <i class='bx bx-money'></i>
                <span class="links_name">Facturación</span>
            </a>
            <span class="tooltip">Facturación</span>
        </li>
        <li>
            <a href="../Compras.php">
                <i class='bx bxs-cart'></i>
                <span class="links_name">Compras</span>
            </a>
            <span class="tooltip">Compras</span>
        </li>
        <li>
            <a href="../Productos.php">
                <i class='bx bx-shopping-bag'></i>
                <span class="links_name">Productos</span>
            </a>
            <span class="tooltip">Productos</span>
        </li>
        <li>
            <a href="../Seguridad.php">
                <i class='bx bx-shield-quarter'></i>
                <span class="links_name">Seguridad</span>
            </a>
            <span class="tooltip">Seguridad</span>
        </li>
        <li>
            <a href="../Proveedores.php">
                <i class='bx bxs-user'></i>
                <span class="links_name">Proveedores</span>
            </a>
            <span class="tooltip">Proveedores</span>
        </li>
        <li>
            <a href="../Inventario.php">
                <i class='bx bx-package'></i>
                <span class="links_name">Inventario</span>
            </a>
            <span class="tooltip">Inventario</span>
        </li>
        <li>
            <a href="../GestionUsuarios.php">
                <i class='bx bx-package'></i>
                <span class="links_name">Usuarios</span>
            </a>
            <span class="tooltip">Usuarios</span>
        </li>
        <a href="../../../index.php">
     <li class="profile">
         <i class='bx bx-log-out' id="log_out" ></i>
         <div class="Salir">Cerrar Sesión</div>
     </li>
    </a>
    </ul>
  </div>
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
      
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
      <input type="hidden" name="id_producto" value="<?php echo $id_producto;?>">
        <label for="id_categoria">Categoria</label></br>
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
        
            <p>Nombre del producto:
            <input type="text" class="field" name="nombre_producto" id="nombre_producto" value="<?=$nombre_producto?>">
            </p>
            <p>Descripcion:
             <input type="text" class="field" name="descripcion_producto" id="descripcion_producto" value="<?php echo $descripcion_producto;?>" >
            </p>
             <p>Precio:
            <input type="text" class="field" name="precio_producto" id="precio_producto" value="<?php echo $precio_producto;?>" >
            </p>
            <p class="input-file-wrapper">
            <label for="upload">Imagen del producto:</label></br>
            <div align="center">
            <img height="100px"  src="data:image/jpg;base64,<?php echo base64_encode($img_producto); ?>"/></div>
            <input type="file" name="img_producto" id="img_producto" height="70px" src="data:image/jpg;base64,<?php echo base64_encode($img_producto); ?>"/  > </input>
            </p>
            <p>Unidad medida:
            <input type="text" class="field" name="unidad_medida" id="unidad_medida" value="<?php echo $unidad_medida;?>" >
            </p>
            <p>Cantidad minima:
            <input type="text" class="field" name="cantidad_min" id="cantidad_min" value="<?php echo $cantidad_min;?>">
            </p>
            <p>Cantidad maxima:
            <input type="text" class="field" name="cantidad_max" id="cantidad_max" value="<?php echo $cantidad_max;?>">
            </p>
            </br>
            
      <button class="btn_agregar">Actualizar</button>
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