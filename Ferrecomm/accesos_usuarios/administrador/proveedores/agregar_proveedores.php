
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
      <h2>  Añadir nuevo proveedor <i class='bx bx-id-card'></i></h2>
      <div>
            <form action="registro_proveedores.php" method="POST" enctype="multipart/form-data" id="formulario">
            


                <div class="formulario__grupo" id="grupo__nombre_proveedor">
				<label for="nombre_proveedor" class="formulario__label" >Nombre del proveedor</label>
				<div class="formulario__grupo-input">
					<input type="text"  style="text-transform:uppercase;" class="field"  style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);"  name="nombre_proveedor"  id="nombre_proveedor">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre del producto tiene que contener letras y contener 3 a 25 de las mismas</p>
			    </div>

                <div class="formulario__grupo" id="grupo__rtn_proveedor">
				<label for="rtn_proveedor" class="formulario__label">RTN Proveedor:</label>
				<div class="formulario__grupo-input">
			    <input type="text" class="field"  name="rtn_proveedor" maxlength="14" id="rtn_proveedor"  required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
                <p class="formulario__input-error">El RTN no puede conter solo numeros 0 y tampoco puede tener letras</p>
			    </div>

               
                <style>
  select#country {
    width: 100px;
    padding: 5px;
    line-height: 1;
  }
  input#telefono {
    width: 350px;
    height: 30px;
    padding: 8px;
    font-size: 12px;
    border-radius: 1px;
    border: 1px solid #ccc;
  }
</style>

<label for="pais"  class="formulario__label">Telefono:</label>
            <div class="formulario__grupo" id="grupo__telefono">
				
<div class="formulario__grupo-input">
              


         <select id="country" name="pais" id="country ">
        <option value="(+501)">BZ(+501)</option>
        <option value="(+502)">GT(+502)</option>
        <option value="(+503)">SV(+503)</option>
        <option value="(+504)"selected>HN(+504)</option>
        <option value="(+505)">NI(+505)</option>
        <option value="(+506)">CR(+506)</option>
        <option value="(+507)">PA(+507)</option>
    
        <div class="formulario__grupo-input">
     <input type="text" id="telefono" name="telefono" maxlength="8" placeholder="Ingresa tu número de teléfono">
     <i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El telefono no puede conter solo numeros 0 y tampoco puede tener letras</p>
			    </div>
    </select>


                <script>
    
</script>

                <div class="formulario__grupo" id="grupo__email">
                        <label for="email" class="formulario__label">Correo Electrónico:</label>
                        <div class="formulario__grupo-input">
                            <input type="email" class="field"  name="email" id="email" placeholder="correo@correo.com">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">El correo debe de contener letras, numeros, puntos,arrobas, guiones y guion bajo.</p>
                    </div>

                   <div class="formulario__grupo" id="grupo__direccion">
				<label for="direccion" class="formulario__label">Dirección</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);"   name="direccion" id="direccion">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La direccion debe de conter mas de 3 letras</p>
			    </div>

            </br>
            
            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>
            <script>
                    function cambiarAMayusculas(elemento) {
                        let texto = elemento.value;
                        elemento.value = texto.toUpperCase();
                    }
                </script>
      <button type="submit" class="btn_agregar">Agregar</button>
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
<script src="formularioproveedores.js"></script>

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