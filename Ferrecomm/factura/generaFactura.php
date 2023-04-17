<?php
print_r($_REQUEST);
//exit;
//echo base64_encode('2');
//exit;
session_start();
if(!isset ($_SESSION['usuario'])){
    echo '
    <script>
    alert("Por favor, debe iniciar seccion");
    window.location= "index.php";
    </script>
    ';
    //header("localitation: index.php");
    session_destroy();
    die();
}

include "../php/conexion.php";
require_once '../pdf/vendor/autoload.php';
use Dompdf\Dompdf;

if (empty($_REQUEST['cl']) || empty($_REQUEST['f'])) {
	echo "No es posible generar la factura.";
} else {
	$codCliente = $_REQUEST['cl'];
	$noFactura = $_REQUEST['f'];
	$anulada = '';
	$query_config   = mysqli_query($conexion,"SELECT * FROM tbl_ms_parametros");
		$result_config  = mysqli_num_rows($query_config);
		if($result_config > 0){
			$configuracion = mysqli_fetch_assoc($query_config);
		}


	// extraer isv 
	$query_isv = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'IMPUESTO' ");
	$fila_isv = mysqli_fetch_array($query_isv);
	$configuracion_isv = $fila_isv['valor'];
	// extraer nombre_empresa 
	$query_nombre = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'NOMBRE_EMPRESA' ");
	$fila_nombre = mysqli_fetch_array($query_nombre);
	$configuracion_Nombre_Empresa = $fila_nombre['valor'];
	// extraer direccion
	$query_direccion = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'DIRECCION_EMPRESA' ");
	$fila_direccion = mysqli_fetch_array($query_direccion);
	$configuracion_Direccion = $fila_direccion['valor'];
	// extraer telefono
	$query_telefono = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'NUMERO_EMPRESA' ");
	$fila_telefono = mysqli_fetch_array($query_telefono);
	$configuracion_telefono = $fila_telefono['valor'];
	// extraer correo
	$query_correo = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'CORREO_EMPRESA' ");
	$fila_correo = mysqli_fetch_array($query_correo);
	$configuracion_correo = $fila_correo['valor'];





	$query = mysqli_query($conexion, "SELECT f.id_venta, DATE_FORMAT(f.fecha_venta, '%d/%m/%Y') as fecha, DATE_FORMAT(f.fecha_venta,'%H:%i:%s') as  hora, f.id_cliente, f.id_estado_venta,
												 v.nombre_usuario as vendedor,
												 cl.dni_cliente, cl.nombre_cliente, cl.telefono_cliente,cl.direccion_cliente
											FROM tbl_venta f
											INNER JOIN tbl_ms_usuario v
											ON f.id_usuario = v.id_usuario
											INNER JOIN tbl_clientes cl
											ON f.id_cliente = cl.id_cliente
											WHERE f.id_venta = $noFactura AND f.id_cliente = $codCliente");

	$result = mysqli_num_rows($query);
	if ($result > 0) {

		$factura = mysqli_fetch_assoc($query);
		print_r($factura);
		$no_factura = $factura['id_venta'];

		if ($factura['id_estado_venta'] == 2) {
			$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
		}

		$query_productos = mysqli_query($conexion, "SELECT p.nombre_producto,dt.cantidad,dt.precio_venta,(dt.cantidad * dt.precio_venta) as precio_total
														FROM tbl_venta f
														INNER JOIN tbl_venta_detalle dt
														ON f.id_venta = dt.id_venta
														INNER JOIN tbl_producto p
														ON dt.id_producto = p.id_producto
														WHERE f.id_venta = $no_factura ");
		$result_detalle = mysqli_num_rows($query_productos);

		ob_start();
		include(dirname('__FILE__').'/factura_plantilla.php');
		$html = "hola mundo";//ob_get_clean();

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		$dompdf->loadHtml($html);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('letter', 'portrait');
		// Render the HTML as PDF
		ob_clean();
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream('factura_' . $noFactura . '.pdf', array('Attachment' => false));
		exit(0);
	}
}
?>