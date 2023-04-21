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
   
<body >
<div class="container-fluid" style=" background-image: URL(..\..\Ferrecomm\accesos\Imagenes\Logo.jpeg);">

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
            <a href="./productos/promocion.php">
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
        <li>
        
        <a href="../../php/Cerrar_Seccion.php">
        <li class="profile">
          <i class='bx bx-log-out' id="log_out"></i>
          <div class="Salir">Cerrar Sesión</div>
        </li>
      </a>
    </ul>
  </div>
</body>

  <section class="home-section">  
    

    <!-- Aqui inicia el formulario--> 
    
    
                    
                      
                     
<h1>  Proveedores<i class='bx bxs-group icon'></i></h1>
 
  <form action="./proveedores/buscarproveedor.php" method="get" style="background-color:#DCFFFE ;">
  <input type="text" name="busqueda" style="text-transform:uppercase; margin-left: 40px"  id="busqueda" placeholder="Buscar...">
  <button type="submit" class="boton-buscar">Buscar</button>
  <a href="./proveedores/agregar_proveedores.php" class="btn_newproducto" style="margin-left: 350px" > Agregar Proveedor<i id="icon_nuevo"  class='bx bxs-user-plus'></i></a>
  <a href="../../fpdf/reporteproveedor.php" target="_blank" class="btn_pdf"> PDF <i class='bx bxs-file-pdf' ></i></a> 


</form>
                    

    <head>
    
    <link rel="stylesheet" href="./fontawesome-free/css/all.min.css">
    <div class="container-fluid" style=" background-image: URL(..\..\accesos\Imagenes\Logo.jpeg);"></div> 
</head>
<?php 
include'conex.php';
?>
      <section id="container">


   
    <table>
      <thead>
        <tr>
        <th>id proveedor</th>
        <th>Nombre del proveedor</th>
        <th>RTN</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Dirección</th>


        <th>Acción 
          
            
        </th>
        </tr>
       </thead>
   
      <tr>
        
      <?php
       /* include 'php/conexion.php';*/
       include 'conex.php';
        //Paginador
        $sql_register =mysqli_query($conex,"SELECT COUNT(*) as total_registro FROM tbl_proveedores");
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

        $query = mysqli_query($conex,"SELECT id_proveedor, nombre_proveedor, rtn_proveedor, telefono_proveedor, 
       correo_proveedor, direccion_proveedor FROM tbl_proveedores  ORDER BY id_proveedor ASC LIMIT $desde,$por_pagina;");

     
        $result = mysqli_num_rows($query);
        if($result > 0){ //si hay registros

            while($data = mysqli_fetch_array($query)){
        ?>
         <tr>
            <td><?php echo $data["id_proveedor"] ?></td>
            <td><?php echo $data["nombre_proveedor"] ?></td>
            <td><?php echo $data["rtn_proveedor"] ?></td>
            <td><?php  echo $data["telefono_proveedor"] ?></td>
            <td><?php echo $data["correo_proveedor"] ?></td>
            <td><?php echo $data["direccion_proveedor"] ?></td>
            <td> <a type="button" class="link_edit" href="./proveedores/editarproveedores.php?id=<?php echo $data["id_proveedor"]; ?>"><i class='bx bx-edit'></i></a>
           
            <a type="button"class="link_delete" href="./proveedores/eliminarproveedor.php?id=<?php echo $data["id_proveedor"]; ?>"><i class='bx bxs-trash'></i></a>


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

  

      </section>
    
</div>
 
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



</div>
    
</div>
  
</div>

      
</section>

  </script>

   
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
<!--Funciones js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">





</script>

  </html>
