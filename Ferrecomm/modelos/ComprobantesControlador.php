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
$idRol=isset($_POST["idRol"])? ($_POST["idRol"]):"";// estas variables dicen de roles pero son para comprobantes.
$NombreRol=isset($_POST["NombreRol"])? ($_POST["NombreRol"]):"";
$idComprobante=isset($_POST["idingreso"])? ($_POST["idingreso"]):"";// estas variables dicen de roles pero son para comprobantes.
$Descripcion=isset($_POST["Descripcion"])? ($_POST["Descripcion"]):"";
$EstadoRol=isset($_POST["EstadoRol"])? ($_POST["EstadoRol"]):"";
$idusuario=$_SESSION["id_usuario"];

$fecha_hora=isset($_POST["fecha_hora"])? ($_POST["fecha_hora"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		
		$sw=true;

		$sentencia = "SELECT nombre FROM tbl_comprobantes_compra where nombre = '$NombreRol'  ";
		$datos = $conn->query($sentencia);
	
		if(empty($datos->fetch_assoc())){

			$sentencia="INSERT INTO tbl_comprobantes_compra (nombre,descripcion,estado)
			VALUES ('$NombreRol','$Descripcion','$EstadoRol')";
	
			//echo $sentencia ? "Ingreso registrado" : "No se pudieron registrar todos los datos del ingreso";
			$datos = $conn->query($sentencia);
			echo  "Comprobante registrado con exito";


		}else{

			echo  "Comprobante Ya existe";

		}
	
		
		
	break;
	case 'actualizar':
		
	
	
 		echo $datos ? "Compra Actualizada" : "Compra no se puede Actualizada";
		
		
	break;




	case 'anular':
       
		$sw=true;
		
			$sentencia="DELETE FROM tbl_comprobantes_compra WHERE id_comprobante = $idComprobante ";
			$datos = $conn->query($sentencia);
		
			echo  "Comprobante ha sido Eliminado con exito";


	
	break;

	case 'mostrar':


	case 'listarDetalle':
	

	break;

	case 'listar':
		
         include_once "../php/conexion2.php";
         $btnView = '';
         $btnEdit = '';
         $btnDelete = '';
         $sentencia = "SELECT * FROM tbl_comprobantes_compra";
         $datos = $conn->query($sentencia);
     
         // Crear una matriz para almacenar los datos de la tabla
         $data = array();
		 $result = "";
         // Recorrer los resultados de la consulta y agregarlos a la matriz de datos
         
         while ($row = $datos->fetch_assoc()) {
			$btnEdit = "<button type='button' style='color: green; background-color: #fff; border-color: #fff;' class='btn btn-primary btn-sm link_edit'  onclick='mostrar2(" . $row['id_comprobante'] . ")'><i class='bx bx-edit'></i></button>";

             $btnDelete = "<button type='button' class='btn btn-primary btn-sm link_delete' style='color: red; background-color: #fff; border-color: #fff;' onclick='anular(" . $row['id_comprobante'] . ")'><i class='bx bxs-trash'></i></button>";
          
			 $data[] = array(
				"id_comprobante" => $row['id_comprobante'],
				"nombre" => $row['nombre'],
				"descripcion" => $row['descripcion'],
				"estado" => $row['estado'],
				
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