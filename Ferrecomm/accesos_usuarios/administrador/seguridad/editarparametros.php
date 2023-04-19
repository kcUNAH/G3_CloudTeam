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

include_once "../conex.php";
include '../../../php/bitacora.php';
//Mostrar datos

if(empty($_GET['id'])){
    header('Location: promocion.php');
}
 $id_parametro = $_GET['id'];
 $sql = mysqli_query($conex, "SELECT p.id_parametro, p.parametro , p.valor, p.fecha_creacion, p.fecha_modificacion, p.creado_por,
 p.modificado_por, u.id_usuario, u.nombre_usuario as nombre_usuario,
 (u.nombre_usuario) as nombre_usuario
FROM tbl_ms_parametros p
INNER JOIN tbl_ms_usuario u 
on p.id_usuario = u.id_usuario 
WHERE id_parametro = $id_parametro;");


 $result_sql = mysqli_num_rows($sql);

 if($result_sql == 0){
    header('Location: Productos.php');
 }else{
    $option = '';
    while ($data = mysqli_fetch_array($sql)){
       $id_parametro = $data['id_parametro'];
       $parametro= $data['parametro'];
       $valor = $data['valor'];
       $fecha_creacion = $data['fecha_creacion'];
       $fecha_modificacion = $data['fecha_modificacion'];
       $creado_por = $data['creado_por'];
       $modificado_por = $data['nombre_usuario'];
       $id_usuario = $data['id_usuario'];


    }
 }



 


if (!empty($_POST)) {

    if (empty($_POST['valor']) || empty($_POST['nombre_usuario']))  
        {
            $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';
    } else {
        $id_parametro = $_POST['id_parametro'];
        $valor = $_POST['valor'];
        $modificado_por = $_POST['nombre_usuario'];
        
        date_default_timezone_set('America/Tegucigalpa');
            $fecha_modificacion =date("Y-m-d H:i:s");
            
               
            $query_update = mysqli_query($conex, "UPDATE tbl_ms_parametros SET valor = '$valor',
            fecha_modificacion = '$fecha_modificacion', modificado_por = '$modificado_por'
            WHERE id_parametro = $id_parametro "); 
                
            if ($query_update) {
                echo
                '<script>
                alert("Parametro actualizado correctamente");
                window.location= "parametros.php";
                </script>
                ';
                $codigoObjeto=3;
              $accion='Actualizar';
              $descripcion= 'Actualizo el parametro';
              bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                echo
                '<script>
                alert("Error al actualizar el parametro");
                window.location= "editarparametros.php";
                </script>
                ';
            }
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
	background: #2ad313;
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

      <h2>  Editar promoción <i class='bx bx-edit'></i></h2>
      
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
      <input type="hidden" name="id_parametro" value="<?php echo $id_parametro;?>">
      <label for="nombre_promocion" class="formulario__label">Parametro:</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="parametro" id="parametro" style="text-transform:uppercase;" value="<?php echo $parametro;?>" onblur="cambiarAMayusculas(this);" disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La descripcion del producto debe de tener 4 a 16 letras, solo puede contener numeros Y letras.</p>
			    </div>
      <div class="formulario__grupo" id="grupo__nombre_promocion">
				<label for="nombre_promocion" class="formulario__label">Valor</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="valor" id="valor" style="text-transform:uppercase;" value="<?php echo $valor;?>" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La descripcion del producto debe de tener 4 a 16 letras, solo puede contener numeros Y letras.</p>
			    </div>

                <div class="formulario__grupo" id="grupo__fecha_inicio">
				<label for="fecha_inicio" class="formulario__label">Fecha de creacion</label>
				<div class="formulario__grupo-input">
					<input type="date" class="field"  name="fecha_creacion" id="fecha_creacion" value="<?php echo date('Y-m-d', strtotime($fecha_creacion)) ?>" disabled >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La fecha de inicio debe ser menor a la fecha final</p>
			    </div>

                <div class="formulario__grupo" id="grupo__fecha_inicio">
				<label for="fecha_inicio" class="formulario__label">Fecha de modificacion</label>
				<div class="formulario__grupo-input">
					<input type="date" class="field"  name="fecha_modificacion" id="fecha_modificacion" value="<?php echo date('Y-m-d', strtotime($fecha_modificacion)) ?>" disabled >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La fecha de inicio debe ser menor a la fecha final</p>
			    </div>

                <label for="nombre_promocion" class="formulario__label">Creado por:</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="creado_por" id="creado_por" style="text-transform:uppercase;" value="<?php echo $creado_por;?>" onblur="cambiarAMayusculas(this);" disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La descripcion del producto debe de tener 4 a 16 letras, solo puede contener numeros Y letras.</p>
			    </div>

                <input type="hidden" name="nombre_usuario" value="<?php echo $modificado_por;?>">

                <label for="nombre_promocion" class="formulario__label">Usuario:</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="id_usuario" id="id_usuario" style="text-transform:uppercase;" value="<?php echo $id_usuario;?>" onblur="cambiarAMayusculas(this);" disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La descripcion del producto debe de tener 4 a 16 letras, solo puede contener numeros Y letras.</p>
			    </div>



                
            
      <button class="btn_agregar">Actualizar</button>
      <button type="reset" onclick="location.href='parametros.php'" class="btn_cancelar">Cancelar</button>



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