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
?>


<?php

require('./fpdf.php');

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
       /* TITULO DE LA TABLA */
       //color
       $this->SetTextColor(228, 100, 0);
       $this->Cell(90); // mover a la derecha
       $this->SetFont('Arial', 'B', 15);
       $this->Cell(100, 10, utf8_decode("REPORTE DE COMPRAS "), 0, 1, 'C', 0);
       $this->Ln(7);
 

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(50,10, utf8_decode('#'), 1, 0, 'C', 1);
      $this->Cell(75,10, utf8_decode('Proveedor'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
     // $this->Cell(40, 10, utf8_decode('Descripcion'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Total'), 1, 0, 'C', 1);
      //$this->Cell(30, 10, utf8_decode('Imagen'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Estado'), 1, 1, 'C', 1);
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
include '../php/bitacora.php';

$codigoObjeto=7;
$accion='Generó reporte';
$descripcion= 'El usuario generó un reporte de compras';
bitacora($codigoObjeto, $accion,$descripcion);

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
$valor_buscar=($_GET['buscador']); // reemplaza "valor_a_buscar" con el valor que quieras buscar

$consulta_reporte_producto = $conexion->query("
  SELECT c.id_compra, p.nombre_proveedor, c.fecha_compra, c.total_compra, e.nombre_estad_compra
  FROM tbl_compras c 
  INNER JOIN tbl_proveedores p ON c.id_proveedor = p.id_proveedor 
  INNER JOIN tbl_estado_compras e ON c.id_estado_compras = e.id_estado_compras
  WHERE c.id_compra LIKE '%$valor_buscar%' 
     OR p.nombre_proveedor LIKE '%$valor_buscar%' 
     OR c.fecha_compra LIKE '%$valor_buscar%' 
     OR c.total_compra LIKE '%$valor_buscar%' 
     OR e.nombre_estad_compra LIKE '%$valor_buscar%'
  ORDER BY c.fecha_compra DESC
");
$contador = 1;
// AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)

while ($datos_reporte = $consulta_reporte_producto->fetch_object()) {  
    $pdf->Cell(50, 10, utf8_decode($contador), 1, 0, 'C', 0);
$pdf->Cell(75, 10, utf8_decode($datos_reporte->nombre_proveedor), 1, 0, 'C', 0);
$pdf->Cell(50, 10, utf8_decode($datos_reporte->fecha_compra), 1, 0, 'C', 0);
$pdf->Cell(50, 10, utf8_decode($datos_reporte->total_compra), 1, 0, 'C', 0);
$pdf->Cell(50, 10, utf8_decode($datos_reporte->nombre_estad_compra), 1, 1, 'C', 0);
$contador +=1 ;
   }
$i = $i + 1;
/* TABLA */



$pdf->Output('ReporteCompras.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
