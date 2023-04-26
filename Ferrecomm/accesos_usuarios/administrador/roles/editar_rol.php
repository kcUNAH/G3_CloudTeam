


<?php
        
        include '../conex.php';

    
        if (!empty($_POST)){
            
            if(empty($_POST['rol']) || empty($_POST['estado'])  )  //Si van vacios nos muestra el mensaje de erro, sino capturalos datos
            {
                $alert= '<p class= "msg_error"> Todos los campos son obligatorios.</p>';    
        
            }else{
                
                $id_rol = $_POST['id_rol'];
                $rol = $_POST['rol'];
                $descripcion = $_POST['descripcion'];
                //$creado_por = $_POST['creado_por'];
                //$fecha_creacion = $_POST['fecha_creacion'];
                $modificado_por = "ADMINISTRADOR";
                //$fecha_modificacion = $_POST['fecha_modificacion'];
                 //Creacion automatica de fecha
                 date_default_timezone_set('America/Tegucigalpa');
                 $fecha_modificacion =date("Y-m-d H:i:s");
                $estado = $_POST['estado'];
                $id_objeto=16 ;
                
                if ($estado == 1) {
                    $estado= 'ACTIVO';
                }else{
                    $estado = 'INACTIVO';
                }

                $query = mysqli_query($conex,"SELECT * FROM tbl_ms_rol
                WHERE (rol = '$rol' AND id_rol != $id_rol)");

            $result = mysqli_fetch_array($query); //Almacena datos

            if($result > 0){ //Si ya existe manda eel mensaje 
                $alert= '<p class= "msg_error">El ROL ya existe.</p>';
            }else{

               
                    $sql_update = mysqli_query($conex,"UPDATE tbl_ms_rol SET 
                    rol='$rol', descripcion='$descripcion',fecha_modificacion='$fecha_modificacion', modificado_por='$modificado_por',
                     estado='$estado'
                    WHERE id_rol= $id_rol");

$usuarioprimero = "SELECT permiso_actualizacion FROM tbl_ms_permisos WHERE id_objeto = 11 ";
$obtener_primer_ingreso = mysqli_query($conex,$usuarioprimero);
$filai_primer = mysqli_fetch_array($obtener_primer_ingreso);
$va_primer_ingreso =$filai_primer ['permiso_actualizacion'];
if($va_primer_ingreso==1 && $id_objeto==16 ){

                    if($sql_update){
                       // $alert= '<p class= "msg_save">El usuario se ha actualizado correctamente.</p>';
                        
                       echo '<script>
                        alert("El ROL se ha actualizado correctamente");
                        window.location= "rol.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'El Usuario Actualizo el ROL';
                        bitacora($codigoObjeto, $accion,$descripcion);
                    }else{
                        //$alert= '<p class= "msg_error">Error al actualizar el usario.</p>';
                        echo '<script>
                        alert("Error al actualizar el ROL");
                        window.location= "editar_rol.php";
                        </script>
                        ';
                        $codigoObjeto=3;
                        $accion='Actualizar';
                        $descripcion= 'Se produjo un error al  Actualizo el ROL';
                        bitacora($codigoObjeto, $accion,$descripcion);
                      }
        
                    }else{
                       if($va_primer_ingreso==0 && $id_objeto==16){
                        
                        echo
                        '<script>
                        alert("usted no tiene permisos para Editar un rol");
                        window.location= "parametros.php";
                        </script>
                        ';
                }
                
                }
            }     
            } 
          }
            
            

//Si no existe el usuario me redirecciona a gestion de usuario QUITAR EL !
    if(empty($_GET['id']))
    {
        header('Location: rol.php');
    }

    $iduser  = $_GET['id'];

    $sql = mysqli_query($conex,"SELECT id_rol, rol,descripcion, creado_por, fecha_creacion, modificado_por, fecha_modificacion, estado
     FROM tbl_ms_rol
    WHERE id_rol = $iduser ");

    $result_sql = mysqli_num_rows($sql);

//Si es igual a cero no hay registro
    if($result_sql == 0)
    {
        header('Location: rol.php');
    }else{
        $option = ' ';
        while ($data = mysqli_fetch_array($sql)){
            $iduser  = $data['id_rol'];
            $rol = $data['rol'];
            $descripcion = $data['descripcion'];
            //$creado_por = $data['creado_por'];
            //Creacion automatica de fecha
           // date_default_timezone_set('America/Tegucigalpa');
           // $fecha_creacion = date("Y-m-d H:i:s");
            $modificado_por = 'ADMINISTRADOR';
            //Creacion automatica de fecha
            date_default_timezone_set('America/Tegucigalpa');
            $fecha_modificacion = date("Y-m-d H:i:s");
            $estado = $data['estado'];
      
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
  
  <section class="home-section">
    
     </li>
    </a>
    </ul>
  </div>
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
  <h2>  Editar ROL <i class='bx bxs-user'></i></h2>
      
  <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        
        <form id="formulario" action="" method ="POST">
        <input type="hidden" name="id_rol" value="<?php echo $iduser;?>">
            
        <div class="formulario__grupo" id="grupo__rol">
				<label for="rol" class="formulario__label" >ROL</label>
				<div class="formulario__grupo-input">
                <input type="text" class="field"  name="rol" id="rol" style="text-transform:uppercase;" value="<?=$rol?>" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre del ROL tiene que contener letras y contener 3 a 25 de las mismas</p>
			    </div>

            <div class="formulario__grupo" id="grupo__descripcion">
				<label for="descripcion" class="formulario__label" >Descripcion</label>
				<div class="formulario__grupo-input">
                <input type="text" class="field"  name="descripcion" id="descripcion" style="text-transform:uppercase;" value="<?=$descripcion?>" onblur="cambiarAMayusculas(this);" required >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La descripción tiene que contener letras y contener 3 a 25 de las mismas</p>
			    </div>



                <label for="estado">Estado</label>
            <select name="estado" id="estado">
                <option value="1">ACTIVO</option>
                <option value="2">INACTIVO</option>
                
                
            </select>

            </br>
            
            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>

      <button type="submit" class="btn_agregar">Agregar</button>
      <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
      <button type="reset" onclick="location.href='rol.php'" class="btn_cancelar">Cancelar</button>
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
        <script src="formulariorol_editar.js"></script>

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

<a href="rol.php" class="btn_pdf">Atrás</a>
</body>
</html>