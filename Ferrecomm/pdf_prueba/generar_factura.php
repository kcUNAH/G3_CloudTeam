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
//$ventas2 = mysqli_query($conexion, "SELECT d.id_factura, d.id_promocion, d.cantidad, d.precio, d.total, m.id_promocion, m.descripcion, f.FECHA FROM tbl_promocion m INNER JOIN tbl_factura_detalle d ON m.id_promocion=d.id_promocion INNER JOIN tbl_factura f ON d.id_factura=f.id_factura WHERE f.fecha='$fecha' and d.id_factura=$id");





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
	$pdf->Cell(19, 7, utf8_decode("$0.00 USD"), 'L', 0, 'C');
	$sub_total = ($row['cantidad'] * $row['precio_venta']);
	$total = $total + $sub_total;
	$pdf->Cell(32, 7,  number_format($sub_total, 2, '.', ','), 'LR', 0, 'C');
    
	$pdf->Ln(7);
}


$sql3=mysqli_query($conexion, "SELECT subtotal from tbl_venta where id_venta = $id");
$row3=mysqli_fetch_assoc($sql3);
$subtotal=$row3['subtotal'];

$sql3=mysqli_query($conexion, "SELECT isv from tbl_venta where id_venta = $id");
$row3=mysqli_fetch_assoc($sql3);
$ISV=$row3['isv'];

$total_final=$subtotal+$ISV;


/*----------  Fin Detalles de la tabla  ----------*/

$pdf->SetFont('Arial', 'B', 9);

# Impuestos & totales #
$pdf->Cell(100, 7, utf8_decode(''), 'T', 0, 'C');
$pdf->Cell(15, 7, utf8_decode(''), 'T', 0, 'C');
$pdf->Cell(32, 7, utf8_decode("SUBTOTAL"), 'T', 0, 'C');
$pdf->Cell(34, 7, number_format($subtotal, 2, '.', ','), 'T', 0, 'C');

$pdf->Ln(7);

$pdf->Cell(100, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(15, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(32, 7, utf8_decode("ISV (15%)"), '', 0, 'C');
$pdf->Cell(34, 7, number_format($ISV, 2, '.', ','), '', 0, 'C');

$pdf->Ln(7);

$pdf->Cell(100, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(15, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(32, 7, utf8_decode("DESCUENTO : "), '', 0, 'C');
$pdf->Cell(34, 7, number_format(0.00, 2, '.', ','), '', 0, 'C');

$pdf->Ln(7);

$pdf->Cell(100, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(15, 7, utf8_decode(''), '', 0, 'C');


$pdf->Cell(32, 7, utf8_decode("TOTAL A PAGAR"), 'T', 0, 'C');
$pdf->Cell(34, 7,  number_format($total_final, 2, '.', ','), 'T', 0, 'C');


$pdf->Ln(7);

$pdf->Cell(100, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(15, 7, utf8_decode(''), '', 0, 'C');
$pdf->Cell(32, 7, utf8_decode("USTED AHORRA"), '', 0, 'C');
$pdf->Cell(34, 7, utf8_decode("$0.00 USD"), '', 0, 'C');

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
