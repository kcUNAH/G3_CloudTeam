<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    // Si el usuario ha iniciado sesión, mostrar el campo de entrada con su ID de usuario
    $usuarioinicio = $_SESSION['id_usuario'];
    echo ' <input type="hidden"value="'.  $usuarioinicio.'" readonly>';
} else {
    // Si el usuario no ha iniciado sesión, mostrar un mensaje de error o redirigir a la página de inicio de sesión
    echo '
    <script>
    alert("Por favor, debe iniciar seccion");
    window.location= "../index.php";
    </script>
    ';
    //header("localitation: index.php");
    session_destroy();
    die();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../../accesos/CSS/tablaproducto.css">
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
            <a href="../Menu.php">
                <i class='bx bxs-home' ></i>
                <span class="links_name">Inicio</span>
            </a>
            <span class="tooltip">Inicio</span>
        </li>
        <li>
            <a href="../Facturacion.php">
                <i class='bx bx-money'></i>
                <span class="links_name">Facturación</span>
            </a>
            <span class="tooltip">Facturación</span>
        </li>
        <li>
            <a href="../../../compras.php">
                <i class='bx bxs-cart'></i>
                <span class="links_name">Compras</span>
            </a>
            <span class="tooltip">Compras</span>
        </li>
        <li>
            <a href="../Productos.php">
                <i class='bx bx-shopping-bag'></i>
                <span class="links_name">Productos</span>
            </a>
            <span class="tooltip">Productos</span>
        </li>
        <li>
            <a href="../categoria.php">
            <i class='bx bxs-category'></i>
                <span class="links_name">Categorias</span>
            </a>
            <span class="tooltip">Categorias</span>
        </li>
        <li>
            <a href="../productos/promocion.php">
            <i class='bx bxs-purchase-tag-alt'></i>
                <span class="links_name">Promociones</span>
            </a>
            <span class="tooltip">Promociones</span>
        </li>
        <li>
            <a href="../seguridad.php">
                <i class='bx bx-shield-quarter'></i>
                <span class="links_name">Seguridad</span>
            </a>
            <span class="tooltip">Seguridad</span>
        </li>
        <li>
            
            <a href="../Proveedores.php">
            <i class='bx bx-id-card'></i>
                <span class="links_name">Proveedores</span>
            </a>
            <span class="tooltip">Proveedores</span>
        </li>
        <li>
            <a href="../../../inventario.php">
                <i class='bx bx-package'></i>
                <span class="links_name">Inventario</span>
            </a>
            <span class="tooltip">Inventario</span>
        </li>
       
        
        <a href="../../../index.php">
     <li class="profile">
         <i class='bx bx-log-out' id="log_out" ></i>
         <div class="Salir">Cerrar Sesión</div>
         </li>
      </a>
    </ul>
  </div>
  <section class="home-section">
  <h1> permisos <i class='bx bxs-notepad'></i></h1>


  <section class="home-section">  
    

    <!-- Aqui inicia el formulario-->
  </div>

 <section id="container"  >
      <form action="buscar_parametro.php" method="get" style="background-color:#DCFFFE ;">
  <input type="text" name="busqueda" style="text-transform:uppercase; margin-left: 40px"  id="busqueda" placeholder="Buscar...">
  <button type="submit" class="boton-buscar">Buscar</button>
  
  
  <a href="../../../fpdf/reportepermisos.php" target="_blank" class="btn_pdf"> PDF <i class='bx bxs-file-pdf' ></i></a> 


</form>
                    

    <head>
    
    <link rel="stylesheet" href="./fontawesome-free/css/all.min.css">
    <div class="container-fluid" style=" background-image: URL(..\..\accesos\Imagenes\Logo.jpeg);"></div> 
</head>
<?php include '../conex.php'; ?>
        <section id="container">


   
    <table>
      <thead> 
        <tr>
       <th style="display: none;">id_permiso</th>
        <th>Rol</th>
        <th>permiso Asiganado</th>
        <th>permiso insertar</th>
        <th>permiso eliminar</th>
        <th>permiso Actualizar</th>
        <th>permiso consultar</th>
        <th>creado_por</th>
        <th>fecha_creacion</th>
        <th>modificado_por</th>
        <th>fecha_modificacion</th>

        <th>Acción 
          
            
        </th>
        </tr>
       </thead>
   
      <tr>
        
      <?php
       /* include 'php/conexion.php';*/
       include '../conex.php'; 
      
        //Paginador
        $sql_register =mysqli_query($conex,"SELECT COUNT(*) as total_registro FROM tbl_ms_permisos");
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
     
    
       $query = mysqli_query($conex,"SELECT p.id_permisos, r.rol , o.objeto , p.permiso_insercion, p.permiso_eliminacion, p.permiso_actualizacion, p.permiso_consultar, p.creado_por,
       p.fecha_creacion, p.modificado_por, p.fecha_modificacion 
       FROM tbl_ms_permisos p INNER JOIN tbl_ms_rol r on p.id_rol = r.id_rol INNER JOIN tbl_ms_objetos o on p.id_objeto = o.id_objeto ORDER BY p.id_permisos ASC LIMIT $desde,$por_pagina;");

    
       $result = mysqli_num_rows($query);
       if($result > 0){ //si hay registros

           while($data = mysqli_fetch_array($query)){
       ?>
       
        <tr>
        <td style="display: none;"><?php echo $data["id_permisos"] ?></td>
           <td><?php echo $data["rol"] ?></td>
           <td><?php echo $data["objeto"] ?></td>
            <td><?php  echo $data["permiso_insercion"] ?></td>
            <td><?php echo $data["permiso_eliminacion"] ?></td>
            <td><?php echo $data["permiso_actualizacion"] ?></td>
            <td><?php echo $data["permiso_consultar"] ?></td>
            <td><?php echo $data["creado_por"] ?></td>
            <td><?php echo $data["fecha_creacion"] ?></td>
            <td><?php echo $data["modificado_por"] ?></td>
            <td><?php echo $data["fecha_modificacion"] ?></td>
            <td> <a type="button" class="link_edit" href="editarpermisos.php?id=<?php echo $data["id_permisos"]; ?>"><i class='bx bx-edit'></i></a>
 
            <a type="button"class="link_delete" href="eliminar_permisos.php?id=<?php echo $data["id_permisos"]; ?>"><i class='bx bxs-trash'></i></a>
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
table{
    border-collapse: collapse;
    font-size: 10pt;
    font-family: Arial;
    margin-left: 40px;
    margin-right: 5px;
    background-color: #fff;
    
}

thead{
  background-color: rgba(255, 102, 0, 0.911);
  border-bottom: solid 5px;
  color: rgb(0, 0, 0);
}


table td:first-child {
    width: 0px;
  }
  table td:nth-child(2){
    width: 80px;
  }
  table td:nth-child(3){
    width: 100px;
  }
  table td:nth-child(4){
    width: 100px;
  }
  table td:nth-child(5){
    width: 100px;
  }
  table td:nth-child(6){
    width: 100px;
  }
  table td:nth-child(7){
    width: 100px;
  }
  table td:nth-child(8){
    width: 100px;
  }
  table td:nth-child(9){
    width: 100px;
  }
  table td:nth-child(10){
    width: 100px;
  }
  table td:nth-child(11){
    width: 150px;
  }
  


/*Tamaño de los th de la tabla*/
table th:first-child {
  width: 0px;
}
table th:nth-child(2){
  width: 100px;
}
table th:nth-child(3){
  width: 100px;
}
table th:nth-child(4){
  width: 100px;
}
table th:nth-child(5){
  width: 100px;
}
table th:nth-child(6){
  width: 100px;
}
table th:nth-child(7){
  width: 100px;
}
table th:nth-child(8){
  width: 100px;
}
table th:nth-child(9){
  width: 100px;
}
table th:nth-child(10){
  width: 100px;
}
table th:nth-child(11){
  width: 150px;
}


  table td:last-child {
    width: 10px;
  }

.table .th{
    text-align: left;
    padding: 10px;
    background: #ffffff;
    color: #181212;
    
}


table tr:nth-child(){
    background: #fff;
}
table td {
    padding: 10px;
}


/*-----------Paginador------------*/
.paginador ul{
  padding: 15px;
  list-style: none;
  background: #DCFFFE;
  margin-top: 15px;
  display: -webkit-flex;
  display: -moz-flex;
  display: -ms-flex;
  display: -o-flex;
  display: flex;
  
}

.paginador a, .pageSelected{
  color: #428bca;
  border: 1px solid #ddd;
  padding: 5px;
  display: inline-block;
  font-size: 14px;
  text-align: center;
  width: 35px;
  text-decoration: none;
}


.paginador a:hover{
  background: #ddd;
}

.pageSelected{
  color: #fff;
  background: #428bca;
  border: 1px solid #428bca;
}
.btn_pdf{
    display: inline-block;
    background-color: rgba(255, 102, 0, 0.911);
    color:rgb(255, 255, 255);
    padding: 5px 25px;
    border-radius: 10px;
    margin: 20px;
    text-decoration: none;

} 
.h1{
    color:rgba(255, 102, 0, 0.911);
    margin-left: 20px;
    text-align: center;
    font-size: 30pt;
    
} 
.link_edit{
    color: green;
    font-size: 25px;
}

.link_delete{
    color: red;
    font-size: 25px;
}
</style>



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
