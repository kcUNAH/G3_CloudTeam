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
      <div class="text">Bienvedio a la Gestión de Usuarios</div>
    
      
      <?php include'conex.php';?>
      <section id="container">
      <head>
    
   
   <link rel="stylesheet" href="./fontawesome-free/css/all.min.css">
   <div class="container-fluid" style=" background-image: URL(Ferrecomm\accesos\Imagenes\Logo.jpeg);"></div> 
</head>
<section id="container"  >
      <form action=" buscar_producto.php" method="get" style="background-color:#DCFFFE ;">
  <input type="text" name="buscar" style="margin-left: 40px" id="buscar" placeholder="Buscar...">
  <button type="submit" class="boton-buscar">Buscar</button>
  <a href="registro.php" class="btn_newproducto" > Crear usuario<i id="icon_nuevo" class='bx bxs-cart-add'></i></a>
  <a href="usuario_activo.php" class="btn_activo" > Usuarios Activos<i id="icon_nuevo" class='bx bxs-cart-add'></i></a>
  <a href="usuario_inactivo.php" class="btn_inactivo" >Usuarios Inactivos<i id="icon_nuevo" class='bx bxs-cart-add'></i></a>
  <a href="#" class="btn_pdf"> PDF <i class='bx bxs-file-pdf' ></i></a> 


</form>


     

      <?php include'conex.php';?>
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
       
        $query = mysqli_query($conex,"SELECT u.id_usuario, u.usuario, u.nombre_usuario, u.estado_usuario,  r.rol, 
        u.fecha_ultima_conexion,  u.fecha_vencimiento, u.correo_electronico, u.creado_por, 
        u.fecha_creacion, u.fecha_modificacion FROM tbl_ms_usuario u INNER JOIN tbl_ms_rol r on u.id_rol = r.id_rol");


        
        $result = mysqli_num_rows($query);
        if($result > 0){ //si hay registros

            while($data = mysqli_fetch_array($query)){
        ?>
        
        <tr>
            <td><?php echo $data["id_usuario"] ?></td>
            <td><?php echo $data["usuario"] ?></td>
            <td><?php echo $data["nombre_usuario"] ?></td>
            <td><?php echo $data["rol"] ?></td>
            <td><?php echo $data["fecha_ultima_conexion"] ?></td>
            
            <td> <?php echo $data["fecha_vencimiento"] ?></td>
            <td><?php echo $data["correo_electronico"] ?></td>
            <td><?php echo $data["creado_por"] ?></td>
            <td> <?php echo $data["fecha_creacion"] ?></td>
            <td> <?php echo $data["fecha_modificacion"] ?></td>
            <td>
              <!--  <a class="link_factura" href="#"><i class='bx bx-check-double'></i></i></a>-->
                <a class="link_edit" href="editar.php?id=<?php echo $data["id_usuario"]; ?>"><i class='bx bx-edit'></i></a>
                <a class="link_delete" href="elim_usuario.php?id=<?php echo $data["id_usuario"]; ?>"><i class='bx bxs-trash'></i></a>
            </td>
         
        
    <!--  <a class="link_edit" href="editar.php?id=<?php// echo $data["id_usuario"]; ?>">Editar</a> --> 
               <!--   <a class="link_delete" href="elim_usuario.php?id=<?php// echo $data["id_usuario"]; ?>">Eliminar</a>--> 
           
        </tr>
        <?php
            }
        }

        ?>

      </table>

      <div class="navigation">
 <a type="button"   class="btn_anterior" href="#"  name="anterior">anterior<i class='bx bx-chevrons-left'></i></a>  

  <a type="button"  class="btn_anterior" href="#"  name="anterior"><i class='bx bx-chevrons-right'>Siguiente</i></a>  
</div>
      
  </section>


  <script>
 /let sidebar = document.querySelector(".sidebar");
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
</body>
</html>