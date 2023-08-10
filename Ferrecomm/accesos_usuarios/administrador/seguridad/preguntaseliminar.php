

<?php
include '../../../php/bitacora.php';
include '../conex.php';
//Mostrar datos

if(empty($_GET['id'])){
    header('Location: promocion.php');
}
 $id_pregunta = $_GET['id'];
 $sql = mysqli_query($conex, "SELECT id_pregunta, pregunta, fecha_creacion
FROM tbl_ms_preguntas
WHERE id_pregunta = $id_pregunta;");
 $result_sql = mysqli_num_rows($sql);

 if($result_sql == 0){
    header('Location: Preguntas.php');
 }else{
    $option = '';
    while ($data = mysqli_fetch_array($sql)){
        $id_pregunta = $data['id_pregunta'];
        $pregunta = $data['pregunta'];
        $fecha_creacion = $data['fecha_creacion'];


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
	background: red;
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
      <h2>  Eliminar pregunta ¿? </h2>
            <form action="eliminarpregunta.php" method="POST" enctype="multipart/form-data" id="">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

      <input type="hidden" name="id_pregunta" value="<?php echo $id_pregunta;?>">
            <div class="formulario__grupo" id="grupo__nombre_descuento">
				<label for="nombre_descuento" class="formulario__label" >Pregunta:</label>
				<div class="formulario__grupo-input">
                <input type="text" class="field"  name="nombre_descuento" id="nombre_descuento" style="text-transform:uppercase;" value="<?=$pregunta?>" onblur="cambiarAMayusculas(this);" disabled >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre del descuento tiene que contener letras y contener 3 a 25 de las mismas</p>
			    </div>

            <div class="formulario__grupo" id="grupo__porcentaje_descontar">
				<label for="porcentaje_descontar" class="formulario__label">Fecha de creación:</label>
				<div class="formulario__grupo-input">
			<input type="text" class="field"  name="porcentaje_descontar" id="porcentaje_descontar" value="<?=$fecha_creacion?>" disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El porcentaje solo puede contener numeros</p>
			    </div>

            </br>
            

      <button type="submit" class="btn_agregar">Eliminar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='./preguntas.php'" class="btn_cancelar">Cancelar</button>

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

        <script src="formulariopreguntasagregar.js"></script>

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

    <a href="./preguntas.php" class="btn_pdf">Atrás</a>


</body>

</html>