<?php

session_start();
if (!isset($_SESSION['usuario'])) {
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

# Incluyendo librerias necesarias #
require "./code128.php";
require_once '../php/conexion.php';
$pdf = new PDF_Code128('P', 'mm', 'Letter');
$pdf->SetMargins(17, 17, 17);
$pdf->AddPage();
$id = $_GET['f'];
$idcliente = $_GET['cl'];
# Logo de la empresa formato png #
$pdf->Image('./img/logo.png', 165, 12, 35, 35, 'PNG');

// extraer nombre_empresa 
$query_nombre = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'NOMBRE_EMPRESA' ");
$fila_nombre = mysqli_fetch_array($query_nombre);
$nombre_negocio = $fila_nombre['valor'];

$query_nombre = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'DIRECCION_EMPRESA' ");
$fila_nombre = mysqli_fetch_array($query_nombre);
$direccion_negocio = $fila_nombre['valor'];

// extraer telefono
$query_telefono = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'NUMERO_EMPRESA' ");
$fila_telefono = mysqli_fetch_array($query_telefono);
$telefono_negocio = $fila_telefono['valor'];

// extraer correo
$query_correo = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'CORREO_EMPRESA' ");
$fila_correo = mysqli_fetch_array($query_correo);
$correo_negocio = $fila_correo['valor'];

//preguntar el id_usuario de la factura
$sql = mysqli_query($conexion, "select id_usuario from tbl_venta where id_venta=$id");
$row = mysqli_fetch_array($sql);
$id_usuario = $row[0]; //Guardamos el id_usuario de la factura

//extraer estado de la venta 
$sql = mysqli_query($conexion, "select id_estado_venta  from tbl_venta where id_venta=$id");
$row = mysqli_fetch_array($sql);
$id_estado = $row[0]; //Guardamos el estado de venta




//extraer tipo de la venta 
$sql = mysqli_query($conexion, "select id_tip_venta  from tbl_venta where id_venta=$id");
$row = mysqli_fetch_array($sql);
$id_tipo_venta = $row[0]; //Guardamos el estado de venta

//extraer pago de la venta 
$sql = mysqli_query($conexion, "select id_pago  from tbl_venta where id_venta=$id");
$row = mysqli_fetch_array($sql);
$id_pago = $row[0]; //Guardamos el estado de venta

if($id_pago == null){
	$id_pago = 1; 
}

//extraer pago de la venta 
$sql = mysqli_query($conexion, "select nombre_forma_pago  from tbl_forma_pago where id_pago =$id_pago");
$row = mysqli_fetch_array($sql);
$pago = $row[0]; //Guardamos el pago de venta



//extraer tip_venta  de la venta 
$sql = mysqli_query($conexion, "select id_tip_venta  from tbl_venta where id_venta=$id");
$row = mysqli_fetch_array($sql);
$id_tipo_venta = $row[0]; //Guardamos el estado de venta

if($id_tipo_venta == null){
	$id_tipo_venta = 1; 
}

//extraer tipo venta  de la venta 
$sql = mysqli_query($conexion, "select nombre_tip_venta  from tbl_tipo_venta where id_tip_venta  =$id_tipo_venta");
$row = mysqli_fetch_array($sql);
$tipo_venta = $row[0]; //Guardamos el tipo venta de venta



//extraer tipo venta  de la venta 
$sql = mysqli_query($conexion, "select id_descuentos  from tbl_venta_descuento where id_venta =$id");
$row = mysqli_fetch_array($sql);
$id_descuento = $row['0']; //Guardamos el tipo venta de venta

if($id_descuento == null){
	$id_descuento = 1;
}

$sql = mysqli_query($conexion, "select porcentaje_descontar  from tbl_descuentos where id_descuentos=$id_descuento");
$row = mysqli_fetch_array($sql);
$descuento = $row['porcentaje_descontar']; //Guardamos el tipo venta de venta






//extrar nombre de usuario 
$sql = mysqli_query($conexion, "select nombre_usuario from tbl_ms_usuario where id_usuario=$id_usuario");
$row = mysqli_fetch_array($sql);
$nombre = $row[0]; //Guardamos el nombre del usuario 

//preguntar la fecha de la factura
$sql2 = mysqli_query($conexion, "select fecha_venta from tbl_venta where id_venta=$id");
$row2 = mysqli_fetch_assoc($sql2);
$fecha = $row2['fecha_venta']; //Guardamos la fecha de la factura

$clientes = mysqli_query($conexion, "SELECT id_cliente, dni_cliente, nombre_cliente, telefono_cliente, direccion_cliente FROM tbl_clientes WHERE id_cliente = $idcliente");
$datosC = mysqli_fetch_assoc($clientes);
$ventas = mysqli_query($conexion, "SELECT d.id_venta, d.id_producto, d.cantidad, d.precio_venta, f.total, p.id_producto, p.nombre_producto, f.fecha_venta 
                                    FROM tbl_producto p  INNER JOIN tbl_venta_detalle d  ON p.id_producto=d.id_producto INNER JOIN tbl_venta f 
                                    ON d.id_venta=f.id_venta WHERE f.fecha_venta='$fecha' and d.id_venta=$id");

$ventas2 = mysqli_query($conexion, "SELECT m.cantidad, m.precio_venta, p.nombre_promocion
									FROM tbl_venta_promocion m 
									INNER JOIN tbl_promociones p
									ON m.id_promocion = p.id_promocion
									WHERE  m.id_venta=$id");





# Encabezado y datos de la empresa #
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(245, 100, 0);
$pdf->Cell(150, 10, utf8_decode(strtoupper($nombre_negocio)), 0, 0, 'L');

$pdf->Ln(9);

$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(39, 39, 51);

$pdf->Ln(5);

$pdf->Cell(150, 9, utf8_decode("Direccion: $direccion_negocio"), 0, 0, 'L');

$pdf->Ln(5);

$pdf->Cell(150, 9, utf8_decode("Teléfono: $telefono_negocio"), 0, 0, 'L');

$pdf->Ln(5);

$pdf->Cell(150, 9, utf8_decode("Correo Electronico: $correo_negocio"), 0, 0, 'L');

$pdf->Ln(10);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 7, utf8_decode("Fecha de emisión:"), 0, 0);
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(116, 7, utf8_decode(date("d/m/Y", strtotime($fecha)) . " " . date("h:s A", strtotime($fecha))), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(35, 7, utf8_decode(strtoupper("Factura No. $id")), 0, 0, 'C');
if($id_estado == 2){
	$pdf->Image('./img/anulado.png', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
}


$pdf->Ln(7);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(12, 7, utf8_decode("Pago:"), 0, 0, 'L');
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(134, 7, utf8_decode($pago), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(97, 97, 97);

$pdf->Ln(10);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(13, 7, utf8_decode("tipo:"), 0, 0);
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(60, 7, utf8_decode($tipo_venta), 0, 0, 'L');
$pdf->Ln(7);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(12, 7, utf8_decode("Cajero:"), 0, 0, 'L');
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(134, 7, utf8_decode($nombre), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(97, 97, 97);


$pdf->Ln(10);
$DNI_CLIETE = $datosC['dni_cliente'];
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(13, 7, utf8_decode("Cliente:"), 0, 0);
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(60, 7, utf8_decode($datosC['nombre_cliente']), 0, 0, 'L');
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(8, 7, utf8_decode("DNI: "), 0, 0, 'L');
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(60, 7, utf8_decode("$DNI_CLIETE"), 0, 0, 'L');
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(7, 7, utf8_decode("Tel:"), 0, 0, 'L');
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(35, 7, utf8_decode($datosC['telefono_cliente']), 0, 0);
$pdf->SetTextColor(39, 39, 51);

$pdf->Ln(7);

$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 7, utf8_decode("Direccion:"), 0, 0);
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(134, 7, utf8_decode($datosC['direccion_cliente']), 0, 0);

$pdf->Ln(9);

# Tabla de productos #
$pdf->SetFont('Arial', '', 8);
$pdf->SetFillColor(245, 100, 0);
$pdf->SetDrawColor(245, 100, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(90, 8, utf8_decode("Descripción"), 1, 0, 'C', true);
$pdf->Cell(15, 8, utf8_decode("Cantidad"), 1, 0, 'C', true);
$pdf->Cell(25, 8, utf8_decode("Precio"), 1, 0, 'C', true);
$pdf->Cell(19, 8, utf8_decode("Descuento"), 1, 0, 'C', true);
$pdf->Cell(32, 8, utf8_decode("Subtotal"), 1, 0, 'C', true);

$pdf->Ln(8);


$pdf->SetTextColor(39, 39, 51);



/*----------  Detalles de la tabla  ----------*/
$total = 0.00;
while ($row = mysqli_fetch_assoc($ventas)) {
	$pdf->Cell(90, 7, utf8_decode($row['nombre_producto']), 'L', 0, 'C');
	$pdf->Cell(15, 7, utf8_decode($row['cantidad']), 'L', 0, 'C');
	$pdf->Cell(25, 7, utf8_decode($row['precio_venta']), 'L', 0, 'C');
	$sub_total = ($row['cantidad'] * $row['precio_venta']); 
	$descuento_producto = (($sub_total/100)*$descuento);
	$pdf->Cell(19, 7, number_format($descuento_producto, 2, '.', ','), 'L', 0, 'C');
	$sub_total = ($row['cantidad'] * $row['precio_venta']);
	$total = $total + $sub_total;
	$pdf->Cell(32, 7,  number_format($sub_total, 2, '.', ','), 'LR', 0, 'C');
    
	$pdf->Ln(7);
}

$totalpromocion = 0.00;
while ($row = mysqli_fetch_assoc($ventas2)) {
	$pdf->Cell(90, 7, utf8_decode($row['nombre_promocion']), 'L', 0, 'C');
	$pdf->Cell(15, 7, utf8_decode($row['cantidad']), 'L', 0, 'C');
	$pdf->Cell(25, 7, utf8_decode($row['precio_venta']), 'L', 0, 'C');
	$sub_total_promociones = ($row['cantidad'] * $row['precio_venta']); 
	$descuento_promociones = (($sub_total_promociones/100)*$descuento);
	$pdf->Cell(19, 7, number_format($descuento_promociones, 2, '.', ','), 'L', 0, 'C');
	//$sub_total_promociones = ($row['cantidad'] * $row['precio_venta']);
	$totalpromocion = $totalpromocion + $sub_total_promociones;
	$pdf->Cell(32, 7,  number_format($sub_total_promociones, 2, '.', ','), 'LR', 0, 'C');
	$pdf->Ln(7);
}


$sql3=mysqli_query($conexion, "SELECT subtotal from tbl_venta where id_venta = $id");
$row3=mysqli_fetch_assoc($sql3);
$subtotal=$row3['subtotal'];

$sql3=mysqli_query($conexion, "SELECT isv from tbl_venta where id_venta = $id");
$row3=mysqli_fetch_assoc($sql3);
$ISV=$row3['isv'];

$descuento_promo = (($totalpromocion/100)*$descuento);

$impuesto_promo = (($totalpromocion/100)*15);
$impuestofinal= $ISV+$impuesto_promo;
$descuento_aplicado = (($total / 100)*$descuento);
$subtotalpromocion = $totalpromocion - $impuesto_promo;

$descuentotal= $descuento_promo +$descuento_aplicado;
$subtotal_final=($subtotal+$totalpromocion-$impuesto_promo);
$total_final=$subtotal+$subtotalpromocion+$impuestofinal-$descuentotal;


/*----------  Fin Detalles de la tabla  ----------*/

$pdf->SetFont('Arial', 'B', 9);

# Impuestos & totales #
$pdf->Cell(100, 7, utf8_decode(''), 'T', 0, 'C');
$pdf->Cell(15, 7, utf8_decode(''), 'T', 0, 'C');
$pdf->Cell(32, 7, utf8_decode("SUBTOTAL"), 'T', 0, 'C');
$pdf->Cell(34, 7, number_format($subtotal_final, 2, '.', ','), 'T', 0, 'C');

$pdf->Ln(7);

$pdf->Cell(100, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(15, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(32, 7, utf8_decode("ISV (15%)"), '', 0, 'C');
$pdf->Cell(34, 7, number_format($impuestofinal, 2, '.', ','), '', 0, 'C');

$pdf->Ln(7);

$pdf->Cell(100, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(15, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(32, 7, utf8_decode("DESCUENTO ($descuento %) : "), '', 0, 'C');
$pdf->Cell(34, 7, number_format($descuentotal, 2, '.', ','), '', 0, 'C');

$pdf->Ln(7);

$pdf->Cell(100, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(15, 7, utf8_decode(''), '', 0, 'C');


$pdf->Cell(32, 7, utf8_decode("TOTAL A PAGAR"), 'T', 0, 'C');
$pdf->Cell(34, 7,  number_format($total_final, 2, '.', ','), 'T', 0, 'C');


$pdf->Ln(7);

$pdf->Cell(100, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(15, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(32, 7, utf8_decode("USTED AHORRA"), '', 0, 'C');
$pdf->Cell(34, 7, utf8_decode("$descuentotal LPS."), '', 0, 'C');

$pdf->Ln(12);

$pdf->SetFont('Arial', '', 9);

$pdf->SetTextColor(39, 39, 51);
$pdf->MultiCell(0, 9, utf8_decode("*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar esta factura ***"), 0, 'C', false);

date_default_timezone_set('America/tegucigalpa');
$fecha = date('Y-m-d g:i a');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 7, utf8_decode("Fecha impresion:"), 0, 0);
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(116, 7, utf8_decode(date("d/m/Y", strtotime($fecha)) . " " . date("g:i a", strtotime($fecha))), 0, 0, 'L');

$pdf->Ln(9);


# Nombre del archivo PDF #
$pdf->Output('factura_' . $id . '.pdf', "I");
