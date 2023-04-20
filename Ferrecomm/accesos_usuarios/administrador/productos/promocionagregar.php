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



if (!empty($_POST)) {

    if (empty($_POST['nombre_promocion']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_final'])
    || empty($_POST['precio_venta'])|| empty($_POST['id_estado_prom']))  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location.href= "promocionagregar.php";
            </script>
            ';
    } else {

        $nombre_promocion =$_POST['nombre_promocion'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_final = $_POST['fecha_final'];
        $precio_venta = $_POST['precio_venta'];
        $id_estado_prom = $_POST['id_estado_prom'];

            $query_insert = mysqli_query($conex, "INSERT INTO tbl_promociones(nombre_promocion,fecha_inicio,
                                                   fecha_final,precio_venta,id_estado_prom)
            VALUES('$nombre_promocion','$fecha_inicio','$fecha_final','$precio_venta','$id_estado_prom')");

            if ($query_insert) {
                echo
                '<script>
                alert("Promocion agregada correctamente");
                window.location= "promocion.php";
                </script>
                ';
                $codigoObjeto=7;
                $accion='Registro';
                $descripcion= 'Se agrego una promocion nueva con Exito';
                bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                echo
                '<script>
                alert("Error al añadir la promocion");
                window.location= "promocionagregar.php";
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
  <div>
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

   .formulario_input{
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

   .warnings{
      width: 200px;
      text-align: center;
      margin: auto;
      color: #B06AB3;
      padding-top: 20px;
   }


   @media screen and (max-width: 800px) {
	.formulario {
		grid-template-columns: 1fr;
	}

	.formulario__grupo-terminos, 
	.formulario__mensaje,
	.formulario__grupo-btn-enviar {
		grid-column: 1;
	}

	.formulario__btn {
		width: 100%;
	}
}
  </style>
  <section class="home-section"></br>
      <h2>  Añadir nueva promoción <i class='bx bxs-purchase-tag-alt'></i></h2>
            <form action="" method="POST" enctype="multipart/form-data" id="formulario">


                <div class="formulario__grupo" id="grupo__nombre_promocion">
				<label for="nombre_promocion" class="formulario__label">Promocion</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="nombre_promocion" id="nombre_promocion" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La promocion debe de tener 3 a 16 letras, solo puede contener numeros Y letras.</p>
			    </div>

                <div class="formulario__grupo" id="grupo__fecha_inicio">
				<label for="fecha_inicio" class="formulario__label">Fecha de inicio</label>
				<div class="formulario__grupo-input">
					<input type="date" class="field"  name="fecha_inicio" id="fecha_inicio" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La fecha de inicio debe ser menor a la fecha final</p>
			    </div>

                <div class="formulario__grupo" id="grupo__fecha_final">
				<label for="fecha_final" class="formulario__label">Fecha final</label>
				<div class="formulario__grupo-input">
					<input type="date" class="field"  name="fecha_final" id="fecha_final" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La fecha final debe ser mayor a la fecha de inicio</p>
			    </div>

                <div class="formulario__grupo" id="grupo__precio_venta">
				<label for="precio_venta" class="formulario__label">Precio de venta</label>
				<div class="formulario__grupo-input">
					<input type="number" class="field"  name="precio_venta" id="precio_venta" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener numeros y no se acepta un pecrio de valor 0</p>
			    </div>

                <label for="id_estado_prom">Estado promocion</label></br>
                
                <?php
           $query_prom = mysqli_query($conex,"SELECT * from tbl_estado_promociones");
           $result_prom = mysqli_num_rows($query_prom)
        ?>
            
                <select name="id_estado_prom" id="id_estado_prom">
                   <?php
                     echo $option;
                      if($result_prom > 0){
                        while ($promo= mysqli_fetch_array($query_prom)) {
                        
                   ?>
                   <option value="<?php echo $promo["id_estado_prom"]; ?>"><?php echo $promo["estado_promocion"]?> </option>
                   <?php
                   }
                   }

                   ?>
                </select>

            </br></br>
            
            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>

      <button type="submit" class="btn_agregar">Guardar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='./promocion.php'" class="btn_cancelar">Cancelar</button>

            </form>

                    <script>
                        function cambiarAMayusculas(elemento) {
                            let texto = elemento.value;
                            elemento.value = texto.toUpperCase();
                        }
                    </script>

                    
                </form>




                
                    <?php
            
        
                    ?>
                </form>
      </form>
 <script src="formulariopromocion.js"></script>

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

</div>
</body>
</html>