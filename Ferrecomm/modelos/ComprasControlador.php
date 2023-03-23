<?php 

  session_start();

require_once "Compras.php";
include_once "../php/conexion2.php";

$ingreso=new Compras();
// RECORDAR PONER LA FUNCION DE LIMPIAR CADENA****************************************************************************
$idingreso=isset($_POST["idingreso"])? ($_POST["idingreso"]):"";
$idproveedor=isset($_POST["idproveedor"])? ($_POST["idproveedor"]):"";

$idusuario=$_SESSION["id_usuario"];
$tipo_comprobante=isset($_POST["tipo_comprobante"])? ($_POST["tipo_comprobante"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? ($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? ($_POST["num_comprobante"]):"";// POR SI PIDE COMPROBANTE
$fecha_hora=isset($_POST["fecha_hora"])? ($_POST["fecha_hora"]):"";
$impuesto=isset($_POST["impuesto"])? ($_POST["impuesto"]):"";
$total_compra=isset($_POST["total_compra"])? ($_POST["total_compra"]):"";

switch ($_GET["op"]){
	
	case 'guardaryeditar':
		if (empty($idingreso)){
		//$rspta=$ingreso->insertar($idproveedor,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_compra,$_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_compra"],$_POST["precio_venta"]);
		$sentencia="INSERT INTO tbl_compras (id_proveedor,id_usuario,fecha_compra,total_compra,id_estado_compras)
		VALUES ('$idproveedor','$idusuario','$fecha_hora','$total_compra',1)";
		//return ejecutarConsulta($sql);
		$datos = $conn->query($sentencia);
			$producto = $_POST;
		$num_elementos=0;
		$sw=true;
		echo  $producto;
		die();
		
		while ($num_elementos < count($producto))
		{


			$sql_detalle = "INSERT INTO detalle_ingreso(idingreso, idarticulo,cantidad,precio_compra,precio_venta) VALUES ('$datos', '$producto[$num_elementos]','$cantidad[$num_elementos]','$precio_compra[$num_elementos]','$precio_venta[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;

			echo $sentencia ? "Ingreso registrado" : "No se pudieron registrar todos los datos del ingreso";
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
					echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td style="width: 50px;" >'.$reg->cantidad.'</td><td style="width: 50px;">'.$reg->precio_compra.'</td><td>'.$reg->precio_venta.'</td><td>'.$reg->precio_compra*$reg->cantidad.'</td></tr>';
					$total=$total+($reg->precio_compra*$reg->cantidad);
				}
		echo '<tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">L.'.$total.'</h4><input type="hidden" name="total_compra" id="total_compra"></th> 
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
		 $result = "";
         // Recorrer los resultados de la consulta y agregarlos a la matriz de datos
         
         while ($row = $datos->fetch_assoc()) {
             $btnEdit = "<button type='button' style='color: green; background-color: #fff; border-color: #fff;' class='btn btn-primary btn-sm link_edit' onclick='editCompras(" . $row['id_compra'] . ")'><i class='bx bx-edit'></i></button>";
             $btnDelete = "<button type='button' class='btn btn-primary btn-sm link_delete' style='color: red; background-color: #fff; border-color: #fff;' onclick='deleteCompras(" . $row['id_compra'] . ")'><i class='bx bxs-trash'></i></button>";
             $data[] = array(
                 "id_compra" => $row['id_compra'],
                 "id_proveedor" => $row['id_proveedor'],
                 "fecha_compra" => $row['fecha_compra'],
                 "total_compra" => $row['total_compra'],
                 "id_estado_compras" => $row['id_estado_compras'],
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
		$sentencia = "SELECT id_compra FROM tbl_compras ";
		$datos = $conn->query($sentencia);
	
		while ($fila = $datos->fetch_assoc()) {
			$id_compra = $fila['id_compra'];
			$contador += 1;
		}
		echo $contador + 1;	
             
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
				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_producto.',\''.$reg->nombre_producto.'\', '.$reg->precio_producto.')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->nombre_producto,
 				"2"=>$reg->id_categoria ,
 				"3"=>$reg->descripcion_producto,
 				"4"=>$reg->cantidad_max,
 				"5"=>"<img width='100' src='data:image/jpg;base64,".base64_encode($reg->img_producto)."'>"
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