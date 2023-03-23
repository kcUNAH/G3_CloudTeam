<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf8mb4_spanish_ci">
    <meta name="description" content=" ">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <meta name="theme-color" content="#1b219d">
    <!-- Main CSS-->
   
    <!-- Font-icon css-->

  
    <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" type="text/css" href="../../js/css/main.css">
    <link rel="stylesheet" type="text/css" href="../../js/css/style.css">
    <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../accesos/CSS/tablas.css">
    <link rel="stylesheet" href="../../accesos/CSS/tablaproducto.css">
    <link rel="stylesheet" type="text/css" href="../../js/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    
  </head>
  <body class="app sidebar-mini">
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
    </header>
  
<!-- /////////////////////////////////#DCFFFE/////////////////////////////////////////////////////////////////////-->
    <div id="divModal"></div>
    <h1>  Compras <i class="bx bx-shopping-bag"></i></h1>
    <main class="app-content" style="background-color: #DCFFFE;">
    <a href="nueva_compra.php" class="btn_newproducto" >Nueva Compra<i id="icon_nuevo" class='bx bxs-cart-add'></i></a>
    <a href="registro.php" class="btn_pdf" >Generar PDF<i id="" class=''></i></a>
      <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablePedidos" >
                    
                   
                      <thead>
                        <tr>
                          <th>Id Compra</th>
                          <th>Proveedor</th>
                          <th>Fecha</th>
                          <th>Total</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>
 <!-- Essential javascripts for application to work-->
 

 <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <script src="../../js/main.js"></script>
    
    <!-- The javascript plugin to display page loading on top-->
    <script src="../../js/plugins/pace.min.js"></script>
    <!-- para data tables-->
 
    <script type="text/javascript" src="../../js/plugins/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="../../js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

    <script src="../../js/functions_compras.js"></script>

  </body>
</html>