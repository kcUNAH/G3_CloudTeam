

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
        <li>
            <a href="../GestionUsuarios.php">
                <i class='bx bx-package'></i>
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
      <h2>  Añadir nuevo producto <i class='bx bx-shopping-bag'></i></h2>
            <form action="./agregar.php" method="POST" enctype="multipart/form-data" id="formulario">
            <label for="id_categoria">Categoria</label></br>
                <select name="id_categoria" id="id_categoria">
                    <option value="1">Construccion</option>
                    <option value="2">Industrial</option>
                    <option value="3">Plomeria</option>
                </select>


                <div class="formulario__grupo" id="grupo__nombre_producto">
				<label for="nombre_producto" class="formulario__label">Nombre producto</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="nombre_producto" id="nombre_producto" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre del producto tiene que contener letras y contener 3 a 16 de las mismas</p>
			    </div>

                <div class="formulario__grupo" id="grupo__descripcion_producto">
				<label for="descripcion_producto" class="formulario__label">Descripcion</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="descripcion_producto" id="descripcion_producto" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La descripcion del producto debe de tener 4 a 16 letras, solo puede contener numeros Y letras.</p>
			    </div>

                <div class="formulario__grupo" id="grupo__precio_producto">
				<label for="precio_producto" class="formulario__label">Precio</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="precio_producto" id="precio_producto" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El precio solo puede contener numeros y puntos</p>
			    </div>

            <p class="input-file-wrapper">
            <label for="upload">Imagen del producto:</label></br>
            <input type="file" name="img_producto" id="img_producto" accept=".jpg, .png, .gif">
            </p>

            <div class="formulario__grupo" id="grupo__unidad_medida">
				<label for="unidad_medida" class="formulario__label">Unidad medida</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="unidad_medida" id="unidad_medida" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener numeros y letras</p>
			    </div>

                <div class="formulario__grupo" id="grupo__cantidad_min">
				<label for="cantidad_min" class="formulario__label">Cantidad minima:</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="cantidad_min" id="cantidad_min" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener numeros</p>
			    </div>

                <div class="formulario__grupo" id="grupo__cantidad_max">
				<label for="cantidad_max" class="formulario__label">Cantidad maxima:</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="cantidad_max" id="cantidad_max" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener numeros</p>
			    </div>

            </br>
            
            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>

      <button type="submit" class="btn_agregar">Agregar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='../Productos.php'" class="btn_cancelar">Cancelar</button>

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

</div>
</body>
</html>