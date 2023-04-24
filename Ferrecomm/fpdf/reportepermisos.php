<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
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
     $this->Cell(100, 10, utf8_decode("Reporte de parametros "), 0, 1, 'C', 0);
     $this->Ln(7);

           /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(50,10, utf8_decode('Rol'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Objeto Asignado'), 1, 0, 'C', 1);
     // $this->Cell(40, 10, utf8_decode('Descripcion'), 1, 0, 'C', 1);
      $this->Cell(33, 10, utf8_decode('permiso_insercion'), 1, 0, 'C', 1);
      //$this->Cell(30, 10, utf8_decode('Imagen'), 1, 0, 'C', 1);
      $this->Cell(33, 10, utf8_decode('permiso_eliminar'), 1, 0, 'C', 1);
      $this->Cell(33, 10, utf8_decode('permiso_actualizar'), 1, 0, 'C', 1);
      $this->Cell(33, 10, utf8_decode('permiso_consultar'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('creado_por'), 1, 0, 'C', 1);
     
    
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



$consulta_reporte_producto = $conexion->query("SELECT p.id_permisos, r.rol , o.objeto , p.permiso_insercion, p.permiso_eliminacion, p.permiso_actualizacion, p.permiso_consultar, p.creado_por,
p.fecha_creacion, p.modificado_por, p.fecha_modificacion 
FROM tbl_ms_permisos p INNER JOIN tbl_ms_rol r on p.id_rol = r.id_rol INNER JOIN tbl_ms_objetos o on p.id_objeto = o.id_objeto ORDER BY p.id_permisos ASC ");

// AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
while ($datos_reporte = $consulta_reporte_producto->fetch_object()) {  
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->rol), 1, 0, 'C', 0);
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->objeto), 1, 0, 'C', 0);
   $pdf->Cell(33, 10, utf8_decode($datos_reporte->permiso_insercion), 1, 0, 'C', 0);
   $pdf->Cell(33, 10, utf8_decode($datos_reporte->permiso_eliminacion), 1, 0, 'C', 0);
   $pdf->Cell(33, 10, utf8_decode($datos_reporte->permiso_actualizacion), 1, 0, 'C', 0);

   $pdf->Cell(33, 10, utf8_decode($datos_reporte->permiso_consultar), 1, 0, 'C', 0);
   
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->creado_por), 1, 1, 'C', 0);


   // Move down one line
  
}

$i = $i + 1;
/* TABLA */



$pdf->Output('Reportepermisos.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
