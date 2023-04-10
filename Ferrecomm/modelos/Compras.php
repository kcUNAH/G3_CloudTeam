<?php 
//Incluímos inicialmente la conexión a la base de datos


Class Compras
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	public function listarcompras(){
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
			$btnEdit = "<button type='button' class='btn btn-primary btn-sm' onclick='editCompras(" . $row['id_compra'] . ")'><i class='bx bx-edit'></i>SS</button>";
			$btnDelete = "<button type='button' class='btn btn-danger btn-sm' onclick='anular(" . $row['id_compra'] . ")'>Eliminar</button>";
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
	
		die();
	}


	//Implementamos un método para insertar registros
	public function insertar($idproveedor,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_compra,$idarticulo,$cantidad,$precio_compra,$precio_venta)
	{
		$sql="INSERT INTO ingreso (idproveedor,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_compra,estado)
		VALUES ('$idproveedor','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_compra','Aceptado')";
		//return ejecutarConsulta($sql);
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_ingreso(idingreso, idarticulo,cantidad,precio_compra,precio_venta) VALUES ('$idingresonew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_compra[$num_elementos]','$precio_venta[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	
	//Implementamos un método para anular categorías
	public function anular($idingreso)
	{
		$sql="UPDATE ingreso SET estado='Anulado' WHERE idingreso='$idingreso'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idingreso)
	{
		$sql="SELECT i.idingreso,DATE(i.fecha_hora) as fecha,i.idproveedor,p.nombre as proveedor,u.idusuario,u.nombre as usuario,i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado FROM ingreso i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE i.idingreso='$idingreso'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idingreso)
	{
		$sql="SELECT di.idingreso,di.idarticulo,a.nombre,di.cantidad,di.precio_compra,di.precio_venta FROM detalle_ingreso di inner join articulo a on di.idarticulo=a.idarticulo where di.idingreso='$idingreso'";
		return ejecutarConsulta($sql);
	}
	public function listarActivos()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function listar()
	{
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
			$btnEdit = "<button type='button' class='btn btn-primary btn-sm' onclick='editCompras(" . $row['id_compra'] . ")'><i class='bx bx-edit'></i></button>";
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
	
		die();	

		
	}
	
}

?>