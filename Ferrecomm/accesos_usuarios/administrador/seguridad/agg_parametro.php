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
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['nombre_parametro']) || empty($_POST['valor_parametro'])) //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        
        // $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';  
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location= "agregar_proveedores.php";
            </script>
            ';
    } else {

        $nombre_parametro = $_POST['nombre_parametro'];
        $valor_parametro= $_POST['valor_parametro'];
        $d=strtotime("today");
        date("Y-m-d h:i:sa", $d);
        $creado_por="ADMINISTRADOR";
        $modificado_por="ADMINISTRADOR";
        $query = mysqli_query($conex, "SELECT * FROM tbl_ms_parametros WHERE parametro = '$nombre_parametro' ");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            // $alert= '<p class= "msg_error">El usuario ya existe.</p>';
            echo
                '<script>
                alert("El parametro ya existe");
                window.location= "agg_parametro.php";
                </script>
                ';
            $codigoObjeto = 7;
            $accion = 'Registro';
            $descripcion = 'intento registrar un nuevo parametro ya existente';
            bitacora($codigoObjeto, $accion, $descripcion);
        } else {
          
            $queri = "INSERT INTO  tbl_ms_parametros (parametro, valor, fecha_creacion, fecha_modificacion, creado_por, modificado_por) 
                                              VALUES ($nombre_parametro,$valor_parametro,CURTIME(),CURTIME(),$creado_por,$modificado_por')";
            $ejecuta = mysqli_query($conex, $queri);
            if ($ejecuta) {
                //  $alert= '<p class= "msg_save">El usuario se ha creado.</p>';
                echo
                '<script>
                alert("El parametro creado corractamente");
                window.location= "parametros.php";
                </script>
                ';
                $codigoObjeto=7;
                $accion='Registro';
                $descripcion= 'Se agrego un Parametro con exito';
                bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                // $alert= '<p class= "msg_error">Error al crear el usario.</p>';
                echo
                '<script>
                alert("Error al crear el Parametro");
                window.location= "agg_parametro.php";
                </script>
                ';
                $codigoObjeto=7;
                $accion='Registro';
                $descripcion= 'Se intento registrar un parametro';
                bitacora($codigoObjeto, $accion,$descripcion);
            }
     
      
      
        }
    }
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
  

  <section class="home-section">  
    

    <!-- Aqui inicia el formulario-->
  
                    
                      
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
      <h2>  Añadir nuevo parametro <i class='bx bx-id-card'></i></h2>
      <div>
            <form action="agg_parametro.php" method="POST" enctype="multipart/form-data" id="formulario">
            


                <div class="formulario__grupo" id="grupo__nombre_parametro">
				<label for="nombre_parametro" class="formulario__label" >Ingrese Nombre del parametro:</label>
				<div class="formulario__grupo-input">
					<input type="text"  style="text-transform:uppercase;" class="field"  name="nombre_parametro" id="nombre_parametro" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre del parametro tiene que contener letras y contener 3 a 25 de las mismas</p>
			    </div>

                <div class="formulario__grupo" id="grupo__valor_parametro">
				<label for="valor_parametro" class="formulario__label">Valor del parametro:</label>
				<div class="formulario__grupo-input">
			    <input type="text" class="field"  name="valor_parametro" id="valor_parametro"  pattern="^[\w\s,@.-]+$" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">No puede estar vacio el campo</p>
			    </div>
            </br>
            
            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>
        
      <button type="submit" class="btn_agregar"name="verifica" id="verifica"   Value="Ejecutar" href="pregunta.php">Guardar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='../proveedores.php'" class="btn_cancelar">Cancelar</button>
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
<script src="validacionesparametro.js"></script>

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