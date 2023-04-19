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
    header('Location: ../../administrador/proveedores.php');
}
 $id_proveedor = $_GET['id'];
 $sql = mysqli_query($conex, "SELECT id_proveedor,nombre_proveedor,rtn_proveedor,telefono_proveedor,correo_proveedor,direccion_proveedor FROM tbl_proveedores WHERE id_proveedor = $id_proveedor;");
 $result_sql = mysqli_num_rows($sql);

 if($result_sql == 0){
    header('Location: ../../administrador/proveedores.php');
 }else{
    $option = '';
    while ($data = mysqli_fetch_array($sql)){
        $id_proveedor = $data['id_proveedor'];
        $nombre_proveedor = $data['nombre_proveedor'];
        $rtn_proveedor = $data['rtn_proveedor'];
        $telefono_proveedor = $data['telefono_proveedor'];
        $correo_proveedor = $data['correo_proveedor'];
        $direccion_proveedor = $data['direccion_proveedor'];  

    }
 }

   if(!empty($_POST)){
        $id_producto=$_POST['id_proveedor'];

        

       $query_delete = mysqli_query($conex,"DELETE FROM tbl_proveedores WHERE id_proveedor = $id_proveedor ");
       if($query_delete){
           // header("Location: GestionUsuarios.php");
            
            echo
                '<script>
                alert("Proveedor eliminado correctamente");
                window.location= "../../administrador/proveedores.php";
                </script>
                ';
         $codigoObjeto=4;
        $accion='Eliminar';
        $descripcion= 'Elimino Proveedor correctamente';
        bitacora($codigoObjeto, $accion,$descripcion);
            
        }else{
            echo
                '<script>
                alert("Error al eliminar el proveedor correctamente");
                window.location= "../../administrador/proveedores.php";
                </script>
                ';
               $codigoObjeto=4;
            $accion='Eliminar';
            $descripcion= 'El Usuario intento eliminar Un proveedor';
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
       
        
        <a href="../../php/Cerrar_Seccion.php">
        <li class="profile">
          <i class='bx bx-log-out' id="log_out"></i>
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
    border: ;
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
    border: ;
    outline: none;
    border: solid 1px #ccc;
    padding: 6px;
    width: 450px;
}
  </style>
  <section class="home-section"></br>

      <h2>  Eliminar proveedor <i class='bx bxs-trash'></i></h2>
      
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

<input type="hidden"   name=" id_proveedor" id=" $id_proveedor "  value="<?php echo  $id_proveedor;?>">

    <p>Nombre del proveedor:
    
  <input type="text" class="field"  name="nombre_proveedor" id="nombre_proveedor"  value="<?=$nombre_proveedor?>" disabled>
    </p>

        <p>RTN proveedor:
<input type="text" class="field"  name="rtn_proveedor" id="rtn_proveedor"  min ="0" maxlength="14"  value="<?=$rtn_proveedor?>" disabled>
        </p>
        <p>Telefono:
       
<input type="text" class="field"  name="telefono" id="telefono"  min="0"  maxlength="8"  value="<?=$telefono_proveedor?>" disabled>
        
        </p>
        <p>correo: 
                <input type="email" class="field"  name="email" id="email"   placeholder="correo@correo.com" value="<?=$correo_proveedor?>" disabled>
        </p> 

  <p>direccion:
        <input type="text" class="field"  name="direccion" id="direccion"  value="<?=$direccion_proveedor?>" disabled>
        </p>
            </br>
            
      <button class="btn_agregar">Eliminar</button>
      <button type="reset" onclick="location.href='../Productos.php'" class="btn_cancelar">Cancelar</button>



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