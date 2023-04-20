<?php
session_start();


if(!isset ($_SESSION['usuario'])){
    echo '
    <script>
    alert("Por favor, debe iniciar seccion");
    window.location= "../../../index.php";
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
            <a href="../Compras.php">
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
            <a href="../Seguridad.php">
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
            <a href="../Inventario.php">
                <i class='bx bx-package'></i>
                <span class="links_name">Inventario</span>
            </a>
            <span class="tooltip">Inventario</span>
        </li>
        <li>
            <a href="../GestionUsuarios.php">
            <i class='bx bxs-user'></i>
                <span class="links_name">Usuarios</span>
            </a>
            <span class="tooltip">Usuarios</span>
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
</br>
      <h1> Parametro</h1>
      <?php include '../conex.php';?>

      <section id="container"  >

      <?php
       
       $busqueda = strtolower($_REQUEST['busqueda']);
       if(empty($busqueda))
       {
        header("location: ./parametros.php");
       }
      
      ?>



<form action="buscar_parametro.php" method="get" style="background-color:#DCFFFE ;">
<input type="text" name="busqueda" style="text-transform:uppercase; margin-left: 40px" id="busqueda" placeholder="Buscar..." value="<?php echo $busqueda; ?>">
  <button type="submit" class="boton-buscar">Buscar</button>
  <a href="agg_parametro.php" class="btn_newproducto" style="margin-left: 350px" > Agregar Parametro<i id="icon_nuevo"  class='bx bxs-notepad'></i></a>
  <a href="../../../fpdf/reportebuscarparametros.php?buscar=<?php echo $busqueda ?>" target="_blank" class="btn_pdf"> PDF <i class='bx bxs-file-pdf' ></i></a> 


 
  &nbsp;&nbsp;&nbsp; 
</form>


&nbsp;&nbsp;&nbsp; 

&nbsp;&nbsp;&nbsp; 
       <table>
       <table>
      <thead> 
        <tr>
       <th style="display: none;">id_parametro</th>
        <th>Parametro</th>
        <th>Valor</th>
        <th>Fecha creación</th>
        <th>Fecha modificacion</th>
        <th>creado por</th>
        <th>Modificado por</th>
        <th>id usuario</th>

        <th>Acción 
          
            
        </th>
        </tr>
       </thead>
   
      <tr>
   
       &nbsp;&nbsp;&nbsp; 
        
        <?php
       /* include 'php/conexion.php';*/
       include '../conex.php';


       //Paginador

      
       $sql =mysqli_query($conex,"SELECT COUNT(*) as total_registro FROM tbl_ms_parametros WHERE 
                                                                (id_parametro LIKE '%$busqueda%' OR
                                                                 parametro LIKE '%$busqueda%' OR
                                                                valor LIKE '%$busqueda%' OR
                                                                 fecha_creacion LIKE '%$busqueda%' OR
                                                                fecha_modificacion LIKE '%$busqueda%' OR
                                                                creado_por LIKE '%$busqueda%' OR
                                                                modificado_por LIKE '%$busqueda%' OR
                                                               id_usuario LIKE '%$busqueda%') ");           
       $result_register = mysqli_fetch_array($sql);
       $total_registro = $result_register['total_registro'];

       $por_pagina = 10;

       if(empty($_GET['pagina'])){
          $pagina = 1;
       }else{
          $pagina = $_GET['pagina'];
       }

       $desde = ($pagina-1) * $por_pagina;
       $total_paginas = ceil($total_registro / $por_pagina);

        $query = mysqli_query($conex,"SELECT id_parametro,parametro,valor,fecha_creacion,fecha_modificacion,creado_por,modificado_por, id_usuario
        FROM tbl_ms_parametros  WHERE (id_parametro LIKE '%$busqueda%' OR
                                                                 parametro LIKE '%$busqueda%' OR
                                                                valor LIKE '%$busqueda%' OR
                                                                 fecha_creacion LIKE '%$busqueda%' OR
                                                                fecha_modificacion LIKE '%$busqueda%' OR
                                                                creado_por LIKE '%$busqueda%' OR
                                                                modificado_por LIKE '%$busqueda%' OR
                                                               id_usuario LIKE '%$busqueda%') ORDER BY id_parametro ASC LIMIT $desde,$por_pagina;");
                                        
                                                               
        $result = mysqli_num_rows($query);
        if($result > 0){ 

            while($data = mysqli_fetch_array($query)){
               

                
        ?>
        
        <tr>
         <td style="display: none;"><?php echo $data["id_parametro"] ?></td>
            <td><?php echo $data["parametro"] ?></td>
            <td><?php echo $data["valor"] ?></td>
            <td><?php  echo $data["fecha_creacion"] ?></td>
            <td><?php echo $data["fecha_modificacion"] ?></td>
            <td><?php echo $data["creado_por"] ?></td>
            <td><?php echo $data["modificado_por"] ?></td>
            <td><?php echo $data["id_usuario"] ?></td>
            <td> <a type="button" class="link_edit" href="editarparametros.php?id=<?php echo $data["id_parametro"]; ?>"><i class='bx bx-edit'></i></a>
           
           
           

             </td>
        </tr>
        <?php
            }
        }

        ?>

      </table>
      &nbsp;&nbsp;&nbsp; 
   <?php
   
   if($total_registro !=0){
   
   ?>
 <div class="paginador">
     <ul>
      <?php
        if($pagina !=1)
        {
      ?>
      <li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
      <li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
      <?php 
        }
       for($i=1; $i <= $total_paginas; $i++){
          if($i == $pagina){
            echo '<li class="pageSelected">'.$i.'</li>';
          }else{
            echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
          }
       }
       if($pagina != $total_paginas)
       {
       ?>
      <li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
      <li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?>">>|</a></li>
       <?php } ?>
     </ul>
</div>
<?php 
} 
?>

</style>


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
.h2 {
    font-size: 30px;
    text-align: center;
    margin-bottom: 20px;
    color: rgba(255, 102, 0, 0.911);
    
    margin:auto;
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
</style>
<!--Codigo java ventana flotante-->

</html>

