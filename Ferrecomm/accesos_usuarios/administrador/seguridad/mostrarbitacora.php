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
            <a href="../compras.php">
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
  <h1> Bitácora <i class='bx bx-note'></i></h1>


    <?php include '../conex.php'; ?>
  
    <section id="container">
    <div style="display: flex; align-items: center; margin-bottom: 20px;">
        <form method="post" action="eliminar_por_fecha.php" class="no-form-bg">
            <label class="label-style">Fecha de inicio:</label>
            <input type="date" id="start_date" name="start_date" required>
            
            <label class="label-style">Fecha de fin:</label>
            <input type="date" id="end_date" name="end_date" required>
            
            <button type="submit" class="boton-eliminar" name="delete_by_date">DEPURAR</button>
        </form>

        <div style="margin-right: 10px;">
            <form action="buscarbitacora.php" method="get" class="no-form-bg">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." class="input-busqueda">
                <button type="submit" class="boton-buscar">Buscar</button>
            </form>
        </div>
        
        <a href="../../../fpdf/reportebitacora.php" target="_blank" class="btn_pdf">PDF <i class='bx bxs-file-pdf'></i></a>
    </div>
</section>

        </form>




       
        <section id="container">

      <table>
      <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Id usuario</th>
            <th>Id objeto</th>
            <th>Acción</th>
            <th>Descripción</th>
          

            
        </tr>
       </thead>
        <?php
       /* include 'php/conexion.php';*/
       include '../conex.php';
        //Paginador
        if (isset($_POST['action']) && $_POST['action'] === 'depurar') {
          include '../conex.php';
          
          // Obtener los primeros 50 registros de la bitácora
          $query = "SELECT id_bitacora FROM tbl_bitacora ORDER BY fecha DESC, id_bitacora DESC LIMIT 50";
          $result = mysqli_query($conex, $query);
          
          while ($row = mysqli_fetch_assoc($result)) {
              $id_bitacora = $row['id_bitacora'];
              
              // Eliminar el registro correspondiente de la bitácora
              $delete_query = "DELETE FROM tbl_bitacora WHERE id_bitacora = $id_bitacora";
              mysqli_query($conex, $delete_query);
          }
          
          header('Location: index.php');  // Redireccionar de vuelta a la página principal
          exit();
      }
  
      
       $sql_register =mysqli_query($conex,"SELECT COUNT(*) as total_registro FROM tbl_bitacora");
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
       $query = mysqli_query($conex,"SELECT p.id_bitacora, p.fecha, c.id_usuario, a.id_objeto, p.accion, p.descripcion 
       FROM tbl_bitacora p 
       INNER JOIN tbl_ms_usuario c ON p.id_usuario = c.id_usuario 
       INNER JOIN tbl_ms_objetos a ON p.id_objeto = a.id_objeto 
       ORDER BY p.fecha DESC, p.id_bitacora DESC
       LIMIT $desde, $por_pagina");
       
         $result = mysqli_num_rows($query);
        if($result > 0){ //si hay registros

            while($data = mysqli_fetch_array($query)){
        ?>
        
        <tr>
            <td><?php echo $data["id_bitacora"] ?></td>
            <td><?php echo $data["fecha"] ?></td>
            <td><?php echo $data["id_usuario"] ?></td>
            <td><?php echo $data["id_objeto"] ?></td>
            <td><?php echo $data["accion"] ?></td>
            <td> <?php echo $data["descripcion"] ?></td>
           
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
table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    background-color: #fff;
  }

thead{
  background-color: rgba(255, 102, 0, 0.911);
  border-bottom: solid 5px;
  color: rgb(0, 0, 0);
}


table td:first-child {
    width: 70px;
  }
  table td:nth-child(2){
    width: 180px;
  }
  table td:nth-child(3){
    width: 30px;
  }
  table td:nth-child(4){
    width: 30px;
  }
  table td:nth-child(5){
    width: 150px;
  }
  table td:nth-child(6){
    width: 200px;
  }
  
  .link_delete{
    color: red;
    font-size: 25px;
}


/*Tamaño de los th de la tabla*/
table th:first-child {
  width: 70px;
}
table th:nth-child(2){
  width: 180px;
}
table th:nth-child(3){
  width: 30px;
}
table th:nth-child(4){
  width: 30px;
}
table th:nth-child(5){
  width: 150px;
}
table th:nth-child(6){
  width: 200px;
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
/* Restablecer el estilo predeterminado del formulario */
form:focus {
        outline: none;
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
.btn_de{
    display: inline-block;
    background-color: red;
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
/* adaptar la tabla a la pantalla*/ 
@media (max-width: 600px) {
    table {
      display: block;
      overflow-x: auto;
    }
  }

th, td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
  }

 
  /* Estilos para el botón de eliminar */
  .boton-eliminar[type="submit"] {
        background-color: red;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 30px;
        margin-left: 10px;
    }

    .boton-eliminar:hover {
        background-color: blue;
    }

    /* Estilos para el botón de buscar */
    .boton-buscar {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
       
    }

    .boton-buscar:hover {
        background-color: blue;
    }

    /* Estilos para el botón PDF */
    .btn_pdf {
        background-color: orangered;
        color: white;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 4px;
    }

    .btn_pdf:hover {
        background-color: blue;
    }
    
    /* Estilos para el textbox de búsqueda */
    .input-busqueda {
        border: 1px solid #ccc;
        padding: 6px 10px;
        border-radius: 4px;
        transition: border-color 0.3s;
        outline: none;
    }

    .input-busqueda:hover,
    .input-busqueda:focus {
        border-color: #28a745;
    }

    /* Estilos para quitar el fondo del formulario */
    .no-form-bg {
        background: none;
    }
     /* Estilos para los label */
     .label-style {
        font-weight: bold;
        margin-right: 5px;
    }
</style>




</body>

</style>
</body>
</html>

