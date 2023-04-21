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
<?php

include_once "./conexionproducto.php";
include '../../../php/bitacora.php';
//Mostrar datos

if(empty($_GET['id'])){
    header('Location: promocion.php');
}
 $id_promocion = $_GET['id'];
 $sql = mysqli_query($conexion, "SELECT p.id_promocion,p.nombre_promocion, p.fecha_inicio,
 p.fecha_final, p.precio_venta, (p.id_estado_prom) as id_estado_prom, (e.estado_promocion) as estado
FROM tbl_promociones p 
INNER JOIN tbl_estado_promociones e
on p.id_estado_prom = e.id_estado_prom 
WHERE id_promocion = $id_promocion;");
 $result_sql = mysqli_num_rows($sql);

 if($result_sql == 0){
    header('Location: Productos.php');
 }else{
    $option = '';
    while ($data = mysqli_fetch_array($sql)){
        $id_promocion = $data['id_promocion'];
        $nombre_promocion = $data['nombre_promocion'];
        $fecha_inicio = $data['fecha_inicio'];
        $fecha_final =$data['fecha_final'];
        $precio_venta = $data['precio_venta'];
        $id_estado_prom = $data['id_estado_prom'];
        $estado = $data['estado'];

        if($id_estado_prom == 1){
            $option = '<option value="'.$id_estado_prom.'"select>'.$estado.'</option>';
        }else if($id_estado_prom == 2){
            $option = '<option value="'.$id_estado_prom.'"select>'.$estado.'</option>';
        }


    }
 }



 

 if(!empty($_POST)){
    $id_promocion=$_POST['id_promocion'];

    

   $query_delete = mysqli_query($conexion,"DELETE FROM tbl_promociones WHERE id_promocion = $id_promocion ");
   if($query_delete){
       
        echo
            '<script>
            alert("Promocion eliminada correctamente");
            window.location= "promocion.php";
            </script>
            ';
   $codigoObjeto=4;
    $accion='Eliminar';
    $descripcion= 'Elimino una promocion correctamente';
    bitacora($codigoObjeto, $accion,$descripcion);
        
    }else{
        echo
            '<script>
            alert("Error al eliminar la promocion correctamente");
            window.location= "promocion.php";
            </script>
            ';

         $codigoObjeto=4;
        $accion='Eliminar';
        $descripcion= 'El Usuario intento eliminar una promocion';
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
            <a href="../Menu_facturacion.php">
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
            <a href="../categoria.php">
            <i class='bx bxs-category'></i>
                <span class="links_name">Categorias</span>
            </a>
            <span class="tooltip">Categorias</span>
        </li>
        <li>
            <a href="./promocion.php">
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
    border: ;
    outline: none;
    background-color: #ffff;

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

  </style>
  <section class="home-section"></br>

      <h2>  Eliminar promoción <i class='bx bxs-trash'></i></h2>
      
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
      <input type="hidden" name="id_promocion" value="<?php echo $id_promocion;?>">
        
      <div class="formulario__grupo" id="grupo__nombre_promocion">
				<label for="nombre_promocion" class="formulario__label">Promocion</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="nombre_promocion" id="nombre_promocion" style="text-transform:uppercase;" value="<?php echo $nombre_promocion;?>" onblur="cambiarAMayusculas(this);" disabled >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La descripcion del producto debe de tener 4 a 16 letras, solo puede contener numeros Y letras.</p>
			    </div>

                <div class="formulario__grupo" id="grupo__fecha_inicio">
				<label for="fecha_inicio" class="formulario__label">Fecha de inicio</label>
				<div class="formulario__grupo-input">
					<input type="date" class="field"  name="fecha_inicio" id="fecha_inicio" value="<?php echo date('Y-m-d', strtotime($fecha_inicio)) ?>" disabled >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La fecha de inicio debe ser menor a la fecha final</p>
			    </div>

                <div class="formulario__grupo" id="grupo__fecha_final">
				<label for="fecha_final" class="formulario__label">Fecha final</label>
				<div class="formulario__grupo-input">
					<input type="date" class="field"  name="fecha_final" id="fecha_final" value="<?php echo date('Y-m-d', strtotime($fecha_final)) ?>" disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La fecha final debe ser mayor a la fecha de inicio</p>
			    </div>

                <div class="formulario__grupo" id="grupo__precio_venta">
				<label for="precio_venta" class="formulario__label">Precio de venta</label>
				<div class="formulario__grupo-input">
					<input type="number" class="field"  name="precio_venta" id="precio_venta" style="text-transform:uppercase;" value="<?php echo $precio_venta;?>" onblur="cambiarAMayusculas(this);" disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener numeros</p>
			    </div>

                <label for="id_estado_prom">Estado promocion</label></br>  
            <input type="text" class="field" name="categoria" id="categoria" value="<?=$estado?>" disabled>
            </p>
                

            </br></br>
            
            <button class="btn_agregar">Eliminar</button>
      <button type="reset" onclick="location.href='promocion.php'" class="btn_cancelar">Cancelar</button>



                    <script>
                        function cambiarAMayusculas(elemento) {
                            let texto = elemento.value;
                            elemento.value = texto.toUpperCase();
                        }
                    </script>

                    
                </form>
<script src="formularioproducto.js"></script>

      
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