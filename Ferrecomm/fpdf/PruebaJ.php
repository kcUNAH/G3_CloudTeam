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
      $this->Cell(96, 10, utf8_decode("Ubicación : "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : "), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Sucursal : "), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(90); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("Reporte de productos "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(30,10, utf8_decode('Categoria'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Descripcion'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Precio'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Imagen'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Unidad medida'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Cantidad minima'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Cantidad maxima'), 1, 1, 'C', 1);
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

$consulta_reporte_producto = $conexion->query(" SELECT p.id_producto, c.nombre_categoria, p.nombre_producto, p.descripcion_producto, 
p.precio_producto, p.img_producto, p.unidad_medida, p.cantidad_min, p.cantidad_max 
FROM tbl_producto p INNER JOIN tbl_categoria c on p.id_categoria = c.id_categoria ORDER BY p.id_producto ASC ");

// AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)

while ($datos_reporte = $consulta_reporte_producto->fetch_object()) {  
$pdf->Cell(30, 10, utf8_decode($datos_reporte->nombre_categoria), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode($datos_reporte->nombre_producto), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode($datos_reporte->precio_producto), 1, 0, 'C', 0);
//$pdf->Multicell(20, 7, utf8_decode($datos_reporte->descripcion_producto), 1, 'J', false);
$pdf->Cell(30, 10, utf8_decode($datos_reporte->precio_producto), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode($datos_reporte->precio_producto), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode($datos_reporte->unidad_medida), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode($datos_reporte->cantidad_min), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode($datos_reporte->cantidad_max), 1, 1, 'C', 0);
   }
$i = $i + 1;
/* TABLA */



$pdf->Output('Prueba2.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)


$cellWidth=90;//wrapped cell width
$cellHeight=5;//normal one-line cell height


//check whether the text is overflowing
if($pdf->GetStringWidth($actividad_a_facturar) < $cellWidth){
	//if not, then do nothing
	$line=1;
}else{
	//if it is, then calculate the height needed for wrapped cell
	//by splitting the text to fit the cell width
	//then count how many lines are needed for the text to fit the cell
	
	$textLength=strlen($actividad_a_facturar);	//total text length
	$errMargin=10;		//cell width error margin, just in case
	$startChar=0;		//character start position for each line
	$maxChar=0;			//maximum character in a line, to be incremented later
	//$textArray=array($actividad_a_facturar);	//to hold the strings for each line
	$textArray=array($actividad_a_facturar);
	$tmpString="";		//to hold the string for a line (temporary)
	
	while($startChar < $textLength){ //loop until end of text
		//loop until maximum character reached
		while( 
		$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
		($startChar+$maxChar) < $textLength ) {
			$maxChar++;
			$tmpString=substr($actividad_a_facturar,$startChar,$maxChar);
		}
		//move startChar to next line
		$startChar=$startChar+$maxChar;
		//then add it into the array so we know how many line are needed
		array_push($textArray,$tmpString);
		//reset maxChar and tmpString
		$maxChar=0;
		$tmpString='';
		
	}
	//get number of line
	$line=count($textArray);
}



//write the cells
$pdf->Cell(20,($line * $cellHeight),$fecha_servicio,1,0,'C'); //adapt height to number of lines
$pdf->Cell(20,($line * $cellHeight),$hora_inicio_servicio,1,0,'C'); //adapt height to number of lines

//use MultiCell instead of Cell
//but first, because MultiCell is always treated as line ending, we need to 
//manually set the xy position for the next cell to be next to it.
//remember the x and y position before writing the multicell
$xPos=$pdf->GetX();
$yPos=$pdf->GetY();

$pdf->MultiCell($cellWidth,$cellHeight,utf8_decode($actividad_a_facturar),1);


//return the position for next cell next to the multicell
//and offset the x with multicell width
$pdf->SetXY($xPos + $cellWidth , $yPos);


$pdf->Cell(20,($line * $cellHeight),$hora_final_servicio,1,0,'C');
$pdf->Cell(20,($line * $cellHeight),$horas_observaciones,1,0,'C');
$pdf->Cell(20,($line * $cellHeight),$horas_facturar,1,1,'C'); //adapt height to number of lines