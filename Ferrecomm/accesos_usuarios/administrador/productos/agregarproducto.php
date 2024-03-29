<?php
include '../conex.php';
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../../accesos/CSS/tablaproducto.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php include "menu.php"; ?>
   </head>
<body>
 
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
            <label for="id_estado_prom">Categoría</label></br>
                
                <?php
           $query_prom = mysqli_query($conex,"SELECT * from tbl_categoria");
           $result_prom = mysqli_num_rows($query_prom)
        ?>
            
                <select name="id_categoria" id="id_categoria">
                   <?php
                     echo $option;
                      if($result_prom > 0){
                        while ($promo= mysqli_fetch_array($query_prom)) {
                        
                   ?>
                   <option value="<?php echo $promo["id_categoria"]; ?>"><?php echo $promo["nombre_categoria"]?> </option>
                   <?php
                   }
                   }

                   ?>
                </select>


                <div class="formulario__grupo" id="grupo__nombre_producto">
				<label for="nombre_producto" class="formulario__label">Nombre producto</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="nombre_producto" id="nombre_producto" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre del producto tiene que iniciar con letras y contener 2 a 16 de las mismas</p>
			    </div>

                <div class="formulario__grupo" id="grupo__descripcion_producto">
				<label for="descripcion_producto" class="formulario__label">Descripción</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="descripcion_producto" id="descripcion_producto" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La descripción del producto debe de tener 4 a 16 letras, solo puede contener números y letras.</p>
			    </div>

                <div class="formulario__grupo" id="grupo__precio_producto">
				<label for="precio_producto" class="formulario__label">Precio</label>
				<div class="formulario__grupo-input">
					<input type="number" class="field"  name="precio_producto" id="precio_producto" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El precio solo puede contener números y puntos</p>
			    </div>

            <p class="input-file-wrapper">
            <label for="upload">Imagen del producto:</label></br>
            <input type="file" name="img_producto" id="img_producto" accept=".jpg, .png, .gif">
            </p>

            <div class="formulario__grupo" id="grupo__unidad_medida">
				<label for="unidad_medida" class="formulario__label">Unidad medida</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="unidad_medida" id="unidad_medida" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener números y letras</p>
			    </div>

                <div class="formulario__grupo" id="grupo__cantidad_min">
				<label for="cantidad_min" class="formulario__label">Cantidad mínima:</label>
				<div class="formulario__grupo-input">
					<input type="number" class="field"  name="cantidad_min" id="cantidad_min" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener números y debe ser menor que la cantidad máxima</p>
			    </div>

                <div class="formulario__grupo" id="grupo__cantidad_max">
				<label for="cantidad_max" class="formulario__label">Cantidad máxima:</label>
				<div class="formulario__grupo-input">
					<input type="number" class="field"  name="cantidad_max" id="cantidad_max" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener números y debe ser mayos que la cantidad mínima </p>
			    </div>

            </br>
            
            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>

      <button type="submit" class="btn_agregar">Guardar</button>
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