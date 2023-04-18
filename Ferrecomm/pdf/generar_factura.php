<?php
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
require_once '../php/conexion.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 0, 0);
$pdf->SetTitle("Ventas");
$pdf->SetFont('Arial', 'B', 12);
$id = $_GET['f'];
$idcliente = $_GET['cl'];

// extraer nombre_empresa 
$query_nombre = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'NOMBRE_EMPRESA' ");
$fila_nombre = mysqli_fetch_array($query_nombre);
$nombre_negocio = $fila_nombre['valor'];

// extraer telefono
$query_telefono = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'NUMERO_EMPRESA' ");
$fila_telefono = mysqli_fetch_array($query_telefono);
$telefono_negocio = $fila_telefono['valor'];

// extraer correo
$query_correo = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'CORREO_EMPRESA' ");
$fila_correo = mysqli_fetch_array($query_correo);
$correo_negocio = $fila_correo['valor'];

//preguntar el id_usuario de la factura
$sql=mysqli_query($conexion, "select id_usuario from tbl_venta where id_venta=$id"); 
$row=mysqli_fetch_array($sql);
$id_usuario=$row[0]; //Guardamos el id_usuario de la factura

//extrar nombre de usuario 
$sql=mysqli_query($conexion, "select nombre_usuario from tbl_ms_usuario where id_usuario=$id_usuario"); 
$row=mysqli_fetch_array($sql);
$nombre=$row[0]; //Guardamos el nombre del usuario 

//preguntar la fecha de la factura
$sql2=mysqli_query($conexion, "select fecha_venta from tbl_venta where id_venta=$id"); 
$row2=mysqli_fetch_assoc($sql2);
$fecha=$row2['fecha_venta']; //Guardamos la fecha de la factura

