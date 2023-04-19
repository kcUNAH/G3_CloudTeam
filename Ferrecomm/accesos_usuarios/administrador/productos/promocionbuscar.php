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
    <link rel="stylesheet" href="../../../accesos/CSS/tablapromocion.css">
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
            <a href="../categoria.php">
            <i class='bx bxs-category'></i>
                <span class="links_name">Categorias</span>
            </a>
            <span class="tooltip">Categorias</span>
        </li>
        <li>
            <a href="./promocion.php">
            <i class='bx bxs-purchase-tag-alt'></i>
                <span class="links_name">Promociones</span>
            </a>
            <span class="tooltip">Promociones</span>
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
<h1>  Promociones <i class='bx bxs-purchase-tag-alt'></i></h1>
      <?php include '../conex.php';?>

      <section id="container"  >

      <?php
       
       $busqueda = strtolower($_REQUEST['busqueda']);
       if(empty($busqueda))
       {
        header("location: promocion.php");
       }
      
      ?>

      <form action="promocionbuscar.php" method="get" style="background-color:#DCFFFE ;">
  <input type="text" name="busqueda" style="text-transform:uppercase; margin-left: 40px" id="busqueda" placeholder="Buscar..." value="<?php echo $busqueda; ?>">
  <button type="submit" class="boton-buscar">Buscar</button>
  <a href= "../productos.php" class="btn_productos" style="margin-left: 190px"> Productos<i id="icon_nuevo" class='bx bx-shopping-bag'></i></i></a>
  <a href= "promocionagregar.php" class="btn_newproducto" style="margin-left: 30px"> Nueva promocion<i id="icon_nuevo" class='bx bxs-folder-plus'></i></a>


</form>


&nbsp;&nbsp;&nbsp; 

      <table>
        <thead>
        <tr >
        <th >Promocion</th>
           <th >Fecha inicio</th>
           <th >Fecha final</th>
           <th >Precio venta</th>
           <th >Estado promocion</th>
           <th >Acción</th>
        </tr>
      </thead>
        
        <?php
       /* include 'php/conexion.php';*/
       include '../conex.php';


       //Paginador

       $estadopromocion = '';
       if($busqueda == 'NUEVA'){

         $estadopromocion = "OR id_estado_prom LIKE '%1%' ";

       }



       $sql_register =mysqli_query($conex,"SELECT COUNT(*) as total_registro FROM tbl_promociones
                                                          WHERE (id_promocion LIKE '%$busqueda%' OR
                                                                 nombre_promocion LIKE '%$busqueda%' OR
                                                                 fecha_inicio LIKE '%$busqueda%' OR
                                                                 fecha_final LIKE '%$busqueda%' OR
                                                                 Precio_venta LIKE '%$busqueda%' 
                                                                 $estadopromocion )  ");
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


$query = mysqli_query($conex,"SELECT p.id_promocion, e.estado_promocion, p.nombre_promocion, p.fecha_inicio,
p.fecha_final, p.precio_venta
FROM tbl_promociones p INNER JOIN tbl_estado_promociones e on p.id_estado_prom = e.id_estado_prom 
                   WHERE(p.id_promocion LIKE '%$busqueda%' OR 
                         e.estado_promocion LIKE '%$busqueda%' OR 
                         p.nombre_promocion LIKE '%$busqueda%' OR 
                         p.fecha_inicio LIKE '%$busqueda%' OR
                         p.fecha_final LIKE '%$busqueda%' OR 
                         p.precio_venta LIKE '%$busqueda%' OR
                         e.estado_promocion LIKE '%$busqueda%' )
ORDER BY p.id_promocion ASC LIMIT $desde,$por_pagina;
");
        
        $result = mysqli_num_rows($query);
        if($result > 0){ 

          while($data = mysqli_fetch_array($query)){
           
        ?>
        
        <tr>
            <td><?php echo $data["nombre_promocion"] ?></td>
            <td><?php echo $data["fecha_inicio"] ?></td>
            <td><?php echo $data["fecha_final"] ?></td>
            <td><?php echo $data["precio_venta"] ?></td>
            <td><?php echo $data["estado_promocion"] ?></td>
            <td>
              <!--  <a class="link_factura" href="#"><i class='bx bx-check-double'></i></i></a>-->
                <a class="link_edit" href="promocioneditar.php?id=<?php echo $data["id_promocion"]; ?>"><i class='bx bx-edit'></i></a>
                <a class="link_delete" href="promocioneliminar.php?id=<?php echo $data["id_promocion"]; ?>"><i class='bx bxs-trash'></i></a>
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

