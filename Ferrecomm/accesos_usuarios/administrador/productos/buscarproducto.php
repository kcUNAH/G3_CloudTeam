<?php
session_start();


if(!isset ($_SESSION['usuario'])){
    echo '
    <script>
    alert("Por favor, debe iniciar seccion");
    window.location= "../../../index.php";
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
        <a href="../../../php/Cerrar_Seccion.php">
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
      <?php include '../conex.php';?>

      <section id="container"  >

      <?php
       
       $busqueda = strtolower($_REQUEST['busqueda']);
       if(empty($busqueda))
       {
        header("location: ../productos.php");
       }
      
      ?>

      <form action="buscarproducto.php" method="get" style="background-color:#DCFFFE ;">
  <input type="text" name="busqueda" style="text-transform:uppercase; margin-left: 40px" id="busqueda" placeholder="Buscar..." value="<?php echo $busqueda; ?>">
  <button type="submit" class="boton-buscar">Buscar</button>
  <a href= "agregarproducto.php" class="btn_newproducto" style="margin-left: 350px"> Nuevo producto<i id="icon_nuevo" class='bx bxs-cart-add'></i></a>
    <a href="../../../fpdf/Reportebuscarproducto.php?buscar=<?php echo $busqueda ?>"   target="_blank" class="btn_pdf"> PDF <i class='bx bxs-file-pdf' ></i></a> 


</form>


&nbsp;&nbsp;&nbsp; 

      <table>
        <thead>
        <tr >
           <th >Codigo</th>
           <th >Categoría</th>
           <th >Nombre</th>
           <th >Descripción</th>
           <th >Precio</th>
           <th >Imagen</th>
           <th >Unidad medida</th>
           <th >Cantidad minima</th>
           <th >Cantidad máxima</th>
           <th >Promociones</th>
           <th >Acción</th>
        </tr>
      </thead>
        
        <?php
       /* include 'php/conexion.php';*/
       include '../conex.php';


       //Paginador

       $categoria = '';
       if($busqueda == 'Construccion'){

         $categoria = "OR id_categoria LIKE '%1%' ";

       }else if($busqueda == 'Industrial'){
        
        $categoria = "OR id_categoria LIKE '%2%' ";

       }else if($busqueda == 'Plomeria'){

        $categoria = "OR id_categoria LIKE '%3%' ";

      }



       $sql_register =mysqli_query($conex,"SELECT COUNT(*) as total_registro FROM tbl_producto
                                                          WHERE (id_producto LIKE '%$busqueda%' OR
                                                                 nombre_producto LIKE '%$busqueda%' OR
                                                                 descripcion_producto LIKE '%$busqueda%' OR
                                                                 precio_producto LIKE '%$busqueda%' OR
                                                                 unidad_medida LIKE '%$busqueda%' OR
                                                                 cantidad_min LIKE '%$busqueda%' OR
                                                                 cantidad_max  LIKE '%$busqueda%'
                                                                 $categoria )  ");
       $result_register = mysqli_fetch_array($sql_register);
       $total_registro = $result_register['total_registro'];

       $por_pagina = 4;

       if(empty($_GET['pagina'])){
          $pagina = 1;
       }else{
          $pagina = $_GET['pagina'];
       }

       $desde = ($pagina-1) * $por_pagina;
       $total_paginas = ceil($total_registro / $por_pagina);

        $query = mysqli_query($conex,"SELECT p.id_producto, c.nombre_categoria, p.nombre_producto, p.descripcion_producto, 
        p.precio_producto, p.img_producto, p.unidad_medida, p.cantidad_min, p.cantidad_max 
        FROM tbl_producto p INNER JOIN tbl_categoria c on p.id_categoria = c.id_categoria 
                                                      WHERE (p.id_producto LIKE '%$busqueda%' OR
                                                             p.nombre_producto LIKE '%$busqueda%' OR
                                                             p.descripcion_producto LIKE '%$busqueda%'OR
                                                             p.precio_producto LIKE '%$busqueda%' OR
                                                             p.unidad_medida LIKE '%$busqueda%' OR
                                                             p.cantidad_min LIKE '%$busqueda%' OR
                                                             p.cantidad_max  LIKE '%$busqueda%' OR
                                                             c.nombre_categoria LIKE '%$busqueda%' ) 
                                                      
                                                      ORDER BY p.id_producto ASC LIMIT $desde,$por_pagina;
        ");


        
        $result = mysqli_num_rows($query);
        if($result > 0){ 

          while($data = mysqli_fetch_array($query)){
            if($data['img_producto'] != 'Imagen.PNG'){
              $foto = 'img/uploads/'.$data['img_producto'];
              //$foto = "<img width='100' src='data:image/jpg;base64,".base64_encode($img_producto)."'>";
            }else{
              $foto = 'img/uploads/'.$data['img_producto'];
              
              //$foto = "<img width='100' src='data:image/jpg;base64,".base64_encode($img_producto)."'>";

              //$foto = 'img/'.$data['foto'];
            }
        ?>
        
        <tr>
            <td><?php echo $data["id_producto"] ?></td>
            <td><?php echo $data["nombre_categoria"] ?></td>
            <td><?php echo $data["nombre_producto"] ?></td>
            <td><?php echo $data["descripcion_producto"] ?></td>
            <td>L. <?php echo $data["precio_producto"] ?></td>
            <td><img width="110" src="<?php echo $foto; ?>" class="card-img-top" alt="<?php echo $data["nombre_producto"] ?>"></td> 
            <td><?php echo $data["unidad_medida"] ?></td>
            <td><?php echo $data["cantidad_min"] ?></td>
            <td> <?php echo $data["cantidad_max"] ?></td>
           <td>
            <a class="link_agregarpromocion" href="productopromocion.php?id=<?php echo $data["id_producto"]; ?>"><i class='bx bx-add-to-queue'></i></a>
            <a class="link_promociones" href="promocion.php"><i class='bx bx-low-vision'></i></a>
            <a class="link_promociones" href="promocion.php"><i class='bx bxs-purchase-tag-alt'></i></a>
          </td>
            <td>
              <!--  <a class="link_factura" href="#"><i class='bx bx-check-double'></i></i></a>-->
                <a class="link_edit" href="editarproducto.php?id=<?php echo $data["id_producto"]; ?>"><i class='bx bx-edit'></i></a>
                <a class="link_delete" href="eliminarproducto.php?id=<?php echo $data["id_producto"]; ?>"><i class='bx bxs-trash'></i></a>
            </td>
        </tr>
        <?php
            }
        }

        ?>

      </table>
      &nbsp;&nbsp;&nbsp; 
   <?php
   
   if($total_registro !=0){
   
   ?>
 <div class="paginador">
     <ul>
      <?php
        if($pagina !=1)
        {
      ?>
      <li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
      <li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
      <?php 
        }
       for($i=1; $i <= $total_paginas; $i++){
          if($i == $pagina){
            echo '<li class="pageSelected">'.$i.'</li>';
          }else{
            echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
          }
       }
       if($pagina != $total_paginas)
       {
       ?>
      <li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
      <li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?>">>|</a></li>
       <?php } ?>
     </ul>
</div>
<?php 
} 
?>

</style>


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
<!--diseño buscar-->
<style type="text/css">
form {
  display: flex;
  align-items: center;
}

input[type="text"] {
  padding: 8px;
  border: none;
  border-radius: 10px;
  margin-right: 10px;
  font-size: 16px;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  padding: 8px 16px;
  font-size: 16px;
}
</style>

</body>
<!--diseño siguiente-->
<style type="text/css">
.navigation {
  display: flex;
  justify-content: left;
  align-items: left;

}

.navigation button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 5px 20px;
  text-align:left;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 1px 2px;
  cursor: pointer;
}

.navigation button:hover {
  opacity: 0.8;
}

.navigation .page-number {
  margin: 0 0px;
  font-size: 10px;
}

</style>
<!--Codigo java ventana flotante-->















</html>