$clientes = mysqli_query($conexion, "SELECT id_cliente, dni_cliente, nombre_cliente, telefono_cliente, direccion_cliente FROM tbl_clientes WHERE id_cliente = $idcliente");
$datosC = mysqli_fetch_assoc($clientes);
$ventas = mysqli_query($conexion, "SELECT d.id_venta, d.id_producto, d.cantidad, d.precio_venta, f.total, p.id_producto, p.nombre_producto, f.fecha_venta 
                                    FROM tbl_producto p  INNER JOIN tbl_venta_detalle d  ON p.id_producto=d.id_producto INNER JOIN tbl_venta f 
                                    ON d.id_venta=f.id_venta WHERE f.fecha_venta='$fecha' and d.id_venta=$id");
//$ventas2 = mysqli_query($conexion, "SELECT d.id_factura, d.id_promocion, d.cantidad, d.precio, d.total, m.id_promocion, m.descripcion, f.FECHA FROM tbl_promocion m INNER JOIN tbl_factura_detalle d ON m.id_promocion=d.id_promocion INNER JOIN tbl_factura f ON d.id_factura=f.id_factura WHERE f.fecha='$fecha' and d.id_factura=$id");
$pdf->Image('Logo.jpeg', 220, 5, 70);

$pdf->Cell(65, 5, utf8_decode($nombre_negocio), 0, 1, 'C');
//$pdf->image(".", 53, 15, 22, 22, 'PNG');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, "Fecha: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, utf8_decode($fecha), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, utf8_decode("Num. Fact: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, $id, 0, 1, 'L');


$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, $telefono_negocio, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, "Vendedor: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, utf8_decode($nombre), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, utf8_decode("Email: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, utf8_decode($correo_negocio), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(70, 5, "Datos del cliente", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(30, 5, utf8_decode('Nombre'), 0, 0, 'L');
$pdf->Cell(20, 5, utf8_decode('Teléfono'), 0, 0, 'L');
$pdf->Cell(20, 5, utf8_decode('Identidad'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(30, 5, utf8_decode($datosC['nombre_cliente']), 0, 0, 'L');
$pdf->Cell(20, 5, utf8_decode($datosC['telefono_cliente']), 0, 0, 'L');
$pdf->Cell(20, 5, utf8_decode($datosC['dni_cliente']), 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(70, 5, "Detalle de Producto", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(30, 5, utf8_decode('Descripción'), 0, 0, 'L');
$pdf->Cell(10, 5, 'Cant.', 0, 0, 'L');
$pdf->Cell(15, 5, 'Precio', 0, 0, 'L');
$pdf->Cell(15, 5, 'Total.', 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$total = 0.00;
while ($row = mysqli_fetch_assoc($ventas)) {
    $pdf->Cell(30, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->Cell(15, 5, $row['precio_venta'], 0, 0, 'L');
    $sub_total = ($row['cantidad'] * $row['precio_venta']);
    $total = $total + $sub_total;
    $pdf->Cell(15, 5, number_format($sub_total, 2, '.', ','), 0, 1, 'L');
}
/*while ($row = mysqli_fetch_assoc($ventas2)) {
  $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
    $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
    $sub_total = $row['total'];
    $total = $total + $sub_total;
    $pdf->Cell(15, 5, number_format($sub_total, 2, '.', ','), 0, 1, 'L');

    $Dato = $row['descripcion'];
    $sql2=mysqli_query($conexion, "SELECT ID_PROMOCION from tbl_promocion where DESCRIPCION='$Dato'"); 
    $row2=mysqli_fetch_assoc($sql2);
    $id_prom=$row2['ID_PROMOCION']; //Guardamos la promocion de la factura
    $promociones = mysqli_query($conexion, "SELECT d.id_promocion, d.cantidad , p.id_producto, p.nombre from tbl_producto p INNER JOIN tbl_promocion_producto d ON p.id_producto=d.id_producto where id_promocion=$id_prom");
    $pdf->SetFont('Arial', '', 7);
    while ($row = mysqli_fetch_assoc($promociones)) {
        $pdf->Cell(30, 5, utf8_decode($row['nombre']), 0, 0, 'L');
    //    $pdf->Cell(3, 5, $row['cantidad'], 0, 1, 'R');
  //  }
}*/
$pdf->Ln();

//$sql1=mysqli_query($conexion, "SELECT id_factura from tbl_factura  where id_cliente = $idcliente ");
//$row1=mysqli_fetch_assoc($sql1);
//$id_factura=$row1['id_factura'];

//$sql2=mysqli_query($conexion, "SELECT total_descuento from tbl_factura where id_factura = $id");
//$row2=mysqli_fetch_assoc($sql2);
//$total_descuento=$row2['total_descuento'];

$sql3=mysqli_query($conexion, "SELECT subtotal from tbl_venta where id_venta = $id");
$row3=mysqli_fetch_assoc($sql3);
$subtotal=$row3['subtotal'];

$sql3=mysqli_query($conexion, "SELECT isv from tbl_venta where id_venta = $id");
$row3=mysqli_fetch_assoc($sql3);
$ISV=$row3['isv'];

$total_final=$subtotal+$ISV;

//$sql3=mysqli_query($conexion, "SELECT f.ID_TIPO_PAGO, p.tipo from tbl_factura f INNER JOIN tbl_tipo_pago p ON f.ID_TIPO_PAGO=p.ID_TIPO_PAGO where id_factura = $id");
//$row3=mysqli_fetch_assoc($sql3);
//$id_tipo_pago=$row3['ID_TIPO_PAGO'];
//$tipo_pago=$row3['tipo'];


/*
if($id_tipo_pago==1){
    $sql3=mysqli_query($conexion, "SELECT cambio from tbl_factura where id_factura = $id");
    $row3=mysqli_fetch_assoc($sql3);
    $cambio=$row3['cambio'];

    $sql7=mysqli_query($conexion, "SELECT pago from tbl_factura where id_factura = $id");
    $row7=mysqli_fetch_assoc($sql7);
    $pago=$row7['pago'];

}else{
    $cambio=0;
    
    $sql7=mysqli_query($conexion, "SELECT total from tbl_factura where id_factura = $id");
    $row7=mysqli_fetch_assoc($sql7);
    $pago=$row7['total'];
}*/

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, 'Sub Total:', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 5, number_format($subtotal, 2, '.', ','), 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, 'ISV:', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 5, number_format($ISV, 2, '.', ','), 0, 1, 'R');
//$pdf->SetFont('Arial', '', 10);
//$pdf->Cell(30, 5, 'Descuento Total:', 0, 0, 'L');
//$pdf->SetFont('Arial', '', 10);
//$pdf->Cell(35, 4, number_format($total_descuento, 2, '.', ','), 3, 1, 'R');

$pdf->Cell(70, 0, '', 0, 1, 'R');
$pdf->SetFont('Arial', 'B',6);
$pdf->Cell(70, 3, '___________________', 0, 1, 'R');
$pdf->Cell(70, 2, '', 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 5, 'Total Pagar:', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 5, number_format($total_final, 2, '.', ','), 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
/*
$pdf->Cell(30, 5, 'Pago recibido:', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 5, number_format($pago, 2, '.', ','), 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, 'Cambio:', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 5, number_format($cambio, 2, '.', ','), 0, 1, 'R');

$pdf->Cell(30, 5, 'Tipo de Pago:', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 5,$tipo_pago , 0, 1, 'R');
*/
$pdf->Output('factura_' . $id . '.pdf', "I");


//Guardar la bitacora
//$sesion_usuario=$_SESSION['usuario_login'];
//date_default_timezone_set("America/Tegucigalpa");
//$fecha = date('Y-m-d h:i:s');
//$sql_bitacora=$conexion->query("INSERT INTO tbl_ms_bitacora (fecha_bitacora, accion, descripcion,creado_por) value ( '$fecha', 'Finalizacion de factura', 'Genero factura','$sesion_usuario')");
?>