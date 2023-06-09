



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
  <link rel="stylesheet" href="../../accesos/CSS/tablas.css">
  <link rel="stylesheet" href="../../accesos/CSS/tabla_inventario.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include "Header.php"; ?>
</head>

<body>
  
  <section class="home-section">
  <h1>  Historial de Inventario <i class='bx bx-package'></i></h1>


    <?php include 'conex.php'; ?>
    <section id="container">
<!--  Botón busqueda de usuarios --> 
<?php
      $busqueda = strtolower($_REQUEST['busqueda']);
      if(empty($busqueda))
      {
        echo '<script>
         window.location= "VerMasInventario.php";
        </script>
        ';
      }
      ?>

      <head>

       
        <link rel="stylesheet" href="./fontawesome-free/css/all.min.css">
        <div class="container-fluid" style=" background-image: URL(Ferrecomm\accesos\Imagenes\Logo.jpeg);"></div>
      </head>
      <section id="container"  >
      <form action="buscar_historial_inventario.php" method="get" class="form_search" style="background-color:#DCFFFE ;">
          <input type="text" name="busqueda" style="text-transform:uppercase;" style="text-transform:uppercase;" style="margin-left: 40px" id="busqueda" placeholder="Buscar..." value="<?php echo $busqueda; ?>">
          <button type="submit" value="Buscar" class="boton-buscar">Buscar</button>
          <a href="../../fpdf/Reporte_Historial_Buscar.php?buscar=<?php echo $busqueda ?>"   target="_blank" class="btn_pdf"> PDF <i class='bx bxs-file-pdf' ></i></a> 

 
  
        </form>




        <?php include 'conex.php'; ?>
        <section id="container">

          <table>
            <thead>
            <tr>
                <th> Producto</th>
                <th> Usuario</th>
                <th> Cantidad en Movimiento</th>
                
                <th> Tipo de movimiento</th>
                <th> Fecha de movimiento </th>
                <th> Comentario </th>
              </tr>
            </thead>
            <?php
            /* include 'php/conexion.php';*/
            include 'conex.php';

            //Paginador
            // $sqlregistre = mysqli_query($conex, "SELECT COUNT(*) AS total_registro FROM tbl_ms_usuario WHERE estado_usuario = 1");
           // $sqlregistre = mysqli_query($conex, "SELECT COUNT(*) AS total_registro FROM tbl_inventario");
           // $result_registre = mysqli_fetch_array($sqlregistre);
           // $total_registro = $result_registre['total_registro'];
