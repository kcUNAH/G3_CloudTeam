

<?php

include '../conex.php';
include '../../../php/bitacora.php';



if (!empty($_POST)) {

    if (empty($_POST['nombre_categoria']) || empty($_POST['presentacion']))  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
    {
        echo '<script>
            alert("Todos los campos son obligatorios");
            window.location.href= "promocionagregar.php";
            </script>
            ';
    } else {

        $nombre_categoria =$_POST['nombre_categoria'];
        $presentacion = $_POST['presentacion'];

            $query_insert = mysqli_query($conex, "INSERT INTO tbl_categoria(nombre_categoria,presentacion)
            VALUES('$nombre_categoria','$presentacion')");

            if ($query_insert) {
                echo
                '<script>
                alert("Categoria agregada correctamente");
                window.location= "../categoria.php";
                </script>
                ';
                $codigoObjeto=7;
                $accion='Registro';
                $descripcion= 'Se agrego una categoria nueva con Exito';
                bitacora($codigoObjeto, $accion,$descripcion);
            } else {
                echo
                '<script>
                alert("Error al añadir la caategoria");
                window.location= "categorianueva.php";
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
     <?php include "../productos/menu.php"; ?>
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
      <h2>  Añadir nueva categoria <i class='bx bxs-category'></i></h2>
            <form action="" method="POST" enctype="multipart/form-data" id="formulario">


                <div class="formulario__grupo" id="grupo__nombre_categoria">
				<label for="nombre_categoria" class="formulario__label">Nombre de la categoria</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="nombre_categoria" id="nombre_categoria" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener letras</p>
			    </div>

                <div class="formulario__grupo" id="grupo__presentacion">
				<label for="presentacion" class="formulario__label">Presentacion</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="presentacion" id="presentacion" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener letras y numeros</p>
			    </div>
                </br>
            
                <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>

      <button type="submit" class="btn_agregar">Guardar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='../categoria.php'" class="btn_cancelar">Cancelar</button>

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
 <script src="formulariocategoria.js"></script>

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