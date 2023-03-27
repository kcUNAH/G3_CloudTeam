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
      <h1>  seguridad <i class='bx bx-shield-quarter'></i></h1>
 
      <style>
		.btn {
			display: inline-block;
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 20px 40px;
			font-size: 30px;
			font-weight: bold;
			text-align: center;
			text-decoration: none;
			cursor: pointer;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			transition: all 0.3s ease;
            float: left;
			margin-left: 35px;
            display: block;
			margin-top: 50px;
            
		}
		
		.btn:hover {
			background-color: #0062cc;
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
			transform: translateY(-2px);
		}
        .overlay {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color:#ffab66;
			z-index: 1;
			margin: auto;
			width: 50%;
			height: 50%;
            

            }
            .btn1 {
			display: inline-block;
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 20px 40px;
			font-size: 30px;
			font-weight: bold;
			text-align: center;
			text-decoration: none;
			cursor: pointer;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			transition: all 0.3s ease;
            float: left;
			margin-left: 35px;
            display: block;
			margin-top: 50px;
            
		}
        
        .btn1:hover {
			background-color: #0062cc;
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
			transform: translateY(-2px);
		}
        .btn2 {
			display: inline-block;
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 20px 40px;
			font-size: 30px;
			font-weight: bold;
			text-align: center;
			text-decoration: none;
			cursor: pointer;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			transition: all 0.3s ease;
            float: left;
			margin-left: 35px;
            display: block;
			margin-top: 50px;
            
		}
        .btn2:hover {
			background-color: #0062cc;
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
			transform: translateY(-2px);
		}
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
	</style>

</head>
<body>
    <div class="overlay">
	<a class="btn" href = "GestionUsuarios.php"><i class='bx bx-user'> Usuarios</i></a>
    <a class="btn" href = " "><i class='bx bxs-user-detail'>Permisos</i></a>
   
  
 
   
    <div>
    <a class="btn1" href = " "><i class='bx bxs-notepad'> Parametros</i></a>
    <a class="btn1" href = "seguridad/mostrarbitacora.php "><i class='bx bx-note'> Bitacora</i></a>
        
</div>
    <div>
    <a class="btn2" href = " ">  <i class='bx bx-user-check'>   Roles   </i></a>
    </div>
    <div>
 
    </div>
        </div>
    </body>
</form>
<html>