<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      //include '../php/conexion.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" SELECT * FROM tbl_producto ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('Logo.jpeg', 220, 5, 70); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(83); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('FERRECOMM'), 0, 0, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : Los Planes Santa Maria, Carretera CA-7 "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : 9825-5333 "), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : cloudteamg3@gmail.com "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Sucursal : 1 "), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(90); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("Reporte Historial de Inventario "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(70,10, utf8_decode('Producto'), 1, 0, 'C', 1);
      $this->Cell(70, 10, utf8_decode('Usuario'), 1, 0, 'C', 1);
     // $this->Cell(40, 10, utf8_decode('Descripcion'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Cantidad en Movimiento'), 1, 0, 'C', 1);
      //$this->Cell(30, 10, utf8_decode('Imagen'), 1, 0, 'C', 1);
     // $this->Cell(40, 10, utf8_decode('Cantidad Minima'), 1, 0, 'C', 1);
      $this->Cell(45, 10, utf8_decode('Tipo de Movimiento'), 1, 0, 'C', 1);
      $this->Cell(45, 10, utf8_decode('Fecha de Movimiento'), 1, 1, 'C', 1);
     // $this->Cell(60, 10, utf8_decode('Comentario'), 1, 1, 'C', 1);
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



      
$busqueda = strtolower($_GET['buscar']);


$query = mysqli_query($conexion, "SELECT m.id_mov_invent, p.id_producto,p.nombre_producto, u.id_usuario, u.nombre_usuario, 
            m.cantidad_mov, h.id_tipo_mov_invt, h.movimiento, m.fecha_mov, m.comentario
            FROM tbl_mov_inventario m 
            INNER JOIN tbl_producto p on m.id_producto = p.id_producto 
            INNER JOIN tbl_tipo_mov_invt h on m.id_tipo_mov_invt = h.id_tipo_mov_invt
            INNER JOIN tbl_ms_usuario u on m.id_usuario = u.id_usuario
            WHERE p.id_producto = $busqueda 
            ORDER BY m.id_mov_invent ASC
            ");

// AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)

while ($datos_reporte = $query->fetch_object()) {  
$pdf->Cell(70, 10, utf8_decode($datos_reporte->nombre_producto), 1, 0, 'C', 0);
$pdf->Cell(70, 10, utf8_decode($datos_reporte->nombre_usuario), 1, 0, 'C', 0);
//$pdf->Multicell(20, 7, utf8_decode($datos_reporte->descripcion_producto), 1, 'J', false);
$pdf->Cell(50, 10, utf8_decode($datos_reporte->cantidad_mov), 1, 0, 'C', 0);
//$pdf->Cell(40, 10, utf8_decode($datos_reporte->cantidad_min), 1, 0, 'C', 0);
//$pdf->Cell(40, 10, utf8_decode($datos_reporte->cantidad_max), 1, 0, 'C', 0);
$pdf->Cell(45, 10, utf8_decode($datos_reporte->movimiento), 1, 0, 'C', 0);
$pdf->Cell(45, 10, utf8_decode($datos_reporte->fecha_mov), 1, 1, 'C', 0);
//$pdf->Cell(60, 10, utf8_decode($datos_reporte->comentario), 1, 1, 'C', 0);
   }
$i = $i + 1;
/* TABLA */



$pdf->Output('ReporteHistorialInventario.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
