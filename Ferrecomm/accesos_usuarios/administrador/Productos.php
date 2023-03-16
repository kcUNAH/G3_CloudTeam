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

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../accesos/CSS/tablaproducto.css">
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
            <a href="Menu.php">
                <i class='bx bxs-home' ></i>
                <span class="links_name">Inicio</span>
            </a>
            <span class="tooltip">Inicio</span>
        </li>
        <li>
            <a href="Facturacion.php">
                <i class='bx bx-money'></i>
                <span class="links_name">Facturación</span>
            </a>
            <span class="tooltip">Facturación</span>
        </li>
        <li>
            <a href="Compras.php">
                <i class='bx bxs-cart'></i>
                <span class="links_name">Compras</span>
            </a>
            <span class="tooltip">Compras</span>
        </li>
        <li>
            <a href="Productos.php">
                <i class='bx bx-shopping-bag'></i>
                <span class="links_name">Productos</span>
            </a>
            <span class="tooltip">Productos</span>
        </li>
        <li>
            <a href="Seguridad.php">
                <i class='bx bx-shield-quarter'></i>
                <span class="links_name">Seguridad</span>
            </a>
            <span class="tooltip">Seguridad</span>
        </li>
        <li>
            <a href="Proveedores.php">
                <i class='bx bxs-user'></i>
                <span class="links_name">Proveedores</span>
            </a>
            <span class="tooltip">Proveedores</span>
        </li>
        <li>
            <a href="Inventario.php">
                <i class='bx bx-package'></i>
                <span class="links_name">Inventario</span>
            </a>
            <span class="tooltip">Inventario</span>
        </li>
        <li>
            <a href="GestionUsuarios.php">
                <i class='bx bx-package'></i>
                <span class="links_name">Usuarios</span>
            </a>
            <span class="tooltip">Usuarios</span>
        </li>
        <a href="../../php/Cerrar_Seccion.php">
     <li class="profile">
         <i class='bx bx-log-out' id="log_out" ></i>
         <div class="Salir">Cerrar Sesión</div>
     </li>
    </a>
    </ul>
  </div>
  <section class="home-section">
</br>
      <h1>  Productos <i class='bx bx-shopping-bag'></i></h1>
      <?php include 'conex.php';?>
      <section id="container">
    
      <a href="./productos/agregarproducto.php" class="btn_newproducto"> Nuevo producto<i id="icon_nuevo" class='bx bxs-cart-add'></i></a>
      <a href="#" class="btn_pdf"> PDF <i class='bx bxs-file-pdf' ></i></a> 
      

      <table>
        <thead>
        <tr >
           <th  >ID</th>
           <th >Categoría</th>
           <th >Nombre</th>
           <th >Descripción</th>
           <th >Precio</th>
           <th >Imagen</th>
           <th >Unidad medida</th>
           <th >Cantidad minima</th>
           <th >Cantidad máxima</th>
           <th >Acción</th>
        </tr>
      </thead>
        
        <?php
       /* include 'php/conexion.php';*/
       include 'conex.php';
       
        $query = mysqli_query($conex,"SELECT p.id_producto, c.nombre_categoria, p.nombre_producto, p.descripcion_producto, 
        p.precio_producto, p.img_producto, p.unidad_medida, p.cantidad_min, p.cantidad_max 
        FROM tbl_producto p INNER JOIN tbl_categoria c on p.id_categoria = c.id_categoria");


        
        $result = mysqli_num_rows($query);
        if($result > 0){ 

            while($data = mysqli_fetch_array($query)){
                $img_producto = $data['img_producto'];

                $valor = "<img width='100' src='data:image/jpg;base64,".base64_encode($img_producto)."'>";

                
        ?>
        
        <tr>
            <td><?php echo $data["id_producto"] ?></td>
            <td><?php echo $data["nombre_categoria"] ?></td>
            <td><?php echo $data["nombre_producto"] ?></td>
            <td><?php echo $data["descripcion_producto"] ?></td>
            <td>L. <?php echo $data["precio_producto"] ?></td>
            <td> <?php echo $valor?></td>
            <td><?php echo $data["unidad_medida"] ?></td>
            <td><?php echo $data["cantidad_min"] ?></td>
            <td> <?php echo $data["cantidad_max"] ?></td>
    
            <td>
              <!--  <a class="link_factura" href="#"><i class='bx bx-check-double'></i></i></a>-->
                <a class="link_edit" href="./productos/editarproducto.php?id=<?php echo $data["id_producto"]; ?>"><i class='bx bx-edit'></i></a>
                <a class="link_delete" href="./productos/eliminarproducto.php?id=<?php echo $data["id_producto"]; ?>"><i class='bx bxs-trash'></i></a>
            </td>
        </tr>
        <?php
            }
        }

        ?>

      </table>

      
  </section>
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

