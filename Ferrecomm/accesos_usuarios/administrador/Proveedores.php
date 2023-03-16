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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../accesos/CSS/tablas.css">
   
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
</body>

  <section class="home-section">  
    

    <!-- Aqui inicia el formulario-->
    <i class='bx bxs-group icon'></i> 
    <div class="text">Proveedores</div><hr> </hr>
    <div class="d-grid gap-2">
                    
                      
                     </div>

                     <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="buscar" aria-label="Buscar">
      <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
    <a type="button" class="btn btn-primary" href="javascript:abrir()" style="background-color:orange; border-color:black; color:black" name="agrega"> <i class='bx bx-user-plus'  ></i> Agregar Nuevo</a>  
    <a type="button" class="btn btn-primary" href="registro.php"   style="background-color:orange; border-color:black; color:black" > <i class='bx bxs-file-pdf' ></i> PDF</a>
                    
  </div>
</nav>
                    

    <head>
    
     <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="./fontawesome-free/css/all.min.css">
    <div class="container-fluid" style=" background-image: URL(..\..\accesos\Imagenes\Logo.jpeg);"></div> 
</head>
<?php include'conex.php';?>
      <section id="container">
  
  
    <hr> </hr>

    <table class="table table-success table-string">
        

         <tr>
        <th>id proveedor</th>
        <th>Nombre del proveedor</th>
        <th>RTN</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Dirección</th>


        <th>Acción 
            <hr> </hr>
            
        </th>
      </tr>
      <tr>
        
      <?php
       /* include 'php/conexion.php';*/
       include 'conex.php';
       
        $query = mysqli_query($conex,"SELECT id_proveedor,nombre_proveedor, rtn_proveedor, telefono_proveedor,correo_proveedor,direccion_proveedor FROM tbl_proveedores");
        $result = mysqli_num_rows($query);
        if($result > 0){ //si hay registros

            while($data = mysqli_fetch_array($query)){
        ?>
         <tr>
            <td><?php echo $data["id_proveedor"] ?></td>
            <td><?php echo $data["nombre_proveedor"] ?></td>
            <td><?php echo $data["rtn_proveedor"] ?></td>
            <td><?php echo $data["telefono_proveedor"] ?></td>
            <td><?php echo $data["correo_proveedor"] ?></td>
            <td><?php echo $data["direccion_proveedor"] ?></td>
            <td> <a type="button" class="btn btn-primary" href="editar.php?id=<?php echo $data["id_proveedor"]; ?>">Editar</a>
             <a type="button" class="btn btn-danger" href="elim_usuario.php?id=<?php echo $data["id_proveedor"]; ?>">Eliminar</a>


             </td>
        </tr>
        <?php
            }
        }

        ?>

      </table>

      <hr> </hr>
    <nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <span class="page-link">Anterior</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active" aria-current="page">
      <span class="page-link">2</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Siguiente</a>
    </li>
  </ul>
</nav>
<!--Ventana flotante-->
      <div class ="ventana" id="vent"> 
  <section class="registro_proveedor">
  <h4 style="font-style: italic; font-size: 20px;"><i class="far fa-building"></i>Añadir proveedor </h4>
  <hr style="color: #999; background-color:  #fbfcfc ; height: 2px; border: none;">

    <input class="control" type="Text" name="nombre" id="nombre" placeholder="Ingrese su nombre:">
    <input class="control" type="Text" name="RTN"    id="RTN"     placeholder="RTN Proveedor:">
    <input class="control" type="Text" name="telefono" id="telefono" placeholder="Ingrese su telefono">
    <input class="control" type="email" name="correo" id="correo" placeholder="Ingrese su correo:">
    <input class="control" type="Text" name="direccion" id="direccion" placeholder="Ingrese su Direccion:">
    <a type="button" class="btn btn-primary" href="registro_proveedores">Agregar</a>
    <a type="reset" onclick="location.href='Proveedores.php'" class="btn btn-danger">Cancelar</a>

      </section>
    
</div>
<style type="text/css">
.ventana{
background:rgba(red, rgb(128, 62, 0), blue, alpha);
width: 30%;
color:rgba(255, 255, 255,1);
font-family:Arial,Helvetica,sans-serif;
font-size: 18px;
text-align: center;
padding: 33px;
min-height: 250px;
border-radius: 22px;
position: absolute;
left: 34%;
top:0%;
display: none;

}


.registro_proveedor {
  width: 400px;
  background: #24303c;
  padding: 30px;
  margin: auto;
  margin-top: 100px;
  border-radius: 4px;
  font-family: 'calibri';
  color: white;
  box-shadow: 7px 13px 37px #000;
}

.registro_proveedor h4 {
  font-size: 22px;
  margin-bottom: 20px;
}

.control {
  width: 100%;
  background: #24303c;
  padding: 10px;
  border-radius: 4px;
  margin-bottom: 16px;
  border: 1px solid #1f53c5;
  font-family: 'calibri';
  font-size: 18px;
  color: white;
}

.registro_proveedor p {
  height: 40px;
  text-align: center;
  font-size: 18px;
  line-height: 40px;
}

.registro_proveedor a {
  color: white;
  text-decoration: none;
}

.registro_proveedor a:hover {
  color: white;
  text-decoration: underline;
}



</style>       

</div>
    
</div>
  
</div>

      
</section>
<!--Codigo java ventana flotante-->
<script>
  function abrir(){
document.getElementById("vent").style.display="block";

  }
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
