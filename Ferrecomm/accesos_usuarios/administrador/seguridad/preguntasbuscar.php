

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
  <link rel="stylesheet" href="../../../accesos/CSS/tabladescuentos.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include "../productos/menu.php"; ?>
</head>

<body>
  <section class="home-section">
</br>
  <h1>  Preguntas ¿? </h1>
  <?php include '../conex.php';?>

<section id="container"  >

<?php
 
 $busqueda = strtolower($_REQUEST['busqueda']);
 if(empty($busqueda))
 {
  echo '<script>
   window.location= "./preguntas.php";
  </script>
  ';
 }

?>


        <link rel="stylesheet" href="./fontawesome-free/css/all.min.css">
        <div class="container-fluid" style=" background-image: URL(Ferrecomm\accesos\Imagenes\Logo.jpeg);"></div>
      </head>
      <section id="container"  >
      <form action="preguntasbuscar.php" method="get" style="background-color:#DCFFFE ;">
  <input type="text" name="busqueda" style="text-transform:uppercase; margin-left: 40px" id="busqueda" placeholder="Buscar...">
  <button type="submit" class="boton-buscar">Buscar</button>
  <a href="preguntasagregar.php" class="btn_nuevorpoducto" > Nueva pregunta ¿?</a>
  <a href="../../../fpdf/Reportepreguntasbuscar.php?buscar=<?php echo $busqueda ?>"   target="_blank" class="btn_pdf"> PDF <i class='bx bxs-file-pdf' ></i></a> 


        </form>




        <?php include '../conex.php'; ?>
        <section id="container">
<br>
          <table style="text-align:center;">
            <thead>
              <tr>
               
                <th>Pregunta</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>

              </tr>
            </thead>
            <?php

            include '../conex.php';

            //Paginador
            $sql_register =mysqli_query($conex,"SELECT COUNT(*) as total_registro FROM tbl_ms_preguntas
            WHERE (id_pregunta LIKE '%$busqueda%' OR
                   pregunta LIKE '%$busqueda%' OR
                   fecha_creacion LIKE '%$busqueda%' )  ");

            $result_registre = mysqli_fetch_array($sql_register);
            $total_registro = $result_registre['total_registro'];

            $por_pagina = 10;

            if (empty($_GET['pagina'])) {
              $pagina = 1;
            } else {
              $pagina = $_GET['pagina'];
            }

            $desde = ($pagina - 1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);

            $query = mysqli_query($conex,"SELECT id_pregunta, pregunta, fecha_creacion
            FROM tbl_ms_preguntas WHERE(id_pregunta LIKE '%$busqueda%' OR 
                                     pregunta LIKE '%$busqueda%' OR 
                                     fecha_creacion LIKE '%$busqueda%' )
            ORDER BY id_pregunta ASC LIMIT $desde,$por_pagina;
            ");

            $result = mysqli_num_rows($query);
            if ($result > 0) { //si hay registros
            
              while ($data = mysqli_fetch_array($query)) {
                ?>

                <tr>
                 
                  <td>
                    <?php echo $data["pregunta"] ?>
                  </td>
                  <td>
                    <?php echo $data["fecha_creacion"] ?>
                  </td>
                  <td>
                    <a class="link_edit" href="preguntaseditar.php?id=<?php echo $data["id_pregunta"]; ?>"><i
                        class='bx bx-edit'></i></a>
                    <a class="link_delete" href="preguntaseliminar.php?id=<?php echo $data["id_pregunta"]; ?>"><i
                        class='bx bxs-trash'></i></a>
                  </td>

                </tr>
                <?php
              }
            }

            ?>

          </table>
          <div class="paginador">
            <ul>
            <?php
            if($pagina != 1) //Si la pagina es distinta a 1
            {
            ?>
              <li><a href="?pagina=<?php echo 1;?>">|<</a></li>
              <li><a href="?pagina=<?php echo $pagina -1;?>"><<</a></li>
              <?php
              }
              for ($i = 1; $i <= $total_paginas; $i++) {
                # code...
                if($i == $pagina){
                  echo '<li class="pageSelected">'.$i.'</a></li>';
                }else{
                  echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                }
              }
            if($pagina != $total_paginas){
            ?>
              <li><a href="?pagina=<?php echo  $pagina + 1; ?>">>></a></li>
              <li><a href="?pagina=<?php echo $total_paginas;?>">>|</a></li>
              <?php 
            } 
            ?>
            </ul>
          </div>

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
</body>

</html>