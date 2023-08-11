<?php

require('./fpdf.php');
$id_compra=($_GET['buscador']); // reemplaza "valor_a_buscar" con el valor que quieras buscar
class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
 //include '../php/conexion.php';//llamamos a la conexion BD
 include '../php/conexion.php';//llamamos a la conexion BD
 $consulta_info = $conexion->query(" SELECT valor FROM tbl_ms_parametros where id_parametro = '9' ");
 $dato_info = $consulta_info->fetch_object();
 $this->Image('Logo.jpeg', 220, 5, 70); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
 $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
 $this->Cell(83); // Movernos a la derecha
 $this->SetTextColor(0, 0, 0); //color
 //creamos una celda o fila
 $this->Cell(110, 15, utf8_decode($dato_info->valor), 0, 0, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
 $this->Ln(3); // Salto de línea
 $this->SetTextColor(103); //color
 //$consulta_info = $conexion->query(" SELECT * FROM tbl_producto ");//traemos datos de la empresa desde BD
 //$dato_info = $consulta_info->fetch_object();
 $this->Image('Logo.jpeg', 220, 5, 70); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
 $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
 $this->Cell(83); // Movernos a la derecha
 $this->SetTextColor(0, 0, 0); //color
 //creamos una celda o fila
 $this->Cell(110, 15, utf8_decode(''), 0, 0, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
 $this->Ln(3); // Salto de línea
 $this->SetTextColor(103); //color

  /* UBICACION */
  $consulta_info = $conexion->query(" SELECT valor FROM tbl_ms_parametros where id_parametro = '5' ");
  $ubi_info = $consulta_info->fetch_object();
  $this->Cell(10);  // mover a la derecha
  $this->SetFont('Arial', 'B', 10);
  $this->Cell(96, 10, utf8_decode("Ubicación: ".$ubi_info->valor), 0, 0, '', 0);
  $this->Ln(5);

  /* TELEFONO */
  $consulta_info = $conexion->query(" SELECT valor FROM tbl_ms_parametros where id_parametro = '4' ");
  $tel_info = $consulta_info->fetch_object();
  $this->Cell(10);  // mover a la derecha
  $this->SetFont('Arial', 'B', 10);
  $this->Cell(59, 10, utf8_decode("Teléfono: ".$tel_info->valor ), 0, 0, '', 0);
  $this->Ln(5);

  /* COREEO */
  $consulta_info = $conexion->query(" SELECT valor FROM tbl_ms_parametros where id_parametro = '3' ");
  $correo_info = $consulta_info->fetch_object();
  $this->Cell(10);  // mover a la derecha
  $this->SetFont('Arial', 'B', 10);
  $this->Cell(85, 10, utf8_decode("Correo: " .$correo_info->valor), 0, 0, '', 0);
  $this->Ln(5);

  /* SUCURSAL */
  $consulta_info = $conexion->query(" SELECT valor FROM tbl_ms_parametros where id_parametro = '10' ");
  $suc_info = $consulta_info->fetch_object();
  $this->Cell(10);  // mover a la derecha
  $this->SetFont('Arial', 'B', 10);
  $this->Cell(85, 10, utf8_decode("Sucursal: ".$suc_info->valor), 0, 0, '', 0);
  $this->Ln(7);

  date_default_timezone_set('America/Tegucigalpa');
  $fecha_modificacion =date("Y-m-d H:i:s");

  /* HORA */
  $this->Cell(10);  // mover a la derecha
  $this->SetFont('Arial', 'B', 10);
  $this->Cell(190,6,utf8_decode("Fecha y Hora impresión: " .$fecha_modificacion),0);
  $this->Ln(5);

  
  $id_compra=($_GET['buscador']); // reemplaza "valor_a_buscar" con el valor que quieras buscar
      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(90); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode('DETALLE DE COMPRA #'.$id_compra ), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
 
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../php/conexion.php';

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde


function dep($data)
{
    $format  = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}
//dep($_GET['buscador']);
//die();
$id_compra=($_GET['buscador']); // reemplaza "valor_a_buscar" con el valor que quieras buscar

// Agregar encabezado de la tabla


$pdf->Cell(40, 10, utf8_decode('#'), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode('ID Producto'), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode('Nombre Producto'), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode('Cantidad'), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode('Precio Unitario'), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode('Subtotal'), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode('ISV'), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode('Total'), 1, 1, 'C', 0);

// Obtener y mostrar los detalles de la compra actual
$consulta_detalle_compra = $conexion->query("
  SELECT d.id_producto, p.nombre_producto, d.cantidad_compra, d.precio_costo, 
  d.cantidad_compra * d.precio_costo AS subtotal,
  (d.cantidad_compra * d.precio_costo * 15) / 100 AS isv,
  (d.cantidad_compra * d.precio_costo) + ((d.cantidad_compra * d.precio_costo * 15) / 100) AS total
  FROM tbl_detall_compra d 
  INNER JOIN tbl_producto p ON d.id_producto = p.id_producto 
  WHERE d.id_compra = " . $id_compra . "
  ORDER BY d.id_detall_compra
");

$total_subtotal = 0;
$total_isv = 0;
$total_total = 0;

while ($datos_detalle = $consulta_detalle_compra->fetch_object()) {

  $pdf->Cell(40, 10, utf8_decode($datos_detalle->id_producto), 1, 0, 'C', 0);
  $pdf->Cell(40, 10, utf8_decode($datos_detalle->nombre_producto), 1, 0, 'C', 0);
  $pdf->Cell(40, 10, utf8_decode($datos_detalle->cantidad_compra), 1, 0, 'C', 0);
  $pdf->Cell(40, 10, utf8_decode(number_format($datos_detalle->precio_costo, 2)), 1, 0, 'C', 0);
  $pdf->Cell(40, 10, utf8_decode(number_format($datos_detalle->subtotal, 2)), 1, 0, 'C', 0);
  $pdf->Cell(40, 10, utf8_decode(number_format($datos_detalle->isv, 2)), 1, 0, 'C', 0);
  $pdf->Cell(40, 10, utf8_decode(number_format($datos_detalle->total, 2)), 1, 1, 'C', 0);

  $total_subtotal += $datos_detalle->subtotal;
  $total_isv += $datos_detalle->isv;
  $total_total += $datos_detalle->total;
}

$pdf->Cell(160, 10, utf8_decode('Total:'), 1, 0, 'R', 0);
$pdf->Cell(40, 10, utf8_decode(number_format($total_subtotal, 2)), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode(number_format($total_isv, 2)), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode(number_format($total_total, 2)), 1, 1, 'C', 0);

$pdf->Ln();

$pdf->Output('ReporteCompras.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
