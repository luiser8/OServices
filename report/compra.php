<?php
session_start();
require './fpdf/fpdf.php';
include '../library/configServer.php';
include '../library/consulSQL.php';
$id=$_GET['id'];
$sVenta=ejecutarSQL::consultar("SELECT * FROM venta WHERE NumPedido='$id'");
$dVenta=mysqli_fetch_array($sVenta, MYSQLI_ASSOC);
$sCliente=ejecutarSQL::consultar("SELECT * FROM cliente WHERE RIF='".$dVenta['RIF']."'");
$dCliente=mysqli_fetch_array($sCliente, MYSQLI_ASSOC);
class PDF extends FPDF{
}
ob_end_clean();
$pdf=new PDF('P','mm','Letter');
// $pdf->AddPage();
// $pdf->SetFont("Times","",20);
// $pdf->SetMargins(25,20,25);
// $pdf->SetFillColor(0,255,255);
// $pdf->Cell (0,5,utf8_decode('STORE'),0,1,'C');
// $pdf->Ln(5);
// $pdf->SetFont("Times","",14);
// $pdf->Cell (0,5,utf8_decode('Factura de pedido numero '.$id),0,1,'C');
// $pdf->Ln(20);

$pdf->Ln(20);
$pdf->AddPage();
$pdf->SetTitle("Recibo");
$pdf->SetXY(120, 15);
$pdf->SetFont('Times','B', 12);
$pdf->Cell( 72, 0, "Factura: N {$id}", 0, 0, 'R');
$pdf->SetFont('Times','B', 12);
$pdf->Image('http://127.0.0.1:1337/OServices/assets/img/logotipo.png',7,10,80);
$pdf->Ln(10);
$pdf->Cell( 190, 0, "Fecha: {$dVenta['Fecha']}", 0, 0, 'R');
$pdf->Ln(20);

$pdf->SetFont("Times","b",12);
$pdf->Cell (33,10,utf8_decode('Fecha del pedido: '),0);
$pdf->SetFont("Times","",12);
$pdf->Cell (37,10,utf8_decode($dVenta['Fecha']),0);
$pdf->Ln();
$pdf->SetFont("Times","b",12);
$pdf->Cell (37,10,utf8_decode('Nombre del cliente: '),0);
$pdf->SetFont("Times","",12);
$pdf->Cell (39,10,utf8_decode($dCliente['NombreCompleto']),0);
$pdf->Ln();
$pdf->SetFont("Times","b",12);
$pdf->Cell (30,10,utf8_decode('Cedula/RIF: '),0);
$pdf->SetFont("Times","",12);
$pdf->Cell (25,10,utf8_decode($dCliente['RIF']),0);
$pdf->Ln();
$pdf->SetFont("Times","b",12);
$pdf->Cell (20,10,utf8_decode('Direccion: '),0);
$pdf->SetFont("Times","",12);
$pdf->Cell (70,10,utf8_decode($dCliente['Direccion']),0);
$pdf->Ln();
$pdf->SetFont("Times","b",12);
$pdf->Cell (19,10,utf8_decode('Telefono: '),0);
$pdf->SetFont("Times","",12);
$pdf->Cell (70,10,utf8_decode($dCliente['Telefono']),0);
$pdf->SetFont("Times","b",12);
$pdf->Ln();
$pdf->Cell (14,10,utf8_decode('Email: '),0);
$pdf->SetFont("Times","",12);
$pdf->Cell (40,10,utf8_decode($dCliente['Email']),0);
$pdf->SetFont("Times","b",12);
// $pdf->Cell (76,10,utf8_decode('Nombre'),1,0,'C');
// $pdf->Cell (76,10,utf8_decode('Presentación'),1,0,'C');
// $pdf->Cell (76,10,utf8_decode('Marca'),1,0,'C');
// $pdf->Cell (30,10,utf8_decode('Precio'),1,0,'C');
// $pdf->Cell (30,10,utf8_decode('Cantidad'),1,0,'C');
// $pdf->Cell (30,10,utf8_decode('Subtotal'),1,0,'C');
$pdf->Ln();
$pdf->SetFont("Times","",12);
$suma=0;
$sDet=ejecutarSQL::consultar("SELECT * FROM detalle WHERE NumPedido='".$id."'");

$pdf->SetFont('times','b', 12);
$pdf->Cell( 12, 8, "Cant", 1,'j','C');
$pdf->Cell( 59, 8, "Nombre", 1,'j','C');
$pdf->Cell( 46, 8,utf8_decode('Presentación'), 1,'j','C');
$pdf->Cell( 28, 8, "Marca", 1,'j','C');
$pdf->Cell( 26, 8, "Precio", 1,'j','C');
$pdf->Cell( 26, 8, "Subtotal", 1,'j','C');
$pdf->SetFont('times','', 12);

while($fila1 = mysqli_fetch_array($sDet, MYSQLI_ASSOC)){
    $consulta=ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoProd='".$fila1['CodigoProd']."'");
    $fila=mysqli_fetch_array($consulta, MYSQLI_ASSOC);
    $pdf->Ln();
    $pdf->Cell (12,8,utf8_decode($fila1['CantidadProductos']),1,0,'C');
    $pdf->Cell (59,8,utf8_decode($fila['NombreProd']),1,0,'L');
    $pdf->Cell (46,8,utf8_decode($fila['Presentación']),1,0,'L');
    $pdf->Cell (28,8,utf8_decode($fila['Marca']),1,0,'L');
    //Con formatos
    $precio = number_format($fila1['PrecioProd'], 2, ',', '.');
    $subtotalCalc = $fila1['PrecioProd']*$fila1['CantidadProductos'];
    $subtotal = number_format($subtotalCalc, 2, ',', '.');

    $pdf->Cell (26,8,utf8_decode('Bs.'.$precio),1,0,'L');
    $pdf->Cell (26,8,utf8_decode('Bs.'.$subtotal),1,0,'L');
    // $pdf->Ln(10);
    $suma += $fila1['PrecioProd']*$fila1['CantidadProductos'];

    mysqli_free_result($consulta);
}    
    $pdf->Ln();
    $Ok = number_format($suma, 2, '.', '');
    $iva = ($Ok * 12) / 100;
    $totalCalc = $Ok + $iva; 
    $total = number_format($totalCalc, 2, ',', '.');
    $pdf->Cell(197,10,"Total a pagar Bs.({$total})",1,0,'R');
    $pdf->Ln();
// $pdf->SetFont("Times","b",12);
// $pdf->Cell (76,10,utf8_decode(''),1,0,'C');
// $pdf->Cell (30,10,utf8_decode(''),1,0,'C');
// $pdf->Cell (30,10,utf8_decode(''),1,0,'C');
// $pdf->Cell (30,10,utf8_decode('$'.number_format($suma,2)),1,0,'C');
$pdf->Ln(10);
$pdf->Output('Factura-#'.$id,'I');
mysqli_free_result($sVenta);
mysqli_free_result($sCliente);
mysqli_free_result($sDet);