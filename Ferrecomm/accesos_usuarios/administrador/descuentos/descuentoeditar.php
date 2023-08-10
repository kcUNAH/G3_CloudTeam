<?php

include '../conex.php';
include '../../../php/bitacora.php';


//Si no existe el usuario me redirecciona a gestion de usuario QUITAR EL !
if(empty($_GET['id']))
{
    header('Location: descuentos.php');
}

$id_descuento  = $_GET['id'];

$sql = mysqli_query($conex,"SELECT id_descuentos, nombre_descuento, porcentaje_descontar
 FROM tbl_descuentos
WHERE id_descuentos = $id_descuento ");

$result_sql = mysqli_num_rows($sql);

//Si es igual a cero no hay registro
if($result_sql == 0)
{
    header('Location: clientes.php');
}else{
    $option = ' ';
    while ($data = mysqli_fetch_array($sql)){
        $id_descuento  = $data['id_descuentos'];
        $nombre_descuento = $data['nombre_descuento'];
        $porcentaje_descontar = $data['porcentaje_descontar'];
  
}

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../../accesos/CSS/tablaproducto.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php include "../productos/menu.php"; ?>
    
    
</head>

<body>

  <section class="home-section">
  
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
    width: 226px;
    justify-content: center;
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
    width: 226px;
    justify-content: center;
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
      <h2>  Editar Descuento <i class='bx bxs-discount'></i></h2>  
      
        
        <form action="editar.php" method ="POST" enctype="multipart/form-data" id="formulario">
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <input type="hidden" name="id_descuento" value="<?php echo $id_descuento;?>">
            <div class="formulario__grupo" id="grupo__nombre_descuento">
				<label for="nombre_descuento" class="formulario__label" >Nombre del descuento:</label>
				<div class="formulario__grupo-input">
                <input type="text" class="field"  name="nombre_descuento" id="nombre_descuento" style="text-transform:uppercase;" value="<?=$nombre_descuento?>" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre del descuento tiene que contener letras y contener 3 a 25 de las mismas</p>
			    </div>

            <div class="formulario__grupo" id="grupo__porcentaje_descontar">
				<label for="porcentaje_descontar" class="formulario__label">Descuento:</label>
				<div class="formulario__grupo-input">
			<input type="number" class="field"  name="porcentaje_descontar" id="porcentaje_descontar" value="<?=$porcentaje_descontar?>" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El porcentaje debe de ser mayor a 1 y menor a 100</p>
			    </div>

            </br>
            
            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>

      <button type="submit" class="btn_agregar">Agregar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='descuentos.php'" class="btn_cancelar">Cancelar</button>
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



        </div>

        <script src="formulariodescuentoseditar.js"></script>

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

    <a href="descuentos.php" class="btn_pdf">Atrás</a>


</body>

</html>