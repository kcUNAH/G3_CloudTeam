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

$ingreso=new Compras();
// RECORDAR PONER LA FUNCION DE LIMPIAR CADENA****************************************************************************
$idingreso=isset($_POST["idingreso"])? ($_POST["idingreso"]):"";
$idproveedor=isset($_POST["idproveedor"])? ($_POST["idproveedor"]):"";
$idestadocompra=isset($_POST["estadoc"])? ($_POST["estadoc"]):"";
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
		$sentencia="INSERT INTO tbl_compras (id_proveedor,id_usuario,fecha_compra,total_compra,id_estado_compras,id_comprobante)
		VALUES ('$idproveedor','$idusuario','$fecha_hora','$total_compra',1,$tipo_comprobante)";
		//echo $sentencia ? "Ingreso registrado" : "No se pudieron registrar todos los datos del ingreso";
		$datos = $conn->query($sentencia);
		$id_compra = $conn->insert_id;
		
	
		$num_elementos=0;
		$sw=true;
		$idarticulo = 	$_POST["idarticulo"];
		$cantidad	= $_POST["cantidad"];
		$precio_compra = $_POST["precio_venta"];

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO tbl_detall_compra(id_compra, id_producto,cantidad_compra ,precio_costo) VALUES ('$num_comprobante', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_compra[$num_elementos]')";
			$datos = $conn->query($sql_detalle);
			$num_elementos=$num_elementos + 1;
		}

			// Recuperar los detalles de la compra
			$sql_detalles_compra = "SELECT id_producto, cantidad_compra FROM tbl_detall_compra WHERE id_compra = '$id_compra'";
			$resultado_detalles_compra = $conn->query($sql_detalles_compra);

			// Actualizar el inventario para cada producto comprado
			while ($fila = $resultado_detalles_compra->fetch_assoc()) {
				$id_producto = $fila['id_producto'];
				$cantidad_compra = $fila['cantidad_compra'];
			
				// Recuperar la cantidad actual en el inventario
				$sql_inventario = "SELECT cantidad FROM tbl_inventario WHERE id_producto = '$id_producto'";
				$resultado_inventario = $conn->query($sql_inventario);
				$fila_inventario = $resultado_inventario->fetch_assoc();
				$cantidad_actual = $fila_inventario['cantidad'];
				$usuario =$_SESSION['usuario']['user'];
				$sql_id_user = "SELECT id_usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'";
				$resultado_id = $conn->query($sql_id_user);
				$fila_id = $resultado_id->fetch_assoc();
				$id_usuario = $fila_id['id_usuario'];

				
				// Actualizar la cantidad en el inventario
				$cantidad_nueva = $cantidad_actual + $cantidad_compra;
				$sql_actualizar_inventario = "UPDATE tbl_inventario SET cantidad = '$cantidad_nueva' WHERE id_producto = '$id_producto'";
				$resultado_actualizar_inventario = $conn->query($sql_actualizar_inventario);
			
				// Agregar registro al movimiento de inventario
				$tipo_movimiento = 3;
				$fecha = date("Y-m-d H:i:s");
				$sql_movimiento_inventario = "INSERT INTO tbl_mov_inventario (id_producto,id_usuario , cantidad_mov, id_tipo_mov_invt 	, fecha_mov , 	comentario 	) VALUES ('$id_producto',$id_usuario, '$cantidad_compra', '$tipo_movimiento', '$fecha','Nueva Compra')";
				$resultado_movimiento_inventario = $conn->query($sql_movimiento_inventario);

			}			
		/////
		echo $num_elementos ? "Compra registrada con exito" : "No se pudieron registrar todos los datos de la compra";
		/////
		return $sw;
		
		}
	break;
	case 'actualizar':
		
		
		include_once "../php/conexion2.php";
		$sql="UPDATE tbl_compras SET  	id_estado_compras 	= $idestadocompra  WHERE id_compra ='$idingreso'"; // 2 es anulado
		$datos = $conn->query($sql);

	
 		echo $datos ? "Compra Actualizada" : "Compra no se puede Actualizada";
		
		
	break;




	case 'anular':
		$sql_id_compra = "SELECT  id_estado_compras 	 FROM tbl_compras WHERE id_compra = '$idingreso'";
		$resultado_id_compra = $conn->query($sql_id_compra);
		$fila_id = $resultado_id_compra->fetch_assoc();
		$resultado_id_compra = $fila_id['id_estado_compras'];
		if($resultado_id_compra == 2 ){

			echo "Error! Compra ya ha sido anulada.";
		}else{


	



		$usuario =$_SESSION['usuario']['user'];
		$sql_id_user = "SELECT id_usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'";
		$resultado_id = $conn->query($sql_id_user);
		$fila_id = $resultado_id->fetch_assoc();
		$id_usuario = $fila_id['id_usuario'];

		$sql="UPDATE tbl_compras SET  	id_estado_compras 	= 2  WHERE id_compra ='$idingreso'"; // 2 es anulado
		$datos = $conn->query($sql);

	
			// Obtener los detalles de la compra que se va a anular
			$sql_detalle = "SELECT id_producto, cantidad_compra FROM tbl_detall_compra WHERE id_compra = '$idingreso'";
			$resultado_detalle = $conn->query($sql_detalle);

			// Almacenar los detalles de la compra en un array
			$detalles_compra = array();
			while ($fila_detalle = $resultado_detalle->fetch_assoc()) {
			$id_producto = $fila_detalle['id_producto'];
			$cantidad_compra = $fila_detalle['cantidad_compra'];
			$detalles_compra[] = array('id_producto' => $id_producto, 'cantidad_compra' => $cantidad_compra);
			}

			// Restar la cantidad comprada del inventario para cada producto en los detalles de compra
			foreach ($detalles_compra as $detalle) {
			$id_producto = $detalle['id_producto'];
			$cantidad_compra = $detalle['cantidad_compra'];

			// Obtener la cantidad actual en el inventario
			$sql_inventario = "SELECT cantidad FROM tbl_inventario WHERE id_producto = '$id_producto'";
			$resultado_inventario = $conn->query($sql_inventario);
			$fila_inventario = $resultado_inventario->fetch_assoc();
			$cantidad_actual = $fila_inventario['cantidad'];

			// Actualizar la cantidad en el inventario
			$cantidad_nueva = $cantidad_actual - $cantidad_compra;
			$sql_actualizar_inventario = "UPDATE tbl_inventario SET cantidad = '$cantidad_nueva' WHERE id_producto = '$id_producto'";
			$resultado_actualizar_inventario = $conn->query($sql_actualizar_inventario);

			$tipo_movimiento = 4;
				$fecha = date("Y-m-d H:i:s");
				$sql_movimiento_inventario = "INSERT INTO tbl_mov_inventario (id_producto,id_usuario , cantidad_mov, id_tipo_mov_invt 	, fecha_mov , 	comentario 	) VALUES ('$id_producto',$id_usuario, '$cantidad_compra', '$tipo_movimiento', '$fecha','Compra Anulada')";
				$resultado_movimiento_inventario = $conn->query($sql_movimiento_inventario);


			}

 		echo $datos ? "Compra anulada" : "Compra no se puede anular";
	}
	break;

	case 'mostrar':
		$sql = "SELECT i.id_compra, DATE(i.fecha_compra) as fecha, i.id_proveedor, p.nombre_proveedor as proveedor, u.id_usuario, u.nombre_usuario as usuario, i.id_compra, i.total_compra, i.id_estado_compras, ec.nombre_estad_compra, cc.nombre, i.id_comprobante
        FROM tbl_compras i 
        INNER JOIN tbl_proveedores p ON i.id_proveedor=p.id_proveedor 
        INNER JOIN tbl_ms_usuario u ON i.id_usuario=u.id_usuario 
        INNER JOIN tbl_estado_compras ec ON i.id_estado_compras=ec.id_estado_compras
        INNER JOIN tbl_comprobantes_compra cc ON i.id_comprobante = cc.id_comprobante
        WHERE i.id_compra='$idingreso'";

		
		$datos = $conn->query($sql);
		$fila = $datos->fetch_assoc();
		echo json_encode($fila);
		break;
	

	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];
		$total=0;
		$contador =0;

		$sql="SELECT di.id_compra,di.id_producto,a.nombre_producto,di.cantidad_compra,di.precio_costo FROM tbl_detall_compra di inner join tbl_producto a on di.id_producto=a.id_producto where di.id_compra='$id'";
	
		$rspta = $conn->query($sql);
		
		echo '<thead style="background-color: rgba(255, 102, 0, 0.91);">
                                    <th>Nª</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Compra</th>
									<th>ISV</th>
                                    <th>Subtotal</th>
									
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td>'.$contador + 1 .'</td><td>'.$reg->nombre_producto.'</td><td style="width: 100px;" >'.$reg->cantidad_compra.'</td><td style="width: 50px;">'.$reg->precio_costo.'</td><td>'.$reg->precio_costo *0.15.'</td><td>'.$reg->precio_costo*$reg->cantidad_compra.'</td></tr>';
					$total=$total+(($reg->precio_costo *0.15 + $reg->precio_costo)*$reg->cantidad_compra) ;
				
				
					$contador +=1;
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
		 $btndetalle = '';
         $btnDelete = '';
         $sentencia = "SELECT tbl_compras.*, tbl_proveedores.nombre_proveedor, tbl_estado_compras.nombre_estad_compra
		 FROM tbl_compras
		 INNER JOIN tbl_proveedores ON tbl_compras.id_proveedor = tbl_proveedores.id_proveedor
		 INNER JOIN tbl_estado_compras ON tbl_compras.id_estado_compras = tbl_estado_compras.id_estado_compras";
         $datos = $conn->query($sentencia);
     
         // Crear una matriz para almacenar los datos de la tabla
         $data = array();
		 $result = "";
         // Recorrer los resultados de la consulta y agregarlos a la matriz de datos<box-icon type='solid' name='file-pdf'></box-icon>
         
         while ($row = $datos->fetch_assoc()) {
			$btndetalle = "<button type='button' style='color: blue; background-color: #fff; border-color: #fff;' class='btn btn-primary btn-sm link_edit' onclick='detalleM(" . $row['id_compra'] . ")'>
    <span class='fas fa-file-pdf'></span>
</button>";

$btnEdit = "<button type='button' style='color: green; background-color: #fff; border-color: #fff;' class='btn btn-primary btn-sm link_edit' data-toggle='modal' data-target='#myModal' onclick='mostrar(" . $row['id_compra'] . ")'><i class='bx bx-edit'></i></button>"; 
$btnDelete = "<button type='button' class='btn btn-primary btn-sm link_delete' style='color: red; background-color: #fff; border-color: #fff;' onclick='anular(" . $row['id_compra'] . ")'>
<i class='fa-solid fa-ban'></i>
</button>";

          
			 $data[] = array(
				"id_compra" => $row['id_compra'],
				"nombre_proveedor" => $row['nombre_proveedor'],
				"fecha_compra" => $row['fecha_compra'],
				"total_compra" => $row['total_compra'],
				"nombre_estad_compra" => $row['nombre_estad_compra'], // corrected key name
				"options" => $btnEdit . " " . $btnDelete." ".	$btndetalle
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
				echo '<option value=' . $reg->id_proveedor. '>' . $reg->nombre_proveedor." --- ".$reg->rtn_proveedor. '</option>';
				}
             
	break;
	case 'selectComprobante':
        include_once "../php/conexion2.php";
         $btnView = '';
         $btnEdit = '';
         $btnDelete = '';
         $sentencia = "SELECT * FROM tbl_comprobantes_compra where estado ='Activo' ";
         $datos = $conn->query($sentencia);
         
    
		while ($reg = $datos->fetch_object())
				{
				echo '<option value=' . $reg->id_comprobante. '>' . $reg->nombre.'</option>';
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
		$sentencia = "SELECT tbl_producto.*, tbl_categoria.nombre_categoria, tbl_inventario.cantidad 
		FROM tbl_producto 
		INNER JOIN tbl_categoria ON tbl_producto.id_categoria = tbl_categoria.id_categoria 
		INNER JOIN tbl_inventario ON tbl_producto.id_producto = tbl_inventario.id_producto;
		";
	$datos = $conn->query($sentencia);
	
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$datos->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_producto.',\''.$reg->nombre_producto.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->nombre_producto,
 				"2"=>$reg->nombre_categoria ,
 			
 				"3"=>$reg->cantidad
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