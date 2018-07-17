<?php
session_start();
require './fpdf/fpdf.php';
include '../library/configServer.php';
include '../library/consulSQL.php';

class PDF extends FPDF{
}
ob_end_clean();
$pdf=new PDF('P','mm','Letter');

$pdf->AddPage();
$pdf->Ln();
$pdf->SetFont("Times","",10);
$rif = isset($_POST['Rif']) ? $_POST['Rif'] : '';
$after = isset($_POST['after']) ? $_POST['after'] : '';
$before = isset($_POST['before']) ? $_POST['before'] : '';
$sDet=ejecutarSQL::consultar("SELECT * FROM ventas WHERE Estado='Verificado' AND FechaO BETWEEN '2018-07-01' AND '2018-07-15' AND RIF='V14477562'");
//WHERE estado='Verificado' and FechaO between '2018-07-01' and '2018-07-15' and RIF='v14477562'

$pdf->SetFont('times','b', 10);
$suma=0;
$pdf->Cell( 18, 8, utf8_decode("N° Pedido"), 1,'j','C');
$pdf->Cell( 20, 8, "Fecha", 1,'j','C');
$pdf->Cell( 24, 8,utf8_decode('Rif'), 1,'j','C');
$pdf->Cell( 28, 8, "Cliente", 1,'j','C');
$pdf->Cell( 40, 8, utf8_decode("N°. Deposito"), 1,'j','C');
//$pdf->Cell( 28, 5, "Cuenta", 1,'j','C');
$pdf->Cell( 40, 8, "Envio", 1,'j','C');
$pdf->Cell( 26, 8, "Total", 1,'j','C');
$pdf->SetFont('times','', 10);
while($fila1 = mysqli_fetch_array($sDet, MYSQLI_ASSOC)){
    //$ventas=ejecutarSQL::consultar("SELECT * FROM ventas WHERE Estado='Verificado' AND FechaO BETWEEN '2018-07-01' AND '2018-07-15' AND RIF='16068389'");
    //$fila=mysqli_fetch_array($ventas, MYSQLI_ASSOC);
    //echo "<pre>";
    //var_dump($fila1);
    //Con formatos
    $pdf->Ln();
    $pdf->Cell (18,7,$fila1['NumPedido'],1,0,'C');
    $pdf->Cell (20,7,$fila1['Fecha'],1,0,'C');
    $pdf->Cell (24,7,$fila1['RIF'],1,0,'C');
    $pdf->Cell (28,7,utf8_decode($fila1['NombreCompleto']),1,0,'C');
    $pdf->Cell (40,7,$fila1['NumeroDeposito'],1,0,'C');
    //$pdf->Cell (28,8,$fila1['NumeroCuenta'],1,0,'C');
    $pdf->Cell (40,7,utf8_decode($fila1['TipoEnvio']),1,0,'C');

    $totalPorFila = number_format($fila1['TotalPagar'], 2, ',', '.');
    $pdf->Cell (26,7,$totalPorFila,1,0,'C');
    $suma += $fila1['TotalPagar'];
}
$pdf->Ln();
$pdf->Cell(170,7,"Total Bs.",1,0,'R');
$totalTodo = number_format($suma, 2, ',', '.');
$pdf->Cell(26,7,"{$totalTodo}",1,0,'R');
$pdf->Output();