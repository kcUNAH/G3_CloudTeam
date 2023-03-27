<?php 

  session_start();

require_once "Compras.php";

$ingreso=new Compras();
/*
$idingreso=isset($_POST["idingreso"])? limpiarCadena($_POST["idingreso"]):"";
$idproveedor=isset($_POST["idproveedor"])? limpiarCadena($_POST["idproveedor"]):"";
$idusuario=$_SESSION["idusuario"];
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
$total_compra=isset($_POST["total_compra"])? limpiarCadena($_POST["total_compra"]):"";*/

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idingreso)){
			$rspta=$ingreso->insertar($idproveedor,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_compra,$_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_compra"],$_POST["precio_venta"]);
			echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos del ingreso";
		}
		else {
		}
	break;

	case 'anular':
		$rspta=$ingreso->anular($idingreso);
 		echo $rspta ? "Ingreso anulado" : "Ingreso no se puede anular";
	break;

	case 'mostrar':
		$rspta=$ingreso->mostrar($idingreso);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $ingreso->listarDetalle($id);
		$total=0;
		echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Subtotal</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td>'.$reg->cantidad.'</td><td>'.$reg->precio_compra.'</td><td>'.$reg->precio_venta.'</td><td>'.$reg->precio_compra*$reg->cantidad.'</td></tr>';
					$total=$total+($reg->precio_compra*$reg->cantidad);
				}
		echo '<tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/.'.$total.'</h4><input type="hidden" name="total_compra" id="total_compra"></th> 
                                </tfoot>';
	break;

	case 'listar':
		
         include_once "../php/conexion2.php";
         $btnView = '';
         $btnEdit = '';
         $btnDelete = '';
         $sentencia = "SELECT * FROM tbl_compras ";
         $datos = $conn->query($sentencia);
     
         // Crear una matriz para almacenar los datos de la tabla
         $data = array();
     
         // Recorrer los resultados de la consulta y agregarlos a la matriz de datos
         
         while ($row = $datos->fetch_assoc()) {
             $btnEdit = "<button type='button' class='btn btn-primary btn-sm' onclick='editCompras(" . $row['id_compra'] . ")'>Editar</button>";
             $btnDelete = "<button type='button' class='btn btn-danger btn-sm' onclick='deleteCompras(" . $row['id_compra'] . ")'>Eliminar</button>";
             $result[] = array(
                 "id_compra" => $row['id_compra'],
                 "id_proveedor" => $row['id_proveedor'],
                 "fecha_compra" => $row['fecha_compra'],
                 "total_compra" => $row['total_compra'],
                 "id_estado_compras" => $row['id_estado_compras'],
                 "options" => $btnEdit . " " . $btnDelete
             );
         }
         // Devolver los datos en formato JSON
     
         
         echo json_encode($result);
     
     

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

	case 'listarArticulos':
		include_once "../php/conexion2.php";
		$sentencia = "SELECT * FROM tbl_producto";
		$datos = $conn->query($sentencia);

 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$datos->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_producto.',\''.$reg->nombre_producto.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->nombre_producto,
 				"2"=>$reg->id_tipo_producto ,
 				"3"=>$reg->id_categoria ,
 				"4"=>$reg->cantidad_max,
 				"5"=>"<img  height='50px' width='50px' >"
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