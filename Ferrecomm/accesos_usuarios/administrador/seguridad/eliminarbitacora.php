<?php
session_start();


if (!isset($_SESSION['usuario'])) {
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

<?php 
include '../conex.php';
include '../../../php/bitacora.php';

if(empty($_GET['id'])){
    header('Location: Productos.php');
}
 $id_producto = $_GET['id'];
 $sql = mysqli_query($conex, "SELECT id_bitacora,fecha, id_usuario,
 id_obejto, accion, descripcion FROM tbl_bitacora WHERE id_bitacora = $id_bitacora");
 $result_sql = mysqli_num_rows($sql);

 if($result_sql == 0){
    header('Location: Productos.php');
 }else{
    $option = '';
    while ($data = mysqli_fetch_array($sql)){
        $id_bitacora= $data['id_bitacora'];
        $fecha = $data['fecha'];
        $id_usuario = $data['id_usuario'];
        $id_objeto =$data['id_objeto'];
        $accion_producto = $data['accion'];
        $descripcion= $data['descripcion'];

    }
 }

   if(!empty($_POST)){
        $id_producto=$_POST['id_bitacora'];

        

       $query_delete = mysqli_query($conex,"DELETE FROM tbl_bitacora WHERE id_bitacora = $id_bitacora");
       if($query_delete){
           // header("Location: GestionUsuarios.php");
            
            echo
                '<script>
                alert("Bitacora eliminada correctamente");
                window.location= "../Productos.php";
                </script>
                ';
       $codigoObjeto=4;
        $accion='Eliminar';
        $descripcion= 'Elimino  correctamente';
        bitacora($codigoObjeto, $accion,$descripcion);
            
        }else{
            echo
                '<script>
                alert("Error al eliminar el bitacora correctamente");
                window.location= "../Productos.php";
                </script>
                ';

             $codigoObjeto=4;
            $accion='Eliminar';
            $descripcion= 'El Usuario intento eliminar una bitacora';
            bitacora($codigoObjeto, $accion,$descripcion);
        }
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
            <a href="../../Productos.php">
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
                <i class='bx bxs-user'></i>
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
       
        <a href="../../../index.php">
     <li class="profile">
         <i class='bx bx-log-out' id="log_out" ></i>
         <div class="Salir">Cerrar Sesión</div>
     </li>
    </a>
    </ul>
  </div>
  <style>
   form{
    background-color: #db881a;
    border-radius: 3px;
    padding: 20px;
    margin : 0 auto;
    width : 500px;
    font-size: 15px;
   }
   input, textarea{
    
    outline: none;

   }
   
   input[type="text"]:disabled {
  background: #ffff;
   }

   .field{
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
   }
   .field:focus{
    border-color: #18A383;
   }
   .btn_agregar{
    height: 45px;
	line-height: 45px;
	background: #c92f09;;
	color: #000000;
	font-weight: bold;
	border: none;
	border-radius: 3px;
	cursor: pointer;
	transition: .1s ease all;
    width: 227px;
   }
   .btn_cancelar{
    height: 45px;
	line-height: 45px;
	background: #d1d40a;
	color: #000000;
	font-weight: bold;
	border: none;
	border-radius: 3px;
	cursor: pointer;
	transition: .1s ease all;
    width: 227px;
   }

   .alert{
    width: 100%;
    background: #d82606;
    border-radius: 6px;
    margin: 20px auto;
}

.msg_error{
    color: black;
}

.msg_save{
    color: greenyellow;
}

.alert p{
    padding: 10px;
}

span{
    background: #ffff;

    outline: none;
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
}
  </style>
  <section class="home-section"></br>

      <h2>  Eliminar producto <i class='bx bxs-trash'></i></h2>
      
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
      <input type="hidden" name="id_bitacora" value="<?php echo $id_bitacora;?>">
            <label for="id_categoria">fecha:</label></br>    
            <input type="text" class="field" name="fecha" id="fecha" value="<?=$fecha?>" disabled>
            </p>
            <p>id usuario:
            <input type="text" class="field" name="id_usuario" id="id_usuario" value="<?=$id_usuario?>" disabled>
            </p>
            <p>id_objeto:
             <input type="text" class="field" name="id_objeto" id="id_objeto" value="<?php echo $id_objeto;?>" disabled>
            </p>
             <p>accion:
            <input type="text" class="field" name="accion" id="accion" value="<?php echo $accion;?>" disabled>
            </p>
            
            <p>descripcion:
            <input type="text" class="field" name="descripcion" id="descripcion" value="<?php echo $descripcion;?>" disabled >
            </p>
            
            </br>
            
      <button class="btn_agregar">Eliminar</button>
      <button type="reset" onclick="location.href='../mostrarbitacora.php'" class="btn_cancelar">Cancelar</button>



                    <script>
                        function cambiarAMayusculas(elemento) {
                            let texto = elemento.value;
                            elemento.value = texto.toUpperCase();
                        }
                    </script>

                    
                </form>

      
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