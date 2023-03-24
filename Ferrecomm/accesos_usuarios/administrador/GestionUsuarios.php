<?php
session_start();



if (!isset($_SESSION['usuario'])) {
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
  <link rel="stylesheet" href="../../accesos/CSS/tablas.css">
  <link rel="stylesheet" href="../../accesos/CSS/tablaproducto.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxs-factory icon'></i>
      <div class="logo_name">FERRECOMM</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="Menu.php">
          <i class='bx bxs-home'></i>
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
          <i class='bx bx-log-out' id="log_out"></i>
          <div class="Salir">Cerrar Sesión</div>
        </li>
      </a>
    </ul>
  </div>
  <section class="home-section">
    <div class="text">Bienvedio a la Gestión de Usuarios</div>


    <?php include 'conex.php'; ?>
    <section id="container">


      <head>


        <link rel="stylesheet" href="./fontawesome-free/css/all.min.css">
        <div class="container-fluid" style=" background-image: URL(Ferrecomm\accesos\Imagenes\Logo.jpeg);"></div>
      </head>
      <section id="container">
        <form action="buscar_usuario.php" method="get" class="form_search" style="background-color:#DCFFFE ;">
          <input type="text" name="busqueda" style="margin-left: 40px" id="busqueda" placeholder="Buscar...">
          <button type="submit" value="Buscar" class="boton-buscar">Buscar</button>
          <a href="registro.php" class="btn_newproducto"> Crear usuario<i id="icon_nuevo"
              class='bx bxs-cart-add'></i></a>
          <a href="usuario_activo.php" class="btn_activo"> Usuarios Activos<i id="icon_nuevo"
              class='bx bxs-cart-add'></i></a>
          <a href="usuario_inactivo.php" class="btn_inactivo">Usuarios Inactivos<i id="icon_nuevo"
              class='bx bxs-cart-add'></i></a>
          <a href="usuario_nuevo.php" class="btn_nuevo">Usuarios Nuevos<i id="icon_nuevo"
              class='bx bxs-cart-add'></i></a>
          <a href="#" class="btn_pdf"> PDF <i class='bx bxs-file-pdf'></i></a>


        </form>




        <?php include 'conex.php'; ?>
        <section id="container">

          <table>
            <thead>
              <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Ultima Conexión</th>
                <th>Fecha Vencimiento</th>
                <th>Correo</th>
                <th>Creado Por</th>
                <th>Fecha Creación</th>
                <th>Fecha Modificación</th>

                <th>Acciones</th>

              </tr>
            </thead>
            <?php
            /* include 'php/conexion.php';*/
            include 'conex.php';

            //Paginador
            // $sqlregistre = mysqli_query($conex, "SELECT COUNT(*) AS total_registro FROM tbl_ms_usuario WHERE estado_usuario = 1");
            $sqlregistre = mysqli_query($conex, "SELECT COUNT(*) AS total_registro FROM tbl_ms_usuario");
            $result_registre = mysqli_fetch_array($sqlregistre);
            $total_registro = $result_registre['total_registro'];

            $por_pagina = 4;

            if (empty($_GET['pagina'])) {
              $pagina = 1;
            } else {
              $pagina = $_GET['pagina'];
            }

            $desde = ($pagina - 1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);

            $query = mysqli_query($conex, "SELECT u.id_usuario, u.usuario, u.nombre_usuario, u.estado_usuario,  r.rol, 
        u.fecha_ultima_conexion,  u.fecha_vencimiento, u.correo_electronico, u.creado_por, 
        u.fecha_creacion, u.fecha_modificacion FROM tbl_ms_usuario u INNER JOIN tbl_ms_rol r on u.id_rol = r.id_rol
        LIMIT $desde,$por_pagina");



            $result = mysqli_num_rows($query);
            if ($result > 0) { //si hay registros
            
              while ($data = mysqli_fetch_array($query)) {
                ?>

                <tr>
                  <td>
                    <?php echo $data["id_usuario"] ?>
                  </td>
                  <td>
                    <?php echo $data["usuario"] ?>
                  </td>
                  <td>
                    <?php echo $data["nombre_usuario"] ?>
                  </td>
                  <td>
                    <?php echo $data["rol"] ?>
                  </td>
                  <td>
                    <?php echo $data["fecha_ultima_conexion"] ?>
                  </td>

                  <td>
                    <?php echo $data["fecha_vencimiento"] ?>
                  </td>
                  <td>
                    <?php echo $data["correo_electronico"] ?>
                  </td>
                  <td>
                    <?php echo $data["creado_por"] ?>
                  </td>
                  <td>
                    <?php echo $data["fecha_creacion"] ?>
                  </td>
                  <td>
                    <?php echo $data["fecha_modificacion"] ?>
                  </td>
                  <td>
                    <!--  <a class="link_factura" href="#"><i class='bx bx-check-double'></i></i></a>-->
                    <a class="link_edit" href="editar.php?id=<?php echo $data["id_usuario"]; ?>"><i
                        class='bx bx-edit'></i></a>
                    <a class="link_delete" href="elim_usuario.php?id=<?php echo $data["id_usuario"]; ?>"><i
                        class='bx bxs-trash'></i></a>
                  </td>


                  <!--  <a class="link_edit" href="editar.php?id=<// echo $data["id_usuario"]; ?>">Editar</a> -->
                  <!--   <a class="link_delete" href="elim_usuario.php?id=<// echo $data["id_usuario"]; ?>">Eliminar</a>-->

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