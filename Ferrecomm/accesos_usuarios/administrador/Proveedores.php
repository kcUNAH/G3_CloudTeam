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
    <link rel="stylesheet" href="accesos/CSS/EstiloMenu.css">
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
        <a href="index.php">
     <li class="profile">
         <i class='bx bx-log-out' id="log_out" ></i>
         <div class="Salir">Cerrar Sesión</div>
     </li>
    </a>
    </ul>
  </div>
  <section class="home-section">
    <!-- Aqui inicia el formulario-->
    <i class='bx bxs-group icon'></i> 
    <div class="text">Proveedores</div><hr> </hr>
    <i class='bx bx-search'> 
        <input type="text" id="" name="" placeholder="Buscar">
    </i>

    <button class="Agregar"> <i class='bx bx-user-plus'></i> Agregar Nuevo</button>
    <button class="Pdf"> <i class='bx bxs-file-pdf' ></i> PDF</button>
    <hr> </hr>
    <table class="Tbl_Proveedores">   <tr>
        <th>Numero</th>
        <th>RTN</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Dirección</th>
        <th>Acción 
            <hr> </hr>
            <!-- <button class="Edit">Editar</button>
            <button class="Eliminar">Eliminar</button>-->
        </th>
      </tr>
      <tr>
        <td>1</td>
        <td>0801-2000-12909</td>
        <td>Marcos Zuniga</td>
        <td>9897-2354</td>
        <td>marcosz@gmail.com</td>
        <td>La Sosa</td>
        <td><button class="Edit">Editar</button>
            <button class="Eliminar">Eliminar</button></td>
      </tr>
    </table> 
    <hr> </hr>
    <div class="Listado">Proveedores registrados 1 de 15</div> 
    <button class="Anterior"> <i class='bx bx-left-arrow-alt'></i> Anterior</button>
    <button class="Siguiente">Siguiente <i class='bx bx-right-arrow-alt' ></i></button>
    <!-- Aqui termina el formularios-->
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
