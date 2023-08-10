
<?php

include_once "./conexionproducto.php";
include '../../../php/bitacora.php';
//Mostrar datos

if(empty($_GET['id'])){
    header('Location: promocion.php');
}
 $id_promocion = $_GET['id'];
 $sql = mysqli_query($conexion, "SELECT p.id_promocion,p.nombre_promocion, p.fecha_inicio,
 p.fecha_final, p.precio_venta, (p.id_estado_prom) as id_estado_prom, (e.estado_promocion) as estado
FROM tbl_promociones p 
INNER JOIN tbl_estado_promociones e
on p.id_estado_prom = e.id_estado_prom 
WHERE id_promocion = $id_promocion;");
 $result_sql = mysqli_num_rows($sql);

 if($result_sql == 0){
    header('Location: Productos.php');
 }else{
    $option = '';
    while ($data = mysqli_fetch_array($sql)){
        $id_promocion = $data['id_promocion'];
        $nombre_promocion = $data['nombre_promocion'];
        $fecha_inicio = $data['fecha_inicio'];
        $fecha_final =$data['fecha_final'];
        $precio_venta = $data['precio_venta'];
        $id_estado_prom = $data['id_estado_prom'];
        $estado = $data['estado'];

        if($id_estado_prom == 1){
            $option = '<option value="'.$id_estado_prom.'"select>'.$estado.'</option>';
        }else if($id_estado_prom == 2){
            $option = '<option value="'.$id_estado_prom.'"select>'.$estado.'</option>';
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
      
      <form action="editarpromocion.php" method="POST" enctype="multipart/form-data" id="formulario">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
      <input type="hidden" name="id_promocion" value="<?php echo $id_promocion;?>">
        
      <div class="formulario__grupo" id="grupo__nombre_promocion">
				<label for="nombre_promocion" class="formulario__label">Promoción</label>
				<div class="formulario__grupo-input">
					<input type="text" class="field"  name="nombre_promocion" id="nombre_promocion" style="text-transform:uppercase;" value="<?php echo $nombre_promocion;?>" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La promoción debe de tener 4 a 16 letras, solo puede contener números y letras.</p>
			    </div>

                <div class="formulario__grupo" id="grupo__fecha_inicio">
				<label for="fecha_inicio" class="formulario__label">Fecha de inicio</label>
				<div class="formulario__grupo-input">
					<input type="date" class="field"  name="fecha_inicio" id="fecha_inicio" value="<?php echo date('Y-m-d', strtotime($fecha_inicio)) ?>" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La fecha de inicio debe ser menor a la fecha final</p>
			    </div>

                <div class="formulario__grupo" id="grupo__fecha_final">
				<label for="fecha_final" class="formulario__label">Fecha final</label>
				<div class="formulario__grupo-input">
					<input type="date" class="field"  name="fecha_final" id="fecha_final" value="<?php echo date('Y-m-d', strtotime($fecha_final)) ?>" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La fecha final debe ser mayor a la fecha de inicio</p>
			    </div>

                <div class="formulario__grupo" id="grupo__precio_venta">
				<label for="precio_venta" class="formulario__label">Precio de venta</label>
				<div class="formulario__grupo-input">
					<input type="number" class="field"  name="precio_venta" id="precio_venta" style="text-transform:uppercase;" value="<?php echo $precio_venta;?>" onblur="cambiarAMayusculas(this);" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Solo puede contener números</p>
			    </div>

                <label for="id_estado_prom">Estado promoción</label></br>
                
                <?php
           $query_prom = mysqli_query($conexion,"SELECT * from tbl_estado_promociones");
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
            
      <button class="btn_agregar">Actualizar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='promocion.php'" class="btn_cancelar">Cancelar</button>



                    <script>
                        function cambiarAMayusculas(elemento) {
                            let texto = elemento.value;
                            elemento.value = texto.toUpperCase();
                        }
                    </script>

                    
                </form>
<script src="formulariopromocioneditar.js"></script>

      
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