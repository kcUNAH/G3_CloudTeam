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
            <a href="Menu_facturacion.php">
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
            <a href="Comprobante.php">
            <i class='bx bx-spreadsheet'></i>
                <span class="links_name">Comprobantes</span>
            </a>
            <span class="tooltip">Comprobantes compras</span>
        </li>
        <li>
            <a href="Productos.php">
                <i class='bx bx-shopping-bag'></i>
                <span class="links_name">Productos</span>
            </a>
            <span class="tooltip">Productos</span>
        </li>
        <li>
            <a href="./categoria.php">
            <i class='bx bxs-category'></i>
                <span class="links_name">Categorias</span>
            </a>
            <span class="tooltip">Categorias</span>
        </li>
        <li>
            <a href="productos/promocion.php">
            <i class='bx bxs-purchase-tag-alt'></i>
                <span class="links_name">Promociones</span>
            </a>
            <span class="tooltip">Promociones</span>
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
      

        <a href="../../php/Cerrar_Seccion.php">
     <li class="profile">
         <i class='bx bx-log-out' id="log_out" ></i>
         <div class="Salir">Cerrar Sesión</div>
     </li>
    </a>
    </ul>
   </div>
  </div>
  <section class="home-section">
      <div class="text">Inicio, Bienvenido <?php echo $_SESSION['usuario']['nombre'] ?> </div>      </div>

      <div class="center">
      <div class="gallery-info">
        
    </div>

        <div class="image-gallery">
            <div class="image-container">
            <img src="../../accesos/Imagenes/Inicio(1).jpg" alt="Imagen 1">
            </div>
            <div class="image-container">
            <img src="../../accesos/Imagenes/Inicio(2).jpg" alt="Imagen 2">
            </div>
            <div class="image-container">
            <img src="../../accesos/Imagenes/Inicio(3).jpg" alt="Imagen 3">
            </div>
            <div class="image-container">
            <img src="../../accesos/Imagenes/Inicio(4).jpg" alt="Imagen 4">
            </div>
        </div>
    </div>

  </section>
  <style>
body, html {
    height: 100%;
    margin: 0;
}

.center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.image-gallery {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Dos columnas en la cuadrícula */
    gap: 20px; /* Espacio entre las imágenes */
}

.gallery-info {
    text-align: center;
    margin-bottom: 30px;
    color: #FFA500; /*Color naranja*/
}

.gallery-info h1 {
    font-size: 32px;
    margin-bottom: 10px;
}

.gallery-info p {
    font-size: 18px;
}


.image-container {
    background-color: orange;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

img {
    max-width: 100%;
    height: auto;
}

  </style>
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
