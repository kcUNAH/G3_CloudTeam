
<?php

include '../conex.php';
include '../../../php/bitacora.php';


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
      <h2>  Añadir nueva promoción <i class='bx bxs-purchase-tag-alt'></i></h2>
            <form action="agregarpromocion.php" method="POST" enctype="multipart/form-data" id="formulario">


                <div class="formulario__grupo" id="grupo__nombre_promocion">
				<label for="nombre_promocion" class="formulario__label">Promoción</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="nombre_promocion" id="nombre_promocion" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La promoción debe de tener 3 a 16 letras, solo puede contener números y letras.</p>
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
				<p class="formulario__input-error">Solo puede contener números y no se acepta un pecrio de valor 0</p>
			    </div>

                <label for="id_estado_prom">Estado promoción</label></br>
                
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