<?php

include '../conex.php';
include_once "./conexionproducto.php";
include '../../../php/bitacora.php';
//Mostrar datos





?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../../accesos/CSS/tablapromocion.css">
    <link rel="stylesheet" href="../../../accesos/CSS/tablaproducto.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php include "menu.php"; ?>
   </head>
<body>
  
  <section class="home-section">
</br>
      <h1>  Promociones del producto <i class='bx bx-shopping-bag'></i></h1>
      <?php include '../conex.php';?>

      <section id="container"  > <?php
       
      

       $busqueda = strtolower($_GET['id']);
       if(empty($busqueda))
       {
        header('Location: ../tablapromocion.php');
       }
      
      ?>
            <form action="tablapromocionbuscar.php" method="get" style="background-color:#DCFFFE ;">
  <input type="text" name="busqueda" style="text-transform:uppercase; margin-left: 40px" id="busqueda" placeholder="Buscar...">
  <button type="submit" class="boton-buscar">Buscar</button>
  <a href= "../productos.php" class="btn_productos" style="margin-left: 100px"> Regresar a Productos<i id="icon_nuevo" class='bx bx-shopping-bag'></i></i></a>
  <a href="../../../fpdf/Reportepromocionproducto.php?buscar=<?php echo $busqueda ?>"   target="_blank" class="btn_pdf"> PDF <i class='bx bxs-file-pdf' ></i></a> 

   

</form>


&nbsp;&nbsp;&nbsp; 

      <table>
        <thead>
        <tr >
           <th >Promoción</th>
           <th >Producto</th>
           <th >Cantidad</th>
           <th >Acción</th>
           
        </tr>
      </thead>
        
        <?php
       /* include 'php/conexion.php';*/
       include '../conex.php';
       //Paginador

       
       $sql_register =mysqli_query($conex,"SELECT COUNT(*) as total_registro FROM tbl_promociones_producto
                                                          WHERE  (
                                                                 id_producto LIKE '%$busqueda%'
                                                                 
                                                                  )  ");
       $result_register = mysqli_fetch_array($sql_register);
       $total_registro = $result_register['total_registro'];

       $por_pagina = 10;

       if(empty($_GET['pagina'])){
          $pagina = 1;
       }else{
          $pagina = $_GET['pagina'];
       }

       $desde = ($pagina-1) * $por_pagina;
       $total_paginas = ceil($total_registro / $por_pagina);

        
       $query = mysqli_query($conexion, "SELECT p.id_promocion_producto, p.cantidad,
       (p.id_promocion) as id_promocion, (m.nombre_promocion) as promocion, (p.id_producto) as id_producto, (r.nombre_producto) as producto
      FROM tbl_promociones_producto p 
      INNER JOIN tbl_promociones m 
      on p.id_promocion = m.id_promocion
      INNER JOIN tbl_producto r 
      on p.id_producto = r.id_producto
      WHERE r.id_producto = $busqueda;");


       
       $result = mysqli_num_rows($query);
       if($result > 0){ 

         while($data = mysqli_fetch_array($query)){
           

                
        ?>
        
        <tr>
            <td><?php echo $data['promocion'] ?></td>
            <td><?php echo $data['producto']  ?></td>
            <td><?php echo $data['cantidad'] ?></td>
            <td>
                <a class="link_delete" href="tablapromocioneliminar.php?id=<?php echo $data["id_promocion_producto"]; ?>"><i class='bx bxs-trash'></i></a>
            </td>
        </tr>
        <?php
         }}

        ?>

      </table>
      &nbsp;&nbsp;&nbsp; 
   
 <div class="paginador">
     <ul>
      <?php
        if($pagina !=1)
        {
      ?>
      <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
      <li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
      <?php 
        }
       for($i=1; $i <= $total_paginas; $i++){
          if($i == $pagina){
            echo '<li class="pageSelected">'.$i.'</li>';
          }else{
            echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
          }
       }
       if($pagina != $total_paginas)
       {
       ?>
      <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
      <li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
       <?php } ?>
     </ul>
</div>


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
table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    background-color: #fff;
  }
  /* adaptar la tabla a la pantalla*/ 
@media (max-width: 600px) {
    table {
      display: block;
      overflow-x: auto;
    }
  }

th, td {
    border: 1px solid #ccc;
    padding: 7px;
    text-align: left;
  }
</style>
<!--Codigo java ventana flotante-->
</html>

