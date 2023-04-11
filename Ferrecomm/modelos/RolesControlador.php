<?php 
	function dep($data)
    {
        $format  = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }
  session_start();
  
require_once "Compras.php";
include_once "../php/conexion2.php";

// RECORDAR PONER LA FUNCION DE LIMPIAR CADENA****************************************************************************
$idRol=isset($_POST["idRol"])? ($_POST["idRol"]):"";
$NombreRol=isset($_POST["NombreRol"])? ($_POST["NombreRol"]):"";
$Descripcion=isset($_POST["Descripcion"])? ($_POST["Descripcion"]):"";
$EstadoRol=isset($_POST["EstadoRol"])? ($_POST["EstadoRol"]):"";
$idusuario=$_SESSION["id_usuario"];

$fecha_hora=isset($_POST["fecha_hora"])? ($_POST["fecha_hora"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		
		$sw=true;

		$sentencia = "SELECT rol FROM tbl_ms_rol where rol = '$NombreRol'  ";
		$datos = $conn->query($sentencia);
	
		if(empty($datos->fetch_assoc())){

			$sentencia="INSERT INTO tbl_ms_rol (rol,descripcion,estado,creado_por,fecha_creacion)
			VALUES ('$NombreRol','$Descripcion','$EstadoRol',$idusuario,$fecha_hora)";
	
			//echo $sentencia ? "Ingreso registrado" : "No se pudieron registrar todos los datos del ingreso";
			$datos = $conn->query($sentencia);
			echo  "Rol de usuario registrado con exito";


		}else{

			echo  "Rol Ya existe";

		}
	
		
		
	break;
	case 'actualizar':
		
	
	
 		echo $datos ? "Compra Actualizada" : "Compra no se puede Actualizada";
		
		
	break;




	case 'anular':



		$sw=true;
		

		
		$sentencia = "SELECT usuario FROM tbl_ms_usuario where id_rol = $idRol  ";
		$datos = $conn->query($sentencia);
	
		if(empty($datos->fetch_assoc())){

			$sentencia="DELETE FROM tbl_ms_rol WHERE id_rol = $idRol ";
			$datos = $conn->query($sentencia);
		
			echo  "Rol de usuario Eliminado con exito";


		}else{

			echo  "No se puede eliminar un rol que este asignado a usuarios";

		}
	break;

	case 'mostrar':


	case 'listarDetalle':
	

	break;

	case 'listar':
		
         include_once "../php/conexion2.php";
         $btnView = '';
         $btnEdit = '';
         $btnDelete = '';
         $sentencia = "SELECT * FROM tbl_ms_rol";
         $datos = $conn->query($sentencia);
     
         // Crear una matriz para almacenar los datos de la tabla
         $data = array();
		 $result = "";
         // Recorrer los resultados de la consulta y agregarlos a la matriz de datos
         
         while ($row = $datos->fetch_assoc()) {
			$btnEdit = "<button type='button' style='color: green; background-color: #fff; border-color: #fff;' class='btn btn-primary btn-sm link_edit' data-toggle='modal' data-target='#myModal' onclick='mostrar(" . $row['id_rol'] . ")'><i class='bx bx-edit'></i></button>";

             $btnDelete = "<button type='button' class='btn btn-primary btn-sm link_delete' style='color: red; background-color: #fff; border-color: #fff;' onclick='anular(" . $row['id_rol'] . ")'><i class='bx bxs-trash'></i></button>";
          
			 $data[] = array(
				"id_rol" => $row['id_rol'],
				"rol" => $row['rol'],
				"descripcion" => $row['descripcion'],
				"estado" => $row['estado'],
				"fecha_creacion" => $row['fecha_creacion'], // corrected key name
				"options" => $btnEdit . " " . $btnDelete
			);
         }
         // Devolver los datos en formato JSON
		 echo json_encode($data);
         
        
     
     

	break;
	
	case 'selectidcompra':
		include_once "../php/conexion2.php";
		$btnView = '';
		$btnEdit = '';
		$btnDelete = '';
		$contador = 0;
		$sentencia = "SELECT id_compra FROM tbl_compras ORDER BY id_compra DESC LIMIT 1";
		$datos = $conn->query($sentencia);
		
		if ($datos->num_rows > 0) {
			// Se encontró el último ID generado automáticamente en la tabla
			$fila = $datos->fetch_assoc();
			$ultimo_id_compra = $fila["id_compra"];
			$contador =  $ultimo_id_compra + 1;
		} else{
			
			$sentencia = "ALTER TABLE tbl_compras AUTO_INCREMENT = 1;";
			$datos = $conn->query($sentencia);
			$contador =  1;
		}
		echo  $contador ;
	break;
	case 'selectProveedor':
        include_once "../php/conexion2.php";
         $btnView = '';
         $btnEdit = '';
         $btnDelete = '';
         $sentencia = "SELECT * FROM tbl_proveedores ";
         $datos = $conn->query($sentencia);
         
    
		while ($reg = $datos->fetch_object())
				{
				echo '<option value=' . $reg->id_proveedor. '>' . $reg->nombre_proveedor. '</option>';
				}
             
	break;
	case 'selectEstado':
        include_once "../php/conexion2.php";
         $btnView = '';
         $btnEdit = '';
         $btnDelete = '';
         $sentencia = "SELECT * FROM tbl_estado_compras ";
         $datos = $conn->query($sentencia);
         
    
		while ($reg = $datos->fetch_object())
				{
				echo '<option value=' . $reg->id_estado_compras. '>' . $reg->nombre_estad_compra. '</option>';
				}
             
	break;

	case 'listarArticulos':
		include_once "../php/conexion2.php";
		$sentencia = "SELECT tbl_producto.*, tbl_categoria.nombre_categoria 
		FROM tbl_producto 
		INNER JOIN tbl_categoria ON tbl_producto.id_categoria = tbl_categoria.id_categoria;
		";
		$datos = $conn->query($sentencia);

 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$datos->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_producto.',\''.$reg->nombre_producto.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->nombre_producto,
 				"2"=>$reg->nombre_categoria ,
 			
 				"3"=>$reg->cantidad_max,
 				"4"=>"<img width='100' src='data:image/jpg;base64,".base64_encode($reg->img_producto)."'>"
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;
}
?>