//BUSQUEDA
$movimiento = '';
if($busqueda == 'Compra'){

    $movimiento = "OR id_tipo_mov_invt LIKE '%1%' ";

}else if($busqueda == 'Venta'){
 
    $movimiento = "OR id_tipo_mov_invt LIKE '%2%' ";

}else if($busqueda == 'Anular Venta'){
 
    $movimiento = "OR id_tipo_mov_invt LIKE '%3%' ";
   
}else if($busqueda == 'Anuelar Compra'){

    $movimiento = "OR id_tipo_mov_invt LIKE '%4%' ";

}
            
    $sql_register =mysqli_query($conex,"SELECT COUNT(*) as total_registro FROM tbl_mov_inventario
        WHERE (id_producto LIKE '%$busqueda%' OR
                id_usuario LIKE '%$busqueda%' OR
                cantidad_mov LIKE '%$busqueda%' OR
                fecha_mov  LIKE '%$busqueda%' OR
                comentario  LIKE '%$busqueda%'
                $movimiento )  ");
    $result_register = mysqli_fetch_array($sql_register);
    $total_registro = $result_register['total_registro'];
            
            
            
            $por_pagina = 10;

            if (empty($_GET['pagina'])) {
              $pagina = 1;
            } else {
              $pagina = $_GET['pagina'];
            }

            $desde = ($pagina - 1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);


             
            $query = mysqli_query($conex, "SELECT m.id_mov_invent, p.id_producto,p.nombre_producto, u.id_usuario, u.nombre_usuario, 
            m.cantidad_mov, h.id_tipo_mov_invt, h.movimiento, m.fecha_mov, m.comentario
           FROM tbl_mov_inventario m 
           INNER JOIN tbl_producto p on m.id_producto = p.id_producto 
           INNER JOIN tbl_tipo_mov_invt h on m.id_tipo_mov_invt = h.id_tipo_mov_invt
           INNER JOIN tbl_ms_usuario u on m.id_usuario = u.id_usuario 
            WHERE (p.nombre_producto LIKE '%$busqueda%' OR
                    u.nombre_usuario LIKE '%$busqueda%' OR
                    m.cantidad_mov LIKE '%$busqueda%' OR
                    m.fecha_mov  LIKE '%$busqueda%' OR
                    m.comentario  LIKE '%$busqueda%' OR
                    h.movimiento LIKE '%$busqueda%')
            ORDER BY m.id_mov_invent ASC
            LIMIT $desde,$por_pagina");



      //  $query = mysqli_query($conex,"SELECT p.id_producto, i.id_inventario, c.nombre_categoria, p.nombre_producto, p.descripcion_producto, 
      //  p.precio_producto, p.img_producto, p.unidad_medida, p.cantidad_min, p.cantidad_max 
       // FROM tbl_producto p 
      //  INNER JOIN tbl_inventario i on p.id_inventario = p.id_inventario
      //  INNER JOIN tbl_categoria c on p.id_categoria = c.id_categoria 
       // ORDER BY p.id_producto ASC LIMIT $desde,$por_pagina;
       // ");

            $result = mysqli_num_rows($query);
            if ($result > 0) { //si hay registros
            
              while ($data = mysqli_fetch_array($query)) {
                ?>

                <tr>
                  
                <td>
                    <?php echo $data["nombre_producto"] ?>
                  </td>
                  <td>
                    <?php echo $data["nombre_usuario"] ?>
                  </td>
                  <td>
                    <?php echo $data["cantidad_mov"] ?>
                  </td>
                  <td>
                    <?php echo $data["movimiento"] ?>
                  </td>
                  <td>
                    <?php echo $data["fecha_mov"] ?>
                  </td>
                  <td>
                    <?php echo $data["comentario"] ?>
                </td>
                  
                 
                

                </tr>
                <?php
              }
            }

            ?>

          </table>
   
          <?php
          if($total_registro !=0){

          
?>
          <div class="paginador">
            <ul>
            <?php
            if($pagina != 1) //Si la pagina es distinta a 1
            {
            ?>
              <li><a href="?pagina=<?php echo 1;?>&busqueda=<?php echo $busqueda;?>">|<</a></li>
              <li><a href="?pagina=<?php echo $pagina -1;?>&busqueda=<?php echo $busqueda;?>"><<</a></li>
              <?php
              }
              for ($i = 1; $i <= $total_paginas; $i++) {
                # code...
                if($i == $pagina){
                  echo '<li class="pageSelected">'.$i.'</a></li>';
                }else{
                  echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
                }
              }
            if($pagina != $total_paginas){
            ?>
              <li><a href="?pagina=<?php echo  $pagina + 1; ?>&busqueda=<?php echo $busqueda;?>">>></a></li>
              <li><a href="?pagina=<?php echo $total_paginas;?>&busqueda=<?php echo $busqueda;?>">>|</a></li>
              <?php 
            } 
            ?>
            </ul>
          </div>
          <?php
          }
          ?>

        </section>


        <script>
          let sidebar = document.querySelector(".sidebar");
          let closeBtn = document.querySelector("#btn");
          let searchBtn = document.querySelector(".bx-search");

          closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
          });

          function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
              closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
              closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
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
.btn_nuevorpoducto{
    display: inline-block;
    background: #306fe6;
    color:rgb(255, 255, 255);
    padding: 1px 20px;
    border-radius: 10px;
    margin: 10px;
    text-decoration: none;

} 
.btnactivo{
    display: inline-block;
    background: green;
    color:rgb(255, 255, 255);
    padding: 1px 20px;
    border-radius: 10px;
    margin: 10px;
    text-decoration: none;

} 
.btninactivo{
    display: inline-block;
    background: red;
    color:rgb(255, 255, 255);
    padding: 1px 20px;
    border-radius: 10px;
    margin: 10px;
    text-decoration: none;

} 
.pdf{
    display: inline-block;
    background: orange;
    color:rgb(255, 255, 255);
    padding: 1px 20px;
    border-radius: 10px;
    margin: 10px;
    text-decoration: none;

} 
</style>
</body>
<!--diseño siguiente-->
<style type="text/css">
  .paginador {
    display: flex;
    justify-content: left;
    align-items: left;
    justify-content: flex-end;

  }

  

  .paginador button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 5px 20px;
    text-align: left;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 1px 2px;
    cursor: pointer;
  }

  .paginador button:hover {
    opacity: 0.8;
  }

  .paginador .page-number {
    margin: 0 0px;
    font-size: 10px;
  }

  .paginador a,
  .pageSelected {
    color: #428bca;
    border: 1px solid #ddd;
    padding: 5px;
    display: inline-block;
    font-size: 14px;
    text-align: center;
    width: 35px;
  }

  .paginador a:hover {
    bacbackground-color: #ddd;
  }

  .pageSelected {
    color: white;
    background: #428bca;
    border: 1px solid: #428bca;
  }
</style>

<a href="VerMasInventario.php" class="btn_pdf">Atrás</a>
</body>

</html